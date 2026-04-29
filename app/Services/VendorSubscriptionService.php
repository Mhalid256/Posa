<?php

namespace App\Services;

use App\Models\Seller;
use App\Models\VendorSubscription;
use App\Models\VendorSubscriptionPayment;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class VendorSubscriptionService
{
    /**
     * Create the initial subscription when a vendor is registered.
     * Start date = today, end date = today + 30 days.
     */
    public function createInitialSubscription(int $vendorId, float $monthlyCharge): VendorSubscription
    {
        return VendorSubscription::create([
            'vendor_id'    => $vendorId,
            'start_date'   => now()->toDateString(),
            'end_date'     => now()->addDays(30)->toDateString(),
            'amount_paid'  => 0,               // First period is free / pending payment
            'status'       => 'active',
            'created_at'   => now(),
            'updated_at'   => now(),
        ]);
    }

    /**
     * Renew a vendor subscription after successful payment.
     * Always extends from the current end_date to avoid gaps.
     */
    public function renewSubscription(
        int    $vendorId,
        float  $amount,
        string $paymentMethod = 'pesapal',
        string $transactionRef = null,
        string $pesapalOrderId = null,
        string $pesapalTrackingId = null
    ): VendorSubscription {
        return DB::transaction(function () use (
            $vendorId, $amount, $paymentMethod,
            $transactionRef, $pesapalOrderId, $pesapalTrackingId
        ) {
            // Expire the current active subscription
            $current = VendorSubscription::where('vendor_id', $vendorId)
                ->whereIn('status', ['active', 'grace'])
                ->latest()
                ->first();

            $startDate = $current
                ? Carbon::parse($current->end_date)->addDay()
                : now();

            $endDate = (clone $startDate)->addDays(30);

            if ($current) {
                $current->update(['status' => 'expired']);
            }

            // Create the new subscription period
            $newSub = VendorSubscription::create([
                'vendor_id'         => $vendorId,
                'start_date'        => $startDate->toDateString(),
                'end_date'          => $endDate->toDateString(),
                'amount_paid'       => $amount,
                'payment_method'    => $paymentMethod,
                'payment_reference' => $transactionRef,
                'status'            => 'active',
                'created_at'        => now(),
                'updated_at'        => now(),
            ]);

            // Record the payment
            VendorSubscriptionPayment::create([
                'vendor_id'          => $vendorId,
                'subscription_id'    => $newSub->id,
                'amount'             => $amount,
                'payment_method'     => $paymentMethod,
                'transaction_ref'    => $transactionRef,
                'pesapal_order_id'   => $pesapalOrderId,
                'pesapal_tracking_id'=> $pesapalTrackingId,
                'status'             => 'completed',
                'paid_at'            => now(),
                'created_at'         => now(),
                'updated_at'         => now(),
            ]);

            // Re-approve vendor if they were suspended for non-payment
            $vendor = Seller::find($vendorId);
            if ($vendor && $vendor->status === 'suspended') {
                $vendor->update(['status' => 'approved']);
            }

            return $newSub;
        });
    }

    /**
     * Get the current active/grace subscription for a vendor.
     */
    public function getActiveSubscription(int $vendorId): ?VendorSubscription
    {
        return VendorSubscription::where('vendor_id', $vendorId)
            ->whereIn('status', ['active', 'grace'])
            ->latest()
            ->first();
    }

    /**
     * Get all vendors whose subscription expires within the next N days.
     * Used by the reminder command and the admin dashboard panel.
     */
    public function getVendorsExpiringSoon(int $days = 10): \Illuminate\Database\Eloquent\Collection
    {
        return VendorSubscription::with('vendor.shop')
            ->whereIn('status', ['active'])
            ->where('end_date', '<=', now()->addDays($days)->toDateString())
            ->where('end_date', '>=', now()->toDateString())
            ->get();
    }

    /**
     * Get all vendors whose subscription has already expired.
     */
    public function getExpiredSubscriptions(): \Illuminate\Database\Eloquent\Collection
    {
        return VendorSubscription::with('vendor.shop')
            ->whereIn('status', ['active', 'grace'])
            ->where('end_date', '<', now()->toDateString())
            ->get();
    }

    /**
     * Mark subscriptions that have passed their end_date as expired.
     * Called by the scheduler daily.
     */
    public function markExpiredSubscriptions(): int
    {
        return VendorSubscription::whereIn('status', ['active', 'grace'])
            ->where('end_date', '<', now()->toDateString())
            ->update(['status' => 'expired', 'updated_at' => now()]);
    }

    /**
     * Suspend a vendor whose subscription has expired and grace period has passed.
     */
    public function suspendExpiredVendor(int $vendorId): void
    {
        Seller::where('id', $vendorId)
            ->where('status', 'approved')
            ->update(['status' => 'suspended', 'auth_token' => \Illuminate\Support\Str::random(80)]);
    }
}
