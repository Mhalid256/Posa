<?php

namespace App\Console\Commands;

use App\Services\VendorSubscriptionService;
use Illuminate\Console\Command;

class ProcessExpiredSubscriptions extends Command
{
    protected $signature   = 'subscription:process-expired';
    protected $description = 'Mark expired vendor subscriptions and optionally suspend their accounts';

    public function __construct(
        private readonly VendorSubscriptionService $subscriptionService
    ) {
        parent::__construct();
    }

    public function handle(): void
    {
        // 1. Mark all past-due subscriptions as expired
        $marked = $this->subscriptionService->markExpiredSubscriptions();
        $this->info("Marked {$marked} subscriptions as expired.");

        // 2. Suspend vendors whose subscription expired MORE than 3 days ago
        //    (3-day grace period — adjust as needed)
        $graceOver = \App\Models\VendorSubscription::with('vendor')
            ->where('status', 'expired')
            ->where('end_date', '<', now()->subDays(3)->toDateString())
            ->get();

        $suspended = 0;
        foreach ($graceOver as $sub) {
            if ($sub->vendor && $sub->vendor->status === 'approved') {
                $this->subscriptionService->suspendExpiredVendor($sub->vendor_id);
                $suspended++;
                $this->line("Suspended vendor: " . ($sub->vendor->shop?->name ?? $sub->vendor_id));
            }
        }

        $this->info("Suspended {$suspended} vendors for non-renewal.");
    }
}
