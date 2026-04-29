
<?php $__env->startSection('title', '🧪 Subscription Test Panel'); ?>

<?php $__env->startSection('content'); ?>
<div class="content container-fluid">

    
    <div class="mb-4 d-flex align-items-center justify-content-between flex-wrap gap-3">
        <h2 class="h1 mb-0 d-flex align-items-center gap-2">
            🧪 <span>Subscription Test Panel</span>
            <span class="badge text-bg-danger ms-2" style="font-size:12px">LOCAL ONLY</span>
        </h2>
        <a href="<?php echo e(route('vendor.dashboard.index')); ?>" class="btn btn-outline-secondary btn-sm">
            ← Back to Dashboard
        </a>
    </div>

    <div class="row g-3">

        
        <div class="col-lg-5">

            
            <div class="card mb-3 border-<?php echo e($vendor->status === 'approved' ? 'success' : 'danger'); ?>">
                <div class="card-header bg-<?php echo e($vendor->status === 'approved' ? 'success' : 'danger'); ?> text-white">
                    <h5 class="mb-0">👤 Vendor Account Status</h5>
                </div>
                <div class="card-body">
                    <table class="table table-sm table-borderless mb-0">
                        <tr>
                            <td class="text-muted">Name</td>
                            <td><strong><?php echo e($vendor->f_name); ?> <?php echo e($vendor->l_name); ?></strong></td>
                        </tr>
                        <tr>
                            <td class="text-muted">Email</td>
                            <td><?php echo e($vendor->email); ?></td>
                        </tr>
                        <tr>
                            <td class="text-muted">Account Status</td>
                            <td>
                                <?php if($vendor->status === 'approved'): ?>
                                    <span class="badge text-bg-success fs-6">✅ ACTIVE</span>
                                <?php elseif($vendor->status === 'suspended'): ?>
                                    <span class="badge text-bg-danger fs-6">🚫 SUSPENDED</span>
                                <?php else: ?>
                                    <span class="badge text-bg-warning fs-6">⚠️ <?php echo e(strtoupper($vendor->status)); ?></span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted">Monthly Charge</td>
                            <td><strong><?php echo e(number_format($vendor->monthly_charge, 2)); ?> UGX</strong></td>
                        </tr>
                    </table>
                </div>
            </div>

            
            <div class="card mb-3 border-<?php echo e(!$sub ? 'secondary' : ($sub->isExpired() ? 'danger' : ($sub->isExpiringSoon() ? 'warning' : 'success'))); ?>">
                <div class="card-header bg-<?php echo e(!$sub ? 'secondary' : ($sub->isExpired() ? 'danger' : ($sub->isExpiringSoon() ? 'warning' : 'success'))); ?> text-white">
                    <h5 class="mb-0">💳 Subscription Status</h5>
                </div>
                <div class="card-body">
                    <?php if(!$sub): ?>
                        <p class="text-muted text-center py-3">No subscription found. Use Reset below.</p>
                    <?php else: ?>
                        <table class="table table-sm table-borderless mb-0">
                            <tr>
                                <td class="text-muted">DB Status</td>
                                <td>
                                    <?php if($sub->status === 'active'): ?>
                                        <span class="badge text-bg-success">ACTIVE</span>
                                    <?php elseif($sub->status === 'expired'): ?>
                                        <span class="badge text-bg-danger">EXPIRED</span>
                                    <?php else: ?>
                                        <span class="badge text-bg-warning"><?php echo e(strtoupper($sub->status)); ?></span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted">Start Date</td>
                                <td><?php echo e(\Carbon\Carbon::parse($sub->start_date)->format('d M Y')); ?></td>
                            </tr>
                            <tr>
                                <td class="text-muted">End Date</td>
                                <td class="<?php echo e($sub->isExpired() ? 'text-danger fw-bold' : ''); ?>">
                                    <?php echo e(\Carbon\Carbon::parse($sub->end_date)->format('d M Y')); ?>

                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted">Days Remaining</td>
                                <td>
                                    <?php $days = $sub->daysRemaining() ?>
                                    <?php if($days < 0): ?>
                                        <span class="text-danger fw-bold">EXPIRED (<?php echo e(abs($days)); ?> days ago)</span>
                                    <?php elseif($days <= 3): ?>
                                        <span class="text-danger fw-bold"><?php echo e($days); ?> days ⚠️ CRITICAL</span>
                                    <?php elseif($days <= 10): ?>
                                        <span class="text-warning fw-bold"><?php echo e($days); ?> days ⚠️ SOON</span>
                                    <?php else: ?>
                                        <span class="text-success"><?php echo e($days); ?> days ✅</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted">isExpiringSoon()</td>
                                <td><?php echo e($sub->isExpiringSoon() ? '✅ TRUE' : '❌ FALSE'); ?></td>
                            </tr>
                            <tr>
                                <td class="text-muted">isExpired()</td>
                                <td><?php echo e($sub->isExpired() ? '✅ TRUE' : '❌ FALSE'); ?></td>
                            </tr>
                            <tr>
                                <td class="text-muted">Reminder Sent</td>
                                <td><?php echo e($sub->reminder_sent_at ? $sub->reminder_sent_at->format('d M H:i') : '—'); ?></td>
                            </tr>
                            <tr>
                                <td class="text-muted">Amount Paid</td>
                                <td><?php echo e(number_format($sub->amount_paid, 2)); ?> UGX</td>
                            </tr>
                        </table>
                    <?php endif; ?>
                </div>
            </div>

            
            <?php if($payments->count() > 0): ?>
            <div class="card">
                <div class="card-header"><h6 class="mb-0">💰 Payment History (<?php echo e($payments->count()); ?>)</h6></div>
                <div class="card-body p-0">
                    <table class="table table-sm mb-0">
                        <thead class="thead-light"><tr><th>Amount</th><th>Method</th><th>Status</th><th>Date</th></tr></thead>
                        <tbody>
                            <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e(number_format($p->amount, 0)); ?></td>
                                <td><small><?php echo e($p->payment_method); ?></small></td>
                                <td>
                                    <span class="badge text-bg-<?php echo e($p->status === 'completed' ? 'success' : ($p->status === 'failed' ? 'danger' : 'warning')); ?>">
                                        <?php echo e($p->status); ?>

                                    </span>
                                </td>
                                <td><small><?php echo e($p->created_at->format('d M H:i')); ?></small></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php endif; ?>
        </div>

        
        <div class="col-lg-7">

            
            <div class="card mb-3">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">🎮 Test Scenarios — Click to simulate</h5>
                </div>
                <div class="card-body d-flex flex-column gap-3">

                    
                    <div class="border rounded p-3">
                        <p class="fw-bold mb-2">📅 Scenario 1: Set subscription to X days remaining</p>
                        <div class="d-flex flex-wrap gap-2">
                            <a href="<?php echo e(route('vendor.subscription.test.set-days', 30)); ?>"
                               class="btn btn-success btn-sm">30 days (Fresh)</a>
                            <a href="<?php echo e(route('vendor.subscription.test.set-days', 10)); ?>"
                               class="btn btn-warning btn-sm">10 days (Reminder trigger)</a>
                            <a href="<?php echo e(route('vendor.subscription.test.set-days', 5)); ?>"
                               class="btn btn-warning btn-sm">5 days (Urgent)</a>
                            <a href="<?php echo e(route('vendor.subscription.test.set-days', 2)); ?>"
                               class="btn btn-danger btn-sm">2 days (Critical)</a>
                            <a href="<?php echo e(route('vendor.subscription.test.set-days', 0)); ?>"
                               class="btn btn-danger btn-sm">0 days (Expires today)</a>
                            <a href="<?php echo e(route('vendor.subscription.test.set-days', -1)); ?>"
                               class="btn btn-dark btn-sm">-1 day (Expired yesterday)</a>
                        </div>
                        <small class="text-muted d-block mt-2">
                            → At 10 days: sidebar shows "Renew Subscription" banner<br>
                            → At 0/-1: admin sees vendor in expired list
                        </small>
                    </div>

                    
                    <div class="border rounded p-3">
                        <p class="fw-bold mb-2">💀 Scenario 2: Expire subscription immediately</p>
                        <a href="<?php echo e(route('vendor.subscription.test.expire-now')); ?>"
                           class="btn btn-danger"
                           onclick="return confirm('This will expire your subscription now. Proceed?')">
                            💀 Expire Now (set to yesterday)
                        </a>
                        <small class="text-muted d-block mt-2">
                            → Then check admin panel → Expired Subscriptions tab to see vendor there<br>
                            → Then run Expiry Processor below to get suspended
                        </small>
                    </div>

                    
                    <div class="border rounded p-3">
                        <p class="fw-bold mb-2">🔔 Scenario 3: Run the reminder scheduler manually</p>
                        <a href="<?php echo e(route('vendor.subscription.test.run-reminder')); ?>"
                           class="btn btn-info">
                            🔔 Run Reminder Command Now
                        </a>
                        <small class="text-muted d-block mt-2">
                            → Normally runs at 9am daily via scheduler<br>
                            → Will send push notification to vendor's FCM token if registered<br>
                            → Sets reminder_sent_at timestamp (visible in state panel left)
                        </small>
                    </div>

                    
                    <div class="border rounded p-3">
                        <p class="fw-bold mb-2">⚙️ Scenario 4: Run the expiry processor (midnight job)</p>
                        <a href="<?php echo e(route('vendor.subscription.test.run-expiry-processor')); ?>"
                           class="btn btn-dark">
                            ⚙️ Run Expiry Processor Now
                        </a>
                        <small class="text-muted d-block mt-2">
                            → Marks past-due subscriptions as expired in DB<br>
                            → Suspends vendors whose subscription expired &gt;3 days ago<br>
                            → After running: refresh this page to see updated status
                        </small>
                    </div>

                    
                    <div class="border rounded p-3">
                        <p class="fw-bold mb-2">🚫 Scenario 5: Suspend this vendor (simulate scheduler)</p>
                        <a href="<?php echo e(route('vendor.subscription.test.suspend-self')); ?>"
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

                    
                    <div class="border rounded p-3">
                        <p class="fw-bold mb-2">💳 Scenario 6: Simulate successful payment (no real Pesapal)</p>
                        <a href="<?php echo e(route('vendor.subscription.test.simulate-payment')); ?>"
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

                    
                    <div class="border border-danger rounded p-3">
                        <p class="fw-bold mb-2 text-danger">🔄 Reset everything back to fresh</p>
                        <a href="<?php echo e(route('vendor.subscription.test.reset')); ?>"
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

            
            <div class="card">
                <div class="card-header"><h6 class="mb-0">🔗 Quick Links to check each feature</h6></div>
                <div class="card-body d-flex flex-wrap gap-2">
                    <a href="<?php echo e(route('vendor.subscription.checkout')); ?>" target="_blank"
                       class="btn btn-outline-primary btn-sm">
                        Checkout / Renew Page
                    </a>
                    <a href="<?php echo e(route('vendor.subscription.history')); ?>" target="_blank"
                       class="btn btn-outline-info btn-sm">
                        My Payment History
                    </a>
                    <a href="<?php echo e(route('vendor.dashboard.index')); ?>" target="_blank"
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.vendor.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\musas\Desktop\softwares\6valley\POSA-latest version\POSA\resources\views/vendor-views/subscription/test-panel.blade.php ENDPATH**/ ?>