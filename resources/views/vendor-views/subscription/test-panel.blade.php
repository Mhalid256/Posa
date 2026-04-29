@extends('layouts.vendor.app')
@section('title', '🧪 Subscription Test Panel')

@section('content')
<div class="content container-fluid">

    {{-- Header --}}
    <div class="mb-4 d-flex align-items-center justify-content-between flex-wrap gap-3">
        <h2 class="h1 mb-0 d-flex align-items-center gap-2">
            🧪 <span>Subscription Test Panel</span>
            <span class="badge text-bg-danger ms-2" style="font-size:12px">LOCAL ONLY</span>
        </h2>
        <a href="{{ route('vendor.dashboard.index') }}" class="btn btn-outline-secondary btn-sm">
            ← Back to Dashboard
        </a>
    </div>

    <div class="row g-3">

        {{-- ── LEFT: Current State ───────────────────────────────────── --}}
        <div class="col-lg-5">

            {{-- Vendor Status Card --}}
            <div class="card mb-3 border-{{ $vendor->status === 'approved' ? 'success' : 'danger' }}">
                <div class="card-header bg-{{ $vendor->status === 'approved' ? 'success' : 'danger' }} text-white">
                    <h5 class="mb-0">👤 Vendor Account Status</h5>
                </div>
                <div class="card-body">
                    <table class="table table-sm table-borderless mb-0">
                        <tr>
                            <td class="text-muted">Name</td>
                            <td><strong>{{ $vendor->f_name }} {{ $vendor->l_name }}</strong></td>
                        </tr>
                        <tr>
                            <td class="text-muted">Email</td>
                            <td>{{ $vendor->email }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Account Status</td>
                            <td>
                                @if($vendor->status === 'approved')
                                    <span class="badge text-bg-success fs-6">✅ ACTIVE</span>
                                @elseif($vendor->status === 'suspended')
                                    <span class="badge text-bg-danger fs-6">🚫 SUSPENDED</span>
                                @else
                                    <span class="badge text-bg-warning fs-6">⚠️ {{ strtoupper($vendor->status) }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted">Monthly Charge</td>
                            <td><strong>{{ number_format($vendor->monthly_charge, 2) }} UGX</strong></td>
                        </tr>
                    </table>
                </div>
            </div>

            {{-- Subscription Status Card --}}
            <div class="card mb-3 border-{{ !$sub ? 'secondary' : ($sub->isExpired() ? 'danger' : ($sub->isExpiringSoon() ? 'warning' : 'success')) }}">
                <div class="card-header bg-{{ !$sub ? 'secondary' : ($sub->isExpired() ? 'danger' : ($sub->isExpiringSoon() ? 'warning' : 'success')) }} text-white">
                    <h5 class="mb-0">💳 Subscription Status</h5>
                </div>
                <div class="card-body">
                    @if(!$sub)
                        <p class="text-muted text-center py-3">No subscription found. Use Reset below.</p>
                    @else
                        <table class="table table-sm table-borderless mb-0">
                            <tr>
                                <td class="text-muted">DB Status</td>
                                <td>
                                    @if($sub->status === 'active')
                                        <span class="badge text-bg-success">ACTIVE</span>
                                    @elseif($sub->status === 'expired')
                                        <span class="badge text-bg-danger">EXPIRED</span>
                                    @else
                                        <span class="badge text-bg-warning">{{ strtoupper($sub->status) }}</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted">Start Date</td>
                                <td>{{ \Carbon\Carbon::parse($sub->start_date)->format('d M Y') }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">End Date</td>
                                <td class="{{ $sub->isExpired() ? 'text-danger fw-bold' : '' }}">
                                    {{ \Carbon\Carbon::parse($sub->end_date)->format('d M Y') }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted">Days Remaining</td>
                                <td>
                                    @php $days = $sub->daysRemaining() @endphp
                                    @if($days < 0)
                                        <span class="text-danger fw-bold">EXPIRED ({{ abs($days) }} days ago)</span>
                                    @elseif($days <= 3)
                                        <span class="text-danger fw-bold">{{ $days }} days ⚠️ CRITICAL</span>
                                    @elseif($days <= 10)
                                        <span class="text-warning fw-bold">{{ $days }} days ⚠️ SOON</span>
                                    @else
                                        <span class="text-success">{{ $days }} days ✅</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted">isExpiringSoon()</td>
                                <td>{{ $sub->isExpiringSoon() ? '✅ TRUE' : '❌ FALSE' }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">isExpired()</td>
                                <td>{{ $sub->isExpired() ? '✅ TRUE' : '❌ FALSE' }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Reminder Sent</td>
                                <td>{{ $sub->reminder_sent_at ? $sub->reminder_sent_at->format('d M H:i') : '—' }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Amount Paid</td>
                                <td>{{ number_format($sub->amount_paid, 2) }} UGX</td>
                            </tr>
                        </table>
                    @endif
                </div>
            </div>

            {{-- Payment History --}}
            @if($payments->count() > 0)
            <div class="card">
                <div class="card-header"><h6 class="mb-0">💰 Payment History ({{ $payments->count() }})</h6></div>
                <div class="card-body p-0">
                    <table class="table table-sm mb-0">
                        <thead class="thead-light"><tr><th>Amount</th><th>Method</th><th>Status</th><th>Date</th></tr></thead>
                        <tbody>
                            @foreach($payments as $p)
                            <tr>
                                <td>{{ number_format($p->amount, 0) }}</td>
                                <td><small>{{ $p->payment_method }}</small></td>
                                <td>
                                    <span class="badge text-bg-{{ $p->status === 'completed' ? 'success' : ($p->status === 'failed' ? 'danger' : 'warning') }}">
                                        {{ $p->status }}
                                    </span>
                                </td>
                                <td><small>{{ $p->created_at->format('d M H:i') }}</small></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
        </div>

        {{-- ── RIGHT: Test Actions ───────────────────────────────────── --}}
        <div class="col-lg-7">

            {{-- Scenario Buttons --}}
            <div class="card mb-3">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">🎮 Test Scenarios — Click to simulate</h5>
                </div>
                <div class="card-body d-flex flex-column gap-3">

                    {{-- Scenario 1 --}}
                    <div class="border rounded p-3">
                        <p class="fw-bold mb-2">📅 Scenario 1: Set subscription to X days remaining</p>
                        <div class="d-flex flex-wrap gap-2">
                            <a href="{{ route('vendor.subscription.test.set-days', 30) }}"
                               class="btn btn-success btn-sm">30 days (Fresh)</a>
                            <a href="{{ route('vendor.subscription.test.set-days', 10) }}"
                               class="btn btn-warning btn-sm">10 days (Reminder trigger)</a>
                            <a href="{{ route('vendor.subscription.test.set-days', 5) }}"
                               class="btn btn-warning btn-sm">5 days (Urgent)</a>
                            <a href="{{ route('vendor.subscription.test.set-days', 2) }}"
                               class="btn btn-danger btn-sm">2 days (Critical)</a>
                            <a href="{{ route('vendor.subscription.test.set-days', 0) }}"
                               class="btn btn-danger btn-sm">0 days (Expires today)</a>
                            <a href="{{ route('vendor.subscription.test.set-days', -1) }}"
                               class="btn btn-dark btn-sm">-1 day (Expired yesterday)</a>
                        </div>
                        <small class="text-muted d-block mt-2">
                            → At 10 days: sidebar shows "Renew Subscription" banner<br>
                            → At 0/-1: admin sees vendor in expired list
                        </small>
                    </div>

                    {{-- Scenario 2 --}}
                    <div class="border rounded p-3">
                        <p class="fw-bold mb-2">💀 Scenario 2: Expire subscription immediately</p>
                        <a href="{{ route('vendor.subscription.test.expire-now') }}"
                           class="btn btn-danger"
                           onclick="return confirm('This will expire your subscription now. Proceed?')">
                            💀 Expire Now (set to yesterday)
                        </a>
                        <small class="text-muted d-block mt-2">
                            → Then check admin panel → Expired Subscriptions tab to see vendor there<br>
                            → Then run Expiry Processor below to get suspended
                        </small>
                    </div>

                    {{-- Scenario 3 --}}
                    <div class="border rounded p-3">
                        <p class="fw-bold mb-2">🔔 Scenario 3: Run the reminder scheduler manually</p>
                        <a href="{{ route('vendor.subscription.test.run-reminder') }}"
                           class="btn btn-info">
                            🔔 Run Reminder Command Now
                        </a>
                        <small class="text-muted d-block mt-2">
                            → Normally runs at 9am daily via scheduler<br>
                            → Will send push notification to vendor's FCM token if registered<br>
                            → Sets reminder_sent_at timestamp (visible in state panel left)
                        </small>
                    </div>

                    {{-- Scenario 4 --}}
                    <div class="border rounded p-3">
                        <p class="fw-bold mb-2">⚙️ Scenario 4: Run the expiry processor (midnight job)</p>
                        <a href="{{ route('vendor.subscription.test.run-expiry-processor') }}"
                           class="btn btn-dark">
                            ⚙️ Run Expiry Processor Now
                        </a>
                        <small class="text-muted d-block mt-2">
                            → Marks past-due subscriptions as expired in DB<br>
                            → Suspends vendors whose subscription expired &gt;3 days ago<br>
                            → After running: refresh this page to see updated status
                        </small>
                    </div>

                    {{-- Scenario 5 --}}
                    <div class="border rounded p-3">
                        <p class="fw-bold mb-2">🚫 Scenario 5: Suspend this vendor (simulate scheduler)</p>
                        <a href="{{ route('vendor.subscription.test.suspend-self') }}"
                           class="btn btn-danger"
                           onclick="return confirm('You will be logged out immediately. You can reactivate from admin panel.')">
                            🚫 Suspend & Logout
                        </a>
                        <small class="text-muted d-block mt-2">
                            → After this: try logging in as vendor — you should be blocked<br>
                            → Go to admin → Vendor Subscriptions → reactivate to test that flow<br>
                            → Or go to admin → Vendors list → manually approve the vendor
                        </small>
                    </div>

                    {{-- Scenario 6 --}}
                    <div class="border rounded p-3">
                        <p class="fw-bold mb-2">💳 Scenario 6: Simulate successful payment (no real Pesapal)</p>
                        <a href="{{ route('vendor.subscription.test.simulate-payment') }}"
                           class="btn btn-success">
                            💳 Simulate Pesapal Payment
                        </a>
                        <small class="text-muted d-block mt-2">
                            → Creates a completed payment record in vendor_subscription_payments<br>
                            → Renews subscription for another 30 days<br>
                            → If vendor was suspended, reactivates them<br>
                            → Check admin payment history after running
                        </small>
                    </div>

                    {{-- Reset --}}
                    <div class="border border-danger rounded p-3">
                        <p class="fw-bold mb-2 text-danger">🔄 Reset everything back to fresh</p>
                        <a href="{{ route('vendor.subscription.test.reset') }}"
                           class="btn btn-outline-danger"
                           onclick="return confirm('This deletes ALL subscription records for this vendor and creates a fresh 30-day one.')">
                            🔄 Reset to Fresh 30-day Subscription
                        </a>
                        <small class="text-muted d-block mt-2">
                            Deletes all subscription and payment records, creates fresh active subscription
                        </small>
                    </div>

                </div>
            </div>

            {{-- Quick links --}}
            <div class="card">
                <div class="card-header"><h6 class="mb-0">🔗 Quick Links to check each feature</h6></div>
                <div class="card-body d-flex flex-wrap gap-2">
                    <a href="{{ route('vendor.subscription.checkout') }}" target="_blank"
                       class="btn btn-outline-primary btn-sm">
                        Checkout / Renew Page
                    </a>
                    <a href="{{ route('vendor.subscription.history') }}" target="_blank"
                       class="btn btn-outline-info btn-sm">
                        My Payment History
                    </a>
                    <a href="{{ route('vendor.dashboard.index') }}" target="_blank"
                       class="btn btn-outline-secondary btn-sm">
                        Vendor Dashboard (check sidebar)
                    </a>
                    <a href="/admin/vendors/subscription/index" target="_blank"
                       class="btn btn-outline-dark btn-sm">
                        Admin Subscription Panel
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection