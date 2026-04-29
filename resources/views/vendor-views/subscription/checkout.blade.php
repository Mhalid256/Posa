@extends('layouts.vendor.app')
@section('title', translate('renew_subscription'))

@section('content')
<div class="content container-fluid">
    <div class="mb-4">
        <h2 class="h1 mb-0 text-capitalize d-flex align-items-center gap-2">
            <i class="fi fi-sr-credit-card fs-4"></i>
            {{ translate('renew_your_subscription') }}
        </h2>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-7">

            {{-- ── Current Subscription Status ─────────────────────────── --}}
            @if($currentSub)
            <div class="card mb-4 border-{{ $currentSub->isExpired() ? 'danger' : ($currentSub->isExpiringSoon() ? 'warning' : 'success') }}">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="flex-shrink-0">
                        <i class="fi fi-sr-{{ $currentSub->isExpired() ? 'cross-circle text-danger' : ($currentSub->isExpiringSoon() ? 'alarm text-warning' : 'check-circle text-success') }} fs-2"></i>
                    </div>
                    <div>
                        <h5 class="mb-1">
                            @if($currentSub->isExpired())
                                {{ translate('your_subscription_has_expired') }}
                            @elseif($currentSub->isExpiringSoon())
                                {{ translate('subscription_expiring_soon') }}
                            @else
                                {{ translate('subscription_active') }}
                            @endif
                        </h5>
                        <p class="mb-0 text-muted">
                            {{ translate('current_period') }}:
                            <strong>{{ \Carbon\Carbon::parse($currentSub->start_date)->format('d M Y') }}</strong>
                            → <strong>{{ \Carbon\Carbon::parse($currentSub->end_date)->format('d M Y') }}</strong>
                            @if(!$currentSub->isExpired())
                                &nbsp;·&nbsp;
                                <span class="fw-semibold {{ $currentSub->daysRemaining() <= 3 ? 'text-danger' : 'text-warning' }}">
                                    {{ $currentSub->daysRemaining() }} {{ translate('days_remaining') }}
                                </span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
            @endif

            {{-- ── Payment Breakdown Card ───────────────────────────────── --}}
            <div class="card">
                <div class="card-header border-bottom">
                    <h5 class="mb-0">{{ translate('subscription_payment') }}</h5>
                </div>
                <div class="card-body">

                    {{-- Breakdown --}}
                    <div class="bg-light rounded p-3 mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-muted">{{ translate('monthly_subscription_fee') }}</span>
                            <span class="fw-semibold">{{ webCurrencyConverter($charge) }}</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-muted">
                                {{ translate('transaction_fee') }}
                                <small class="text-danger">(Pesapal 4%)</small>
                            </span>
                            <span class="fw-semibold text-danger">+ {{ webCurrencyConverter($pesapalFee) }}</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold fs-5">{{ translate('total_amount') }}</span>
                            <span class="fw-bold fs-5 text-primary">{{ webCurrencyConverter($totalAmount) }}</span>
                        </div>
                    </div>

                    {{-- What you get --}}
                    <div class="d-flex align-items-start gap-2 mb-4 p-3 border rounded">
                        <i class="fi fi-sr-check-circle text-success mt-1"></i>
                        <div>
                            <p class="mb-1 fw-semibold">{{ translate('what_you_get') }}</p>
                            <ul class="mb-0 text-muted small ps-3">
                                <li>{{ translate('30_days_of_active_shop_access') }}</li>
                                <li>{{ translate('full_access_to_vendor_dashboard') }}</li>
                                <li>{{ translate('order_and_product_management') }}</li>
                                <li>{{ translate('pos_and_reporting_tools') }}</li>
                            </ul>
                        </div>
                    </div>

                    {{-- New subscription period info --}}
                    <div class="alert alert-info d-flex gap-2 align-items-center">
                        <i class="fi fi-sr-info"></i>
                        <small>
                            {{ translate('after_renewal_your_new_subscription_will_be_valid_for_30_days_from') }}
                            @if($currentSub && !$currentSub->isExpired())
                                <strong>{{ \Carbon\Carbon::parse($currentSub->end_date)->addDay()->format('d M Y') }}</strong>
                            @else
                                <strong>{{ now()->format('d M Y') }}</strong>
                            @endif
                            {{ translate('to') }}
                            @if($currentSub && !$currentSub->isExpired())
                                <strong>{{ \Carbon\Carbon::parse($currentSub->end_date)->addDays(31)->format('d M Y') }}</strong>
                            @else
                                <strong>{{ now()->addDays(30)->format('d M Y') }}</strong>
                            @endif
                        </small>
                    </div>

                    {{-- Pay button --}}
                    <form action="{{ route('vendor.subscription.pay') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-lg w-100 d-flex align-items-center justify-content-center gap-2">
                            <i class="fi fi-sr-credit-card"></i>
                            {{ translate('pay') }} {{ webCurrencyConverter($totalAmount) }} {{ translate('via_pesapal') }}
                        </button>
                    </form>

                    <p class="text-center text-muted small mt-3">
                        <i class="fi fi-rr-shield-check me-1"></i>
                        {{ translate('secure_payment_powered_by_pesapal') }}
                    </p>
                </div>
            </div>

            {{-- ── Payment history link ─────────────────────────────────── --}}
            <div class="text-center mt-3">
                <a href="{{ route('vendor.subscription.history') }}" class="text-muted small">
                    <i class="fi fi-rr-receipt me-1"></i>{{ translate('view_payment_history') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
