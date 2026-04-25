{{--
    FILE: resources/views/admin-views/payment/pesapal-index.blade.php
    This is the admin settings form for Pesapal gateway configuration.
    Include it in your payment method settings blade following the same pattern
    as other gateways (e.g. paystack-index.blade.php).
--}}

@php
    $pesapalConfig = \App\Models\Setting::where(['key_name' => 'pesapal', 'settings_type' => 'payment_config'])->first();
    $pesapalLive   = $pesapalConfig ? json_decode($pesapalConfig->live_values, true) : [];
    $pesapalTest   = $pesapalConfig ? json_decode($pesapalConfig->test_values, true) : [];
    $pesapalMode   = $pesapalConfig->mode ?? 'test';
    $pesapalActive = $pesapalConfig->is_active ?? 0;
@endphp

<form action="{{ route('admin.payment-method.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="gateway" value="pesapal">

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0 d-flex align-items-center gap-2">
                <img src="{{ dynamicAsset('public/assets/payment/pesapal.png') }}" alt="Pesapal" height="30">
                {{ translate('Pesapal_Payment_Gateway') }}
            </h5>
        </div>
        <div class="card-body">

            {{-- Status Toggle --}}
            <div class="form-group row align-items-center">
                <label class="col-sm-3 col-form-label">{{ translate('status') }}</label>
                <div class="col-sm-9">
                    <label class="switcher">
                        <input type="checkbox" class="switcher_input" name="status" value="1"
                               {{ ($pesapalLive['status'] ?? '0') == '1' ? 'checked' : '' }}>
                        <span class="switcher_control"></span>
                    </label>
                </div>
            </div>

            {{-- Mode --}}
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">{{ translate('mode') }}</label>
                <div class="col-sm-9">
                    <select name="mode" class="form-control">
                        <option value="test" {{ $pesapalMode == 'test' ? 'selected' : '' }}>
                            {{ translate('test') }}
                        </option>
                        <option value="live" {{ $pesapalMode == 'live' ? 'selected' : '' }}>
                            {{ translate('live') }}
                        </option>
                    </select>
                </div>
            </div>

            <hr>
            <h6 class="text-muted mb-3">{{ translate('Live_Credentials') }}</h6>

            {{-- Live Consumer Key --}}
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">
                    {{ translate('consumer_key') }} ({{ translate('live') }})
                    <span class="text-danger">*</span>
                </label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="consumer_key"
                           value="{{ $pesapalLive['consumer_key'] ?? '' }}"
                           placeholder="{{ translate('enter_Pesapal_consumer_key') }}">
                </div>
            </div>

            {{-- Live Consumer Secret --}}
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">
                    {{ translate('consumer_secret') }} ({{ translate('live') }})
                    <span class="text-danger">*</span>
                </label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="consumer_secret"
                           value="{{ $pesapalLive['consumer_secret'] ?? '' }}"
                           placeholder="{{ translate('enter_Pesapal_consumer_secret') }}">
                </div>
            </div>

            <hr>
            <h6 class="text-muted mb-3">{{ translate('Test_/_Sandbox_Credentials') }}</h6>

            {{-- Test Consumer Key --}}
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">
                    {{ translate('consumer_key') }} ({{ translate('test') }})
                </label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="test_consumer_key"
                           value="{{ $pesapalTest['consumer_key'] ?? '' }}"
                           placeholder="{{ translate('enter_test_consumer_key') }}">
                </div>
            </div>

            {{-- Test Consumer Secret --}}
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">
                    {{ translate('consumer_secret') }} ({{ translate('test') }})
                </label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="test_consumer_secret"
                           value="{{ $pesapalTest['consumer_secret'] ?? '' }}"
                           placeholder="{{ translate('enter_test_consumer_secret') }}">
                </div>
            </div>

            {{-- Gateway Image --}}
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">{{ translate('gateway_image') }}</label>
                <div class="col-sm-9">
                    <input type="file" name="gateway_image" class="form-control" accept="image/*">
                    <small class="text-muted">{{ translate('leave_blank_to_keep_existing_image') }}</small>
                </div>
            </div>

            <div class="d-flex justify-content-end mt-4">
                <button type="submit" class="btn btn-primary px-5">
                    {{ translate('save') }}
                </button>
            </div>

        </div>
    </div>
</form>

{{-- Info box about IPN --}}
<div class="alert alert-info mt-3">
    <strong>{{ translate('IPN_URL') }}:</strong>
    <code>{{ route('pesapal.ipn') }}</code>
    <br>
    <small>{{ translate('pesapal_ipn_note') ?? 'This URL is automatically registered with Pesapal when a payment is initiated. No manual setup needed.' }}</small>
</div>