<?php ($currentCustomerData = $summaryData['currentCustomerData'] ?? null); ?>
<?php ($cartNames = $summaryData['cartNames'] ?? []); ?>
<?php if($summaryData['currentCustomer'] != 'Walking Customer'): ?>
    <div class="pos-home-delivery mb-4">
        <div class="d-flex justify-content-between gap-2 mb-3">
            <div class="d-flex gap-2">
                <i class="tio-user-big"></i>
                <h4 class="card-title"><?php echo e(translate('customer_Information')); ?> </h4>
            </div>
        </div>
        <div class="row gy-2">
            <div class="col-sm-12">
                <div class="pair-list">
                    <div>
                        <span class="key custom-flex-basis"><?php echo e(translate('name')); ?></span>
                        <span>:</span>
                        <span class="value"><?php echo e($currentCustomerData?->f_name.' '.$currentCustomerData?->l_name); ?></span>
                    </div>
                    <div>
                        <span class="key custom-flex-basis"><?php echo e(translate('contact')); ?></span>
                        <span>:</span>
                        <a href="tel:<?php echo e($currentCustomerData?->phone); ?>"
                            class="value text-dark"><?php echo e($currentCustomerData?->phone); ?></a>
                    </div>
                </div>
            </div>

            <?php ( $walletStatus = getWebConfig('wallet_status') ?? 0); ?>
            <?php if($walletStatus): ?>
            <input type="hidden" class="form-control customer-wallet-balance"
                   value="<?php echo e(usdToDefaultCurrency(amount: $currentCustomerData?->wallet_balance ?? 0)); ?>"
                   readonly>
            <?php endif; ?>

        </div>
    </div>
<?php endif; ?>
<div class="d-flex gap-2 flex-wrap mb-3">
    <div class="dropdown flex-grow-1" id="dropdown-order-select">
        <button class="form-control text-start dropdown-toggle d-flex align-items-center justify-content-between" data-bs-toggle="dropdown" id="cart_id_primary">
            <?php echo e(session('current_user')); ?>

        </button>
        <div class="dropdown-menu px-2">
            <?php $__currentLoopData = $cartNames; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cartName): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <button class="dropdown-item border rounded mb-1 action-cart-change" data-cart="<?php echo e($cartName); ?>"><?php echo e($cartName); ?></button>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <button class="dropdown-item border rounded mt-2 action-view-all-hold-orders">
                <span class="d-flex align-items-center gap-2">
                    <i class="tio-pause"></i>
                    <?php echo e(translate('view_all_hold_orders')); ?>

                    <span class="badge text-bg-danger badge-danger rounded-circle"><?php echo e($summaryData['totalHoldOrders']); ?></span>
                </span>
            </button>
        </div>
    </div>
    <a class="btn btn-secondary rounded text-nowrap action-clear-cart">
        <?php echo e(translate('clear_Cart')); ?>

    </a>
    <a class="btn btn-primary rounded text-nowrap action-new-order">
        <?php echo e(translate('new_Order')); ?>

    </a>
</div>

<?php echo $__env->make('admin-views.pos.partials._cart', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\Users\musas\Desktop\softwares\6valley\POSA-latest version\POSA\resources\views/admin-views/pos/partials/_cart-summary.blade.php ENDPATH**/ ?>