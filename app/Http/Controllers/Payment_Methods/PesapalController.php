<?php

namespace App\Http\Controllers\Payment_Methods;

use App\Models\PaymentRequest;
use App\Models\User;
use App\Traits\Processor;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PesapalController extends Controller
{
    use Processor;

    private $config_values;
    private PaymentRequest $payment;
    private $user;

    // Pesapal API base URLs
    private string $liveBaseUrl = 'https://pay.pesapal.com/v3';
    private string $sandboxBaseUrl = 'https://cybqa.pesapal.com/pesapalv3';

    public function __construct(PaymentRequest $payment, User $user)
    {
        $config = $this->payment_config('pesapal', 'payment_config');
        if (!is_null($config) && $config->mode == 'live') {
            $this->config_values = json_decode($config->live_values);
        } elseif (!is_null($config) && $config->mode == 'test') {
            $this->config_values = json_decode($config->test_values);
        }
        $this->payment = $payment;
        $this->user = $user;
    }

    /**
     * Get the correct Pesapal base URL based on mode
     */
    private function getBaseUrl(): string
    {
        $config = $this->payment_config('pesapal', 'payment_config');
        return (!is_null($config) && $config->mode == 'live')
            ? $this->liveBaseUrl
            : $this->sandboxBaseUrl;
    }

    /**
     * Authenticate with Pesapal and get bearer token
     */
    private function getAccessToken(): ?string
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->post($this->getBaseUrl() . '/api/Auth/RequestToken', [
            'consumer_key'    => $this->config_values->consumer_key,
            'consumer_secret' => $this->config_values->consumer_secret,
        ]);

        if ($response->successful() && isset($response->json()['token'])) {
            return $response->json()['token'];
        }

        return null;
    }

    /**
     * Register IPN (Instant Payment Notification) URL with Pesapal
     */
    private function registerIPN(string $token): ?string
    {
        $ipnUrl = route('pesapal.ipn');

        $response = Http::withHeaders([
            'Accept'        => 'application/json',
            'Content-Type'  => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ])->post($this->getBaseUrl() . '/api/URLSetup/RegisterIPN', [
            'url'          => $ipnUrl,
            'ipn_notification_type' => 'POST',
        ]);

        if ($response->successful() && isset($response->json()['ipn_id'])) {
            return $response->json()['ipn_id'];
        }

        return null;
    }

    /**
     * Step 1: Initiate payment — redirect customer to Pesapal hosted page
     */
    public function pay(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'payment_id' => 'required|uuid',
        ]);

        if ($validator->fails()) {
            return response()->json(
                $this->response_formatter(GATEWAYS_DEFAULT_400, null, $this->error_processor($validator)),
                400
            );
        }

        $data = $this->payment::where(['id' => $request['payment_id']])
            ->where(['is_paid' => 0])
            ->first();

        if (!isset($data)) {
            return response()->json($this->response_formatter(GATEWAYS_DEFAULT_204), 200);
        }

        $payer = json_decode($data['payer_information']);

        // Step 1: Get access token
        $token = $this->getAccessToken();
        if (!$token) {
            return view('payment.pesapal-error', [
                'message' => 'Unable to authenticate with Pesapal. Please check your credentials.',
            ]);
        }

        // Step 2: Register IPN
        $ipnId = $this->registerIPN($token);
        if (!$ipnId) {
            // Use stored IPN ID if already registered
            $ipnId = $this->config_values->ipn_id ?? null;
        }

        if (!$ipnId) {
            return view('payment.pesapal-error', [
                'message' => 'Unable to register IPN URL with Pesapal.',
            ]);
        }

        // Step 3: Submit order request
        $orderTrackingId = (string) Str::uuid();

        $payload = [
            'id'                        => $orderTrackingId,
            'currency'                  => $data->currency_code ?? 'UGX',
            'amount'                    => (float) $data->payment_amount,
            'description'               => 'Payment for order #' . $data->attribute_id,
            'callback_url'              => route('pesapal.callback', ['payment_id' => $data->id]),
            'notification_id'           => $ipnId,
            'billing_address'           => [
                'email_address'         => $payer->email ?? '',
                'phone_number'          => $payer->phone ?? '',
                'first_name'            => $payer->name ?? 'Customer',
                'last_name'             => '',
                'country_code'          => 'UG',
            ],
        ];

        $response = Http::withHeaders([
            'Accept'        => 'application/json',
            'Content-Type'  => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ])->post($this->getBaseUrl() . '/api/Transactions/SubmitOrderRequest', $payload);

        if ($response->successful() && isset($response->json()['redirect_url'])) {
            $responseData = $response->json();

            // Store the Pesapal order tracking ID against our payment record
            $this->payment::where(['id' => $data->id])->update([
                'transaction_id' => $responseData['order_tracking_id'],
            ]);

            return redirect()->away($responseData['redirect_url']);
        }

        return view('payment.pesapal-error', [
            'message' => 'Unable to initiate Pesapal payment. Please try again.',
        ]);
    }

    /**
     * Step 2: Callback — Pesapal redirects back here after payment
     */
    public function callback(Request $request)
    {
        $paymentId    = $request['payment_id'];
        $trackingId   = $request['OrderTrackingId'] ?? $request['order_tracking_id'] ?? null;
        $merchantRef  = $request['OrderMerchantReference'] ?? null;

        $data = $this->payment::where(['id' => $paymentId])->first();

        if (!isset($data)) {
            return view('payment.pesapal-error', ['message' => 'Payment record not found.']);
        }

        if (!$trackingId) {
            if (isset($data) && function_exists($data->failure_hook)) {
                call_user_func($data->failure_hook, $data);
            }
            return $this->payment_response($data, 'fail');
        }

        // Verify transaction status
        $token = $this->getAccessToken();
        if (!$token) {
            return $this->payment_response($data, 'fail');
        }

        $statusResponse = Http::withHeaders([
            'Accept'        => 'application/json',
            'Content-Type'  => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ])->get($this->getBaseUrl() . '/api/Transactions/GetTransactionStatus', [
            'orderTrackingId' => $trackingId,
        ]);

        if ($statusResponse->successful()) {
            $statusData   = $statusResponse->json();
            $paymentStatus = strtolower($statusData['payment_status_description'] ?? '');

            if (in_array($paymentStatus, ['completed', 'paid'])) {
                $this->payment::where(['id' => $paymentId])->update([
                    'payment_method' => 'pesapal',
                    'is_paid'        => 1,
                    'transaction_id' => $trackingId,
                ]);

                $data = $this->payment::where(['id' => $paymentId])->first();
                if (isset($data) && function_exists($data->success_hook)) {
                    call_user_func($data->success_hook, $data);
                }
                return $this->payment_response($data, 'success');
            }
        }

        // Payment not completed
        if (isset($data) && function_exists($data->failure_hook)) {
            call_user_func($data->failure_hook, $data);
        }
        return $this->payment_response($data, 'fail');
    }

    /**
     * IPN endpoint — Pesapal POSTs payment status updates here
     */
    public function ipn(Request $request)
    {
        $trackingId  = $request['OrderTrackingId'] ?? $request['order_tracking_id'] ?? null;
        $merchantRef = $request['OrderMerchantReference'] ?? null;
        $notifType   = $request['OrderNotificationType'] ?? null;

        if (!$trackingId) {
            return response()->json(['status' => 'error', 'message' => 'Missing tracking ID'], 400);
        }

        $token = $this->getAccessToken();
        if (!$token) {
            return response()->json(['status' => 'error', 'message' => 'Auth failed'], 500);
        }

        $statusResponse = Http::withHeaders([
            'Accept'        => 'application/json',
            'Content-Type'  => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ])->get($this->getBaseUrl() . '/api/Transactions/GetTransactionStatus', [
            'orderTrackingId' => $trackingId,
        ]);

        if ($statusResponse->successful()) {
            $statusData    = $statusResponse->json();
            $paymentStatus = strtolower($statusData['payment_status_description'] ?? '');

            // Find the payment by the stored tracking ID
            $data = $this->payment::where(['transaction_id' => $trackingId])->first();

            if (isset($data) && in_array($paymentStatus, ['completed', 'paid']) && !$data->is_paid) {
                $this->payment::where(['transaction_id' => $trackingId])->update([
                    'payment_method' => 'pesapal',
                    'is_paid'        => 1,
                ]);

                $data = $this->payment::where(['transaction_id' => $trackingId])->first();
                if (isset($data) && function_exists($data->success_hook)) {
                    call_user_func($data->success_hook, $data);
                }
            }
        }

        return response()->json(['status' => 'ok', 'orderNotificationType' => $notifType, 'orderTrackingId' => $trackingId]);
    }

    /**
     * Cancel — user cancelled payment on Pesapal
     */
    public function cancel(Request $request)
    {
        $data = $this->payment::where(['id' => $request['payment_id']])->first();
        if (isset($data) && function_exists($data->failure_hook)) {
            call_user_func($data->failure_hook, $data);
        }
        return $this->payment_response($data, 'fail');
    }
}