<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\BaseController;
use App\Models\Seller;
use App\Models\VendorSubscription;
use App\Models\VendorSubscriptionPayment;
use App\Services\VendorSubscriptionService;
use Devrabiul\ToastMagic\Facades\ToastMagic;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SubscriptionTestController extends BaseController
{
    public function __construct(
    private readonly VendorSubscriptionService $subscriptionService
) {}

// ADD THIS:
public function index(?Request $request, string $type = null): View
{
    return $this->panel();
}

    /**
     * Main test panel — shows current state and all test actions
     */
    public function panel(): View
    {
        $vendor  = auth('seller')->user();
        $sub     = VendorSubscription::where('vendor_id', $vendor->id)->latest()->first();
        $payments = VendorSubscriptionPayment::where('vendor_id', $vendor->id)
            ->orderByDesc('created_at')->get();

        return view('vendor-views.subscription.test-panel',
            compact('vendor', 'sub', 'payments'));
    }

    /**
     * Set subscription end_date to X days from now
     * Use days=0 to expire immediately, days=-1 for already expired
     */
    public function setDays(int $days): RedirectResponse
    {
        $vendor = auth('seller')->user();
        $sub    = VendorSubscription::where('vendor_id', $vendor->id)->latest()->first();

        if (!$sub) {
            // Create one if none exists
            $sub = VendorSubscription::create([
                'vendor_id'  => $vendor->id,
                'start_date' => now()->subDays(30)->toDateString(),
                'end_date'   => now()->addDays($days)->toDateString(),
                'amount_paid'=> $vendor->monthly_charge,
                'status'     => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } else {
            $sub->update([
                'end_date'   => now()->addDays($days)->toDateString(),
                'status'     => $days >= 0 ? 'active' : 'expired',
                'updated_at' => now(),
            ]);
        }

        // If setting to expired (negative days), also mark status
        if ($days < 0) {
            $sub->update(['status' => 'expired']);
        }

        ToastMagic::success("Subscription end date set to: " . now()->addDays($days)->format('d M Y') . " ({$days} days from now)");
        return redirect()->route('vendor.subscription.test.panel');
    }

    /**
     * Expire the subscription right now (set end_date to yesterday)
     */
    public function expireNow(): RedirectResponse
    {
        $vendor = auth('seller')->user();
        VendorSubscription::where('vendor_id', $vendor->id)
            ->whereIn('status', ['active', 'grace'])
            ->update([
                'end_date'   => now()->subDay()->toDateString(),
                'status'     => 'expired',
                'updated_at' => now(),
            ]);

        ToastMagic::warning('Subscription expired! End date set to yesterday.');
        return redirect()->route('vendor.subscription.test.panel');
    }

    /**
     * Simulate a successful Pesapal payment without hitting the real API
     */
    public function simulatePayment(): RedirectResponse
    {
        $vendor = auth('seller')->user();
        $charge = (float) $vendor->monthly_charge ?: 50000;
        $fee    = round($charge * 0.04, 2);
        $total  = $charge + $fee;

        // Renew the subscription directly
        $newSub = $this->subscriptionService->renewSubscription(
            vendorId: $vendor->id,
            amount: $total,
            paymentMethod: 'test_simulation',
            transactionRef: 'TEST-' . now()->format('YmdHis'),
            pesapalOrderId: 'TEST-ORDER-' . uniqid(),
            pesapalTrackingId: 'TEST-TRACK-' . uniqid()
        );

        ToastMagic::success('Payment simulated! New subscription active until: ' . $newSub->end_date->format('d M Y'));
        return redirect()->route('vendor.subscription.test.panel');
    }

    /**
     * Suspend this vendor's account (simulate scheduler suspension)
     */
    public function suspendSelf(): RedirectResponse
    {
        $vendor = auth('seller')->user();
        $this->subscriptionService->suspendExpiredVendor($vendor->id);

        ToastMagic::error('Vendor account suspended! You will be logged out shortly.');
        // Log them out so they see the suspended state
        auth('seller')->logout();
        return redirect()->route('vendor.auth.login');
    }

    /**
     * Run the reminder command manually (simulates the 9am scheduler)
     */
    public function runReminder(): RedirectResponse
    {
        \Artisan::call('subscription:send-reminders');
        $output = \Artisan::output();
        ToastMagic::info('Reminder command ran. Output: ' . trim($output));
        return redirect()->route('vendor.subscription.test.panel');
    }

    /**
     * Run the expiry processor manually (simulates the midnight scheduler)
     */
    public function runExpiryProcessor(): RedirectResponse
    {
        \Artisan::call('subscription:process-expired');
        $output = \Artisan::output();
        ToastMagic::info('Expiry processor ran. Output: ' . trim($output));
        return redirect()->route('vendor.subscription.test.panel');
    }

    /**
     * Reset everything — delete all subscriptions for this vendor and create fresh
     */
    public function reset(): RedirectResponse
    {
        $vendor = auth('seller')->user();

        VendorSubscriptionPayment::where('vendor_id', $vendor->id)->delete();
        VendorSubscription::where('vendor_id', $vendor->id)->delete();

        // Create a fresh 30-day subscription
        $this->subscriptionService->createInitialSubscription(
            vendorId: $vendor->id,
            monthlyCharge: $vendor->monthly_charge ?: 50000
        );

        // Make sure vendor is approved
        Seller::where('id', $vendor->id)->update(['status' => 'approved']);

        ToastMagic::success('Subscription reset! Fresh 30-day subscription created.');
        return redirect()->route('vendor.subscription.test.panel');
    }
}