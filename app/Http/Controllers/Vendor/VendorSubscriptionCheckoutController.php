<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\BaseController;
use App\Models\VendorSubscription;
use App\Models\VendorSubscriptionPayment;
use App\Services\VendorSubscriptionService;
use Devrabiul\ToastMagic\Facades\ToastMagic;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class VendorSubscriptionCheckoutController extends BaseController
{
    public function __construct(
        private readonly VendorSubscriptionService $subscriptionService
    ) {}

    public function index(?Request $request, string $type = null): View
    {
        return $this->checkout();
    }

    /* ── Step 1: Show checkout / payment page ───────────────────── */

    public function checkout(): View
    {
        $vendor      = auth('seller')->user();
        $currentSub  = $this->subscriptionService->getActiveSubscription($vendor->id);
        $charge      = (float) $vendor->monthly_charge;
        $pesapalFee  = round($charge * 0.04, 2);
        $totalAmount = $charge + $pesapalFee;

        return view('vendor-views.subscription.checkout',
            compact('vendor', 'currentSub', 'charge', 'pesapalFee', 'totalAmount'));
    }

    /* ── Vendor: Subscription payment history ───────────────────── */

    public function history(): View
    {
        $vendor        = auth('seller')->user();
        $subscriptions = VendorSubscription::where('vendor_id', $vendor->id)
            ->orderByDesc('start_date')
            ->paginate(20);

        return view('vendor-views.subscription.history', compact('subscriptions'));
    }

    /* ── Step 2: Initiate Pesapal payment ───────────────────────── */

    public function initiatePayment(Request $request): RedirectResponse
    {
        $vendor      = auth('seller')->user();
        $charge      = (float) $vendor->monthly_charge;
        $pesapalFee  = round($charge * 0.04, 2);
        $totalAmount = $charge + $pesapalFee;

        if ($totalAmount <= 0) {
            $this->subscriptionService->renewSubscription(
                vendorId: $vendor->id,
                amount: 0,
                paymentMethod: 'free',
                transactionRef: 'FREE-' . now()->format('YmdHis')
            );
            ToastMagic::success(translate('subscription_renewed_successfully'));
            return redirect()->route('vendor.dashboard.index');
        }

        $pesapalConfig = $this->getPesapalConfig();
        $token         = $this->getPesapalToken($pesapalConfig);

        if (!$token) {
            ToastMagic::error(translate('payment_gateway_error_please_try_again'));
            return back();
        }

        $ipnId = $this->registerIpn($token, $pesapalConfig);

        $currentSub = $this->subscriptionService->getActiveSubscription($vendor->id);
        if (!$currentSub) {
            $currentSub = $this->subscriptionService->createInitialSubscription($vendor->id, $charge);
        }

        $payment = VendorSubscriptionPayment::create([
            'vendor_id'       => $vendor->id,
            'subscription_id' => $currentSub->id,
            'amount'          => $totalAmount,
            'payment_method'  => 'pesapal',
            'status'          => 'pending',
            'created_at'      => now(),
            'updated_at'      => now(),
        ]);

        $orderData = [
            'id'              => 'VSUB-' . $payment->id . '-' . time(),
            'currency'        => 'UGX',
            'amount'          => $totalAmount,
            'description'     => 'Vendor Monthly Subscription - ' . ($vendor->shop?->name ?? $vendor->f_name),
            'callback_url'    => route('vendor.subscription.callback'),
            'notification_id' => $ipnId,
            'billing_address' => [
                'email_address' => $vendor->email,
                'phone_number'  => $vendor->phone ?? '',
                'first_name'    => $vendor->f_name,
                'last_name'     => $vendor->l_name ?? '',
            ],
        ];

        $response = Http::withToken($token)
            ->post($pesapalConfig['base_url'] . '/api/Transactions/SubmitOrderRequest', $orderData);

        if (!$response->ok() || empty($response->json('redirect_url'))) {
            Log::error('Pesapal subscription order failed', ['response' => $response->body()]);
            ToastMagic::error(translate('payment_initiation_failed_please_try_again'));
            return back();
        }

        $responseData = $response->json();

        $payment->update([
            'pesapal_order_id' => $responseData['order_tracking_id'] ?? null,
            'transaction_ref'  => $orderData['id'],
        ]);

        return redirect()->away($responseData['redirect_url']);
    }

    /* ── Step 3: Pesapal callback after payment ─────────────────── */

    public function callback(Request $request): RedirectResponse
    {
        $orderTrackingId  = $request->get('OrderTrackingId');
        $orderMerchantRef = $request->get('OrderMerchantReference');

        if (!$orderTrackingId) {
            ToastMagic::error(translate('payment_verification_failed'));
            return redirect()->route('vendor.subscription.checkout');
        }

        $pesapalConfig = $this->getPesapalConfig();
        $token         = $this->getPesapalToken($pesapalConfig);

        if (!$token) {
            ToastMagic::error(translate('payment_verification_error'));
            return redirect()->route('vendor.subscription.checkout');
        }

        $statusResponse = Http::withToken($token)
            ->get($pesapalConfig['base_url'] . '/api/Transactions/GetTransactionStatus', [
                'orderTrackingId' => $orderTrackingId,
            ]);

        if (!$statusResponse->ok()) {
            ToastMagic::error(translate('payment_verification_failed'));
            return redirect()->route('vendor.subscription.checkout');
        }

        $statusData    = $statusResponse->json();
        $paymentStatus = strtolower($statusData['payment_status_description'] ?? '');

        $payment = VendorSubscriptionPayment::where('pesapal_order_id', $orderTrackingId)
            ->orWhere('transaction_ref', $orderMerchantRef)
            ->first();

        if (!$payment) {
            ToastMagic::error(translate('payment_record_not_found'));
            return redirect()->route('vendor.subscription.checkout');
        }

        if (in_array($paymentStatus, ['completed', 'paid'])) {
            $payment->update([
                'status'              => 'completed',
                'pesapal_tracking_id' => $statusData['confirmation_code'] ?? null,
                'paid_at'             => now(),
            ]);

            $this->subscriptionService->renewSubscription(
                vendorId: $payment->vendor_id,
                amount: $payment->amount,
                paymentMethod: 'pesapal',
                transactionRef: $payment->transaction_ref,
                pesapalOrderId: $orderTrackingId,
                pesapalTrackingId: $statusData['confirmation_code'] ?? null
            );

            ToastMagic::success(translate('subscription_renewed_successfully_your_shop_is_now_active_for_another_30_days'));
            return redirect()->route('vendor.dashboard.index');
        }

        $payment->update(['status' => 'failed', 'updated_at' => now()]);
        ToastMagic::error(translate('payment_was_not_successful_please_try_again'));
        return redirect()->route('vendor.subscription.checkout');
    }

    /* ── Pesapal IPN (server-to-server notification) ─────────────── */

    public function ipn(Request $request): JsonResponse
    {
        $orderTrackingId  = $request->get('OrderTrackingId');
        $orderMerchantRef = $request->get('OrderMerchantReference');

        if (!$orderTrackingId) {
            return response()->json(['status' => 'error'], 400);
        }

        $pesapalConfig = $this->getPesapalConfig();
        $token         = $this->getPesapalToken($pesapalConfig);

        if (!$token) {
            return response()->json(['status' => 'error'], 500);
        }

        $statusResponse = Http::withToken($token)
            ->get($pesapalConfig['base_url'] . '/api/Transactions/GetTransactionStatus', [
                'orderTrackingId' => $orderTrackingId,
            ]);

        if (!$statusResponse->ok()) {
            return response()->json(['status' => 'error'], 500);
        }

        $statusData    = $statusResponse->json();
        $paymentStatus = strtolower($statusData['payment_status_description'] ?? '');

        $payment = VendorSubscriptionPayment::where('pesapal_order_id', $orderTrackingId)
            ->orWhere('transaction_ref', $orderMerchantRef)
            ->first();

        if ($payment && in_array($paymentStatus, ['completed', 'paid']) && $payment->status !== 'completed') {
            $payment->update([
                'status'              => 'completed',
                'pesapal_tracking_id' => $statusData['confirmation_code'] ?? null,
                'paid_at'             => now(),
            ]);

            $this->subscriptionService->renewSubscription(
                vendorId: $payment->vendor_id,
                amount: $payment->amount,
                paymentMethod: 'pesapal',
                transactionRef: $payment->transaction_ref,
                pesapalOrderId: $orderTrackingId,
                pesapalTrackingId: $statusData['confirmation_code'] ?? null
            );
        }

        return response()->json([
            'orderNotificationType' => 'IPNCHANGE',
            'orderTrackingId'       => $orderTrackingId,
            'orderMerchantReference'=> $orderMerchantRef,
            'status'                => 200,
        ]);
    }

    /* ── Private helpers ────────────────────────────────────────── */

    private function getPesapalConfig(): array
    {
        $settings = \App\Models\Setting::where('key_name', 'pesapal')->first();
        $values   = $settings ? json_decode($settings->live_values, true) : [];

        return [
            'consumer_key'    => $values['consumer_key'] ?? '',
            'consumer_secret' => $values['consumer_secret'] ?? '',
            'ipn_id'          => $values['ipn_id'] ?? '',
            'base_url'        => ($values['mode'] ?? 'live') === 'live'
                ? 'https://pay.pesapal.com/v3'
                : 'https://cybqa.pesapal.com/pesapalv3',
        ];
    }

    private function getPesapalToken(array $config): ?string
    {
        try {
            $response = Http::post($config['base_url'] . '/api/Auth/RequestToken', [
                'consumer_key'    => $config['consumer_key'],
                'consumer_secret' => $config['consumer_secret'],
            ]);
            return $response->ok() ? ($response->json('token') ?? null) : null;
        } catch (\Exception $e) {
            Log::error('Pesapal token error: ' . $e->getMessage());
            return null;
        }
    }

    private function registerIpn(string $token, array $config): string
    {
        if (!empty($config['ipn_id'])) {
            return $config['ipn_id'];
        }
        try {
            $response = Http::withToken($token)
                ->post($config['base_url'] . '/api/URLSetup/RegisterIPN', [
                    'url'                    => route('vendor.subscription.ipn'),
                    'ipn_notification_type'  => 'GET',
                ]);
            return $response->json('ipn_id') ?? '';
        } catch (\Exception $e) {
            return '';
        }
    }
}