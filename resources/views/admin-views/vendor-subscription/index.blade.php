@extends('layouts.admin.app')
@section('title', translate('vendor_subscription_management'))

@section('content')
<div class="content container-fluid">
    <div class="mb-4">
        <h2 class="h1 mb-0 text-capitalize d-flex align-items-center gap-2">
            <i class="fi fi-sr-credit-card fs-4"></i>
            {{ translate('vendor_subscription_management') }}
        </h2>
    </div>

    {{-- ── Summary Cards ─────────────────────────────────────────────── --}}
    <div class="row g-3 mb-4">
        <div class="col-sm-6 col-xl-3">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="flex-shrink-0 bg-success-light rounded-circle p-3">
                        <i class="fi fi-sr-check-circle text-success fs-4"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-1 small">{{ translate('active_subscriptions') }}</p>
                        <h3 class="mb-0">{{ $active->total() }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="flex-shrink-0 bg-warning-light rounded-circle p-3">
                        <i class="fi fi-sr-alarm text-warning fs-4"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-1 small">{{ translate('expiring_in_10_days') }}</p>
                        <h3 class="mb-0 text-warning">{{ $expiringSoon->count() }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="flex-shrink-0 bg-danger-light rounded-circle p-3">
                        <i class="fi fi-sr-cross-circle text-danger fs-4"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-1 small">{{ translate('expired_subscriptions') }}</p>
                        <h3 class="mb-0 text-danger">{{ $expired->total() }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="flex-shrink-0 bg-info-light rounded-circle p-3">
                        <i class="fi fi-sr-receipt text-info fs-4"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-1 small">{{ translate('total_payments_collected') }}</p>
                        <h3 class="mb-0">{{ webCurrencyConverter($payments->sum('amount')) }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ── Expiring Soon (URGENT) ──────────────────────────────────────── --}}
    @if($expiringSoon->count() > 0)
    <div class="card border-warning mb-4">
        <div class="card-header bg-warning-light d-flex align-items-center gap-2">
            <i class="fi fi-sr-alarm text-warning"></i>
            <h5 class="mb-0 text-warning">{{ translate('expiring_soon') }} — {{ translate('action_required') }}</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th>{{ translate('vendor_shop') }}</th>
                            <th>{{ translate('expiry_date') }}</th>
                            <th>{{ translate('days_left') }}</th>
                            <th>{{ translate('monthly_charge') }}</th>
                            <th>{{ translate('reminder_sent') }}</th>
                            <th class="text-center">{{ translate('action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($expiringSoon as $sub)
                        <tr>
                            <td>
                                <div>
                                    <strong>{{ $sub->vendor->shop?->name ?? translate('N/A') }}</strong>
                                    <small class="d-block text-muted">{{ $sub->vendor->email }}</small>
                                </div>
                            </td>
                            <td>{{ $sub->end_date->format('d M Y') }}</td>
                            <td>
                                <span class="badge {{ $sub->daysRemaining() <= 3 ? 'text-bg-danger' : 'text-bg-warning' }}">
                                    {{ $sub->daysRemaining() }} {{ translate('days') }}
                                </span>
                            </td>
                            <td>{{ webCurrencyConverter($sub->vendor->monthly_charge) }}</td>
                            <td>
                                @if($sub->reminder_sent_at)
                                    <span class="badge text-bg-success">{{ $sub->reminder_sent_at->format('d M H:i') }}</span>
                                @else
                                    <span class="badge text-bg-secondary">{{ translate('not_sent') }}</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="d-flex gap-2 justify-content-center">
                                    <a href="{{ route('admin.vendors.subscription.history', $sub->vendor_id) }}"
                                       class="btn btn-outline-info btn-sm icon-btn" title="{{ translate('view_history') }}">
                                        <i class="fi fi-rr-eye"></i>
                                    </a>
                                    <form action="{{ route('admin.vendors.subscription.suspend') }}" method="POST" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="vendor_id" value="{{ $sub->vendor_id }}">
                                        <button type="submit" class="btn btn-outline-danger btn-sm icon-btn"
                                                onclick="return confirm('{{ translate('suspend_this_vendor') }}?')"
                                                title="{{ translate('suspend') }}">
                                            <i class="fi fi-rr-ban"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif

    {{-- ── Expired Subscriptions ───────────────────────────────────────── --}}
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">{{ translate('expired_subscriptions') }}</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th>{{ translate('vendor_shop') }}</th>
                            <th>{{ translate('expired_on') }}</th>
                            <th>{{ translate('amount_paid') }}</th>
                            <th>{{ translate('vendor_status') }}</th>
                            <th class="text-center">{{ translate('action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($expired as $sub)
                        <tr>
                            <td>
                                <div>
                                    <strong>{{ $sub->vendor->shop?->name ?? translate('N/A') }}</strong>
                                    <small class="d-block text-muted">{{ $sub->vendor->email }}</small>
                                </div>
                            </td>
                            <td><span class="text-danger">{{ $sub->end_date->format('d M Y') }}</span></td>
                            <td>{{ webCurrencyConverter($sub->amount_paid) }}</td>
                            <td>
                                @if($sub->vendor->status === 'approved')
                                    <span class="badge text-bg-success">{{ translate('active') }}</span>
                                @elseif($sub->vendor->status === 'suspended')
                                    <span class="badge text-bg-danger">{{ translate('suspended') }}</span>
                                @else
                                    <span class="badge text-bg-secondary">{{ $sub->vendor->status }}</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="d-flex gap-2 justify-content-center">
                                    @if($sub->vendor->status !== 'suspended')
                                    <form action="{{ route('admin.vendors.subscription.suspend') }}" method="POST" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="vendor_id" value="{{ $sub->vendor_id }}">
                                        <button type="submit" class="btn btn-outline-danger btn-sm"
                                                onclick="return confirm('{{ translate('suspend_this_vendor') }}?')">
                                            {{ translate('suspend') }}
                                        </button>
                                    </form>
                                    @else
                                    <form action="{{ route('admin.vendors.subscription.reactivate') }}" method="POST" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="vendor_id" value="{{ $sub->vendor_id }}">
                                        <button type="submit" class="btn btn-outline-success btn-sm">
                                            {{ translate('reactivate') }}
                                        </button>
                                    </form>
                                    @endif
                                    <a href="{{ route('admin.vendors.subscription.history', $sub->vendor_id) }}"
                                       class="btn btn-outline-info btn-sm">{{ translate('history') }}</a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-center py-4 text-muted">{{ translate('no_expired_subscriptions') }}</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-4 py-3 d-flex justify-content-end">{{ $expired->links() }}</div>
        </div>
    </div>

    {{-- ── Payment History ─────────────────────────────────────────────── --}}
    <div class="card">
        <div class="card-header"><h5 class="mb-0">{{ translate('payment_history') }}</h5></div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th>{{ translate('SL') }}</th>
                            <th>{{ translate('vendor') }}</th>
                            <th>{{ translate('amount') }}</th>
                            <th>{{ translate('method') }}</th>
                            <th>{{ translate('reference') }}</th>
                            <th>{{ translate('paid_on') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($payments as $k => $payment)
                        <tr>
                            <td>{{ $payments->firstItem() + $k }}</td>
                            <td>{{ $payment->vendor->shop?->name ?? $payment->vendor->email }}</td>
                            <td class="fw-semibold text-success">{{ webCurrencyConverter($payment->amount) }}</td>
                            <td><span class="badge text-bg-info text-capitalize">{{ $payment->payment_method }}</span></td>
                            <td><small class="text-muted">{{ $payment->transaction_ref ?? translate('N/A') }}</small></td>
                            <td>{{ $payment->paid_at?->format('d M Y H:i') }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="6" class="text-center py-4 text-muted">{{ translate('no_payments_yet') }}</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-4 py-3 d-flex justify-content-end">{{ $payments->links() }}</div>
        </div>
    </div>
</div>
@endsection
