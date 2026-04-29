<?php

namespace App\Http\Controllers\Admin\Vendor;

use App\Http\Controllers\BaseController;
use App\Models\Seller;
use App\Models\VendorSubscription;
use App\Models\VendorSubscriptionPayment;
use App\Services\VendorSubscriptionService;
use Devrabiul\ToastMagic\Facades\ToastMagic;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class VendorSubscriptionController extends BaseController
{
    public function __construct(
        private readonly VendorSubscriptionService $subscriptionService
    ) {}

    /* ── Admin: Subscription overview dashboard ─────────────────── */

    public function index(?Request $request, string $type = null): View|\Illuminate\Database\Eloquent\Collection|\Illuminate\Pagination\LengthAwarePaginator|null|callable|RedirectResponse|JsonResponse
    {
        // Expiring within 10 days
        $expiringSoon = $this->subscriptionService->getVendorsExpiringSoon(10);

        // Already expired
        $expired = VendorSubscription::with('vendor.shop')
            ->where('status', 'expired')
            ->orderByDesc('end_date')
            ->paginate(15, ['*'], 'expired_page');

        // Active subscriptions
        $active = VendorSubscription::with('vendor.shop')
            ->where('status', 'active')
            ->orderBy('end_date')
            ->paginate(15, ['*'], 'active_page');

        // Payment history (paginated)
        $payments = VendorSubscriptionPayment::with(['vendor.shop', 'subscription'])
            ->where('status', 'completed')
            ->orderByDesc('paid_at')
            ->paginate(15, ['*'], 'payments_page');

        // Total collected (separate query — paginator does not support sum())
        $totalCollected = VendorSubscriptionPayment::where('status', 'completed')->sum('amount');

        return view('admin-views.vendor-subscription.index',
            compact('expiringSoon', 'expired', 'active', 'payments', 'totalCollected'));
    }

    /* ── Admin: Manually suspend a vendor ───────────────────────── */

    public function suspendVendor(Request $request): RedirectResponse
    {
        $vendor = Seller::findOrFail($request->vendor_id);
        $this->subscriptionService->suspendExpiredVendor($vendor->id);

        VendorSubscription::where('vendor_id', $vendor->id)
            ->whereIn('status', ['active', 'grace'])
            ->update(['status' => 'expired', 'updated_at' => now()]);

        ToastMagic::success(translate('vendor_suspended_successfully'));
        return back();
    }

    /* ── Admin: Manually reactivate a vendor ────────────────────── */

    public function reactivateVendor(Request $request): RedirectResponse
    {
        $vendor = Seller::findOrFail($request->vendor_id);
        $vendor->update(['status' => 'approved']);

        $this->subscriptionService->renewSubscription(
            vendorId: $vendor->id,
            amount: 0,
            paymentMethod: 'admin_override',
            transactionRef: 'ADMIN-' . now()->format('YmdHis')
        );

        ToastMagic::success(translate('vendor_reactivated_successfully'));
        return back();
    }

    /* ── Admin: View one vendor's full subscription history ─────── */

    public function vendorHistory(int $vendorId): View
    {
        $vendor        = Seller::with('shop')->findOrFail($vendorId);
        $subscriptions = VendorSubscription::with('payments')
            ->where('vendor_id', $vendorId)
            ->orderByDesc('start_date')
            ->paginate(20);
        $currentSub    = $this->subscriptionService->getActiveSubscription($vendorId);

        return view('admin-views.vendor-subscription.history',
            compact('vendor', 'subscriptions', 'currentSub'));
    }

    /* ── Admin: Update monthly_charge for a vendor ──────────────── */

    public function updateMonthlyCharge(Request $request): JsonResponse
    {
        $request->validate([
            'vendor_id'      => 'required|integer|exists:sellers,id',
            'monthly_charge' => 'required|numeric|min:0',
        ]);

        Seller::where('id', $request->vendor_id)
            ->update(['monthly_charge' => $request->monthly_charge]);

        return response()->json([
            'success' => true,
            'message' => translate('monthly_charge_updated_successfully'),
        ]);
    }
}