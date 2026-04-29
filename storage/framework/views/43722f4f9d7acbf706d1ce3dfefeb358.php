
<?php $__env->startSection('title', translate('renew_subscription')); ?>

<?php $__env->startSection('content'); ?>
<div class="content container-fluid">
    <div class="mb-4">
        <h2 class="h1 mb-0 text-capitalize d-flex align-items-center gap-2">
            <i class="fi fi-sr-credit-card fs-4"></i>
            <?php echo e(translate('renew_your_subscription')); ?>

        </h2>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-7">

            
            <?php if($currentSub): ?>
            <div class="card mb-4 border-<?php echo e($currentSub->isExpired() ? 'danger' : ($currentSub->isExpiringSoon() ? 'warning' : 'success')); ?>">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="flex-shrink-0">
                        <i class="fi fi-sr-<?php echo e($currentSub->isExpired() ? 'cross-circle text-danger' : ($currentSub->isExpiringSoon() ? 'alarm text-warning' : 'check-circle text-success')); ?> fs-2"></i>
                    </div>
                    <div>
                        <h5 class="mb-1">
                            <?php if($currentSub->isExpired()): ?>
                                <?php echo e(translate('your_subscription_has_expired')); ?>

                            <?php elseif($currentSub->isExpiringSoon()): ?>
                                <?php echo e(translate('subscription_expiring_soon')); ?>

                            <?php else: ?>
                                <?php echo e(translate('subscription_active')); ?>

                            <?php endif; ?>
                        </h5>
                        <p class="mb-0 text-muted">
                            <?php echo e(translate('current_period')); ?>:
                            <strong><?php echo e(\Carbon\Carbon::parse($currentSub->start_date)->format('d M Y')); ?></strong>
                            → <strong><?php echo e(\Carbon\Carbon::parse($currentSub->end_date)->format('d M Y')); ?></strong>
                            <?php if(!$currentSub->isExpired()): ?>
                                &nbsp;·&nbsp;
                                <span class="fw-semibold <?php echo e($currentSub->daysRemaining() <= 3 ? 'text-danger' : 'text-warning'); ?>">
                                    <?php echo e($currentSub->daysRemaining()); ?> <?php echo e(translate('days_remaining')); ?>

                                </span>
                            <?php endif; ?>
                        </p>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            
            <div class="card">
                <div class="card-header border-bottom">
                    <h5 class="mb-0"><?php echo e(translate('subscription_payment')); ?></h5>
                </div>
                <div class="card-body">

                    
                    <div class="bg-light rounded p-3 mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-muted"><?php echo e(translate('monthly_subscription_fee')); ?></span>
                            <span class="fw-semibold"><?php echo e(webCurrencyConverter($charge)); ?></span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-muted">
                                <?php echo e(translate('transaction_fee')); ?>

                                <small class="text-danger">(Pesapal 4%)</small>
                            </span>
                            <span class="fw-semibold text-danger">+ <?php echo e(webCurrencyConverter($pesapalFee)); ?></span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold fs-5"><?php echo e(translate('total_amount')); ?></span>
                            <span class="fw-bold fs-5 text-primary"><?php echo e(webCurrencyConverter($totalAmount)); ?></span>
                        </div>
                    </div>

                    
                    <div class="d-flex align-items-start gap-2 mb-4 p-3 border rounded">
                        <i class="fi fi-sr-check-circle text-success mt-1"></i>
                        <div>
                            <p class="mb-1 fw-semibold"><?php echo e(translate('what_you_get')); ?></p>
                            <ul class="mb-0 text-muted small ps-3">
                                <li><?php echo e(translate('30_days_of_active_shop_access')); ?></li>
                                <li><?php echo e(translate('full_access_to_vendor_dashboard')); ?></li>
                                <li><?php echo e(translate('order_and_product_management')); ?></li>
                                <li><?php echo e(translate('pos_and_reporting_tools')); ?></li>
                            </ul>
                        </div>
                    </div>

                    
                    <div class="alert alert-info d-flex gap-2 align-items-center">
                        <i class="fi fi-sr-info"></i>
                        <small>
                            <?php echo e(translate('after_renewal_your_new_subscription_will_be_valid_for_30_days_from')); ?>

                            <?php if($currentSub && !$currentSub->isExpired()): ?>
                                <strong><?php echo e(\Carbon\Carbon::parse($currentSub->end_date)->addDay()->format('d M Y')); ?></strong>
                            <?php else: ?>
                                <strong><?php echo e(now()->format('d M Y')); ?></strong>
                            <?php endif; ?>
                            <?php echo e(translate('to')); ?>

                            <?php if($currentSub && !$currentSub->isExpired()): ?>
                                <strong><?php echo e(\Carbon\Carbon::parse($currentSub->end_date)->addDays(31)->format('d M Y')); ?></strong>
                            <?php else: ?>
                                <strong><?php echo e(now()->addDays(30)->format('d M Y')); ?></strong>
                            <?php endif; ?>
                        </small>
                    </div>

                    
                    <form action="<?php echo e(route('vendor.subscription.pay')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn btn-primary btn-lg w-100 d-flex align-items-center justify-content-center gap-2">
                            <i class="fi fi-sr-credit-card"></i>
                            <?php echo e(translate('pay')); ?> <?php echo e(webCurrencyConverter($totalAmount)); ?> <?php echo e(translate('via_pesapal')); ?>

                        </button>
                    </form>

                    <p class="text-center text-muted small mt-3">
                        <i class="fi fi-rr-shield-check me-1"></i>
                        <?php echo e(translate('secure_payment_powered_by_pesapal')); ?>

                    </p>
                </div>
            </div>

            
            <div class="text-center mt-3">
                <a href="<?php echo e(route('vendor.subscription.history')); ?>" class="text-muted small">
                    <i class="fi fi-rr-receipt me-1"></i><?php echo e(translate('view_payment_history')); ?>

                </a>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.vendor.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\musas\Desktop\softwares\6valley\POSA-latest version\POSA\resources\views/vendor-views/subscription/checkout.blade.php ENDPATH**/ ?>