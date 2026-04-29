@extends('layouts.vendor.app')
@section('title', translate('subscription_history'))

@section('content')
<div class="content container-fluid">
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <h2 class="h1 mb-0 text-capitalize d-flex align-items-center gap-2">
            <i class="fi fi-sr-receipt fs-4"></i>
            {{ translate('subscription_history') }}
        </h2>
        <a href="{{ route('vendor.subscription.checkout') }}" class="btn btn-primary">
            <i class="fi fi-rr-refresh me-1"></i>{{ translate('renew_subscription') }}
        </a>
    </div>

    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="thead-light">
                        <tr>
                            <th>{{ translate('SL') }}</th>
                            <th>{{ translate('period') }}</th>
                            <th>{{ translate('amount_paid') }}</th>
                            <th>{{ translate('payment_method') }}</th>
                            <th>{{ translate('reference') }}</th>
                            <th>{{ translate('status') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($subscriptions as $k => $sub)
                        <tr>
                            <td>{{ $subscriptions->firstItem() + $k }}</td>
                            <td>
                                {{ \Carbon\Carbon::parse($sub->start_date)->format('d M Y') }}
                                → {{ \Carbon\Carbon::parse($sub->end_date)->format('d M Y') }}
                            </td>
                            <td>{{ webCurrencyConverter($sub->amount_paid) }}</td>
                            <td class="text-capitalize">{{ str_replace('_', ' ', $sub->payment_method) }}</td>
                            <td><small class="text-muted">{{ $sub->payment_reference ?? '-' }}</small></td>
                            <td>
                                @if($sub->status === 'active')
                                    <span class="badge text-bg-success">{{ translate('active') }}</span>
                                @elseif($sub->status === 'expired')
                                    <span class="badge text-bg-danger">{{ translate('expired') }}</span>
                                @else
                                    <span class="badge text-bg-warning">{{ $sub->status }}</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="fi fi-rr-receipt fs-2 d-block mb-2"></i>
                                {{ translate('no_subscription_history_found') }}
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-4 py-3 d-flex justify-content-end">{{ $subscriptions->links() }}</div>
        </div>
    </div>
</div>
@endsection
