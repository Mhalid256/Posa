<?php

namespace App\Console\Commands;

use App\Models\VendorSubscription;
use App\Services\VendorSubscriptionService;
use App\Traits\PushNotificationTrait;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SendSubscriptionReminders extends Command
{
    use PushNotificationTrait;

    protected $signature   = 'subscription:send-reminders';
    protected $description = 'Send subscription expiry reminders to vendors whose subscription expires within 10 days';

    public function __construct(
        private readonly VendorSubscriptionService $subscriptionService
    ) {
        parent::__construct();
    }

    public function handle(): void
    {
        $expiringSoon = $this->subscriptionService->getVendorsExpiringSoon(days: 10);

        $sent = 0;
        foreach ($expiringSoon as $subscription) {
            // Skip if we already sent a reminder within the last 24 hours
            if ($subscription->reminder_sent_at && $subscription->reminder_sent_at->isToday()) {
                continue;
            }

            $vendor = $subscription->vendor;
            if (!$vendor) {
                continue;
            }

            $daysLeft    = $subscription->daysRemaining();
            $renewUrl    = route('vendor.subscription.checkout');
            $shopName    = $vendor->shop?->name ?? $vendor->f_name . ' ' . $vendor->l_name;
            $chargeAmount = $vendor->monthly_charge;

            // ── Push notification to vendor's FCM token ──────────────
            if ($vendor->cm_firebase_token) {
                try {
                    $notifData = [
                        'title'       => translate('subscription_expiring_soon'),
                        'description' => translate('your_subscription_expires_in') . ' ' . $daysLeft . ' ' . translate('days') . '. ' . translate('renew_now_to_keep_your_shop_active') . '.',
                        'image'       => '',
                        'type'        => 'subscription_reminder',
                        'order_id'    => null,
                    ];
                    $this->sendPushNotificationToDevice($vendor->cm_firebase_token, $notifData);
                } catch (\Exception $e) {
                    Log::warning('Subscription reminder push failed for vendor ' . $vendor->id . ': ' . $e->getMessage());
                }
            }

            // ── Mark reminder sent ────────────────────────────────────
            $subscription->update(['reminder_sent_at' => now()]);
            $sent++;

            $this->line("✓ Reminder sent to: {$shopName} (expires in {$daysLeft} days)");
        }

        $this->info("Subscription reminders sent: {$sent}");
    }
}
