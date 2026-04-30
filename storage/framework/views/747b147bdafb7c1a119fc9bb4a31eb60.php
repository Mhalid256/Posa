<?php if($totalHoldOrders > 0): ?>
    <div class="table-responsive datatable-custom custom-scrollbar-pos min-h-300">
        <table class="table table-hover table-thead-bordered table-nowrap table-align-middle card-table w-100 text-start">
            <thead class="thead-light thead-50 text-capitalize">
            <tr>
                <th><?php echo e(translate('SL')); ?></th>
                <th><?php echo e(translate('date')); ?></th>
                <th><?php echo e(translate('customer_info')); ?></th>
                <th><?php echo e(translate('quantity')); ?></th>
                <th><?php echo e(translate('total_amount')); ?></th>
                <th class="text-center"><?php echo e(translate('action')); ?></th>
            </tr>
            </thead>

            <tbody>
            <?php if(session()->has('cart_name') && count(session()->get('cart_name')) > 0 ): ?>
                <?php ($totalHoldOrdersCount=1); ?>
                <?php $__currentLoopData = $cartItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $singleCart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($singleCart['customerOnHold']): ?>
                        <tr>
                            <td><?php echo e($totalHoldOrdersCount); ?></td>
                                <?php $totalHoldOrdersCount++; ?>
                            <td>
                                <?php if(isset(session()->get($key)['add_to_cart_time'])): ?>
                                    <div><?php echo e(session()->get($key)['add_to_cart_time']->format('d/m/Y') ?? 'N/a'); ?></div>
                                    <div><?php echo e(session()->get($key)['add_to_cart_time']->format('h:m A') ?? ''); ?></div>
                                <?php else: ?>
                                    <div><?php echo e(translate('now')); ?></div>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div><?php echo e($singleCart['customerName']); ?></div>
                                <a href="tel:<?php echo e($singleCart['customerPhone'] ?? ''); ?>"
                                   class="text-dark"><?php echo e($singleCart['customerPhone'] ?? ''); ?></a>
                            </td>
                            <td>
                                <div class="table-items">
                                    <div class="cursor-pointer">
                                        <?php echo e($singleCart['countItem']); ?> <?php echo e(translate('items')); ?>

                                    </div>
                                    <?php if(session()->has($key) && count(session()->get($key)) > 0): ?>
                                        <div class="bg-white p-0 box-shadow table-items-popup">
                                            <?php $__currentLoopData = $singleCart['cartItemValue']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if(is_array($item)): ?>
                                                    <div class="p-3 border-bottom rounded d-flex justify-content-between gap-2">
                                                        <div class="media gap-2">
                                                            <img width="40" alt="" class="aspect-1 object-fit-cover rounded"
                                                                 src="<?php echo e(getStorageImages(path:$item['image'], type: 'backend-product')); ?>">
                                                            <div class="media-body">
                                                                <h6 class="text-truncate"> <?php echo e(Str::limit($item['name'], 12 )); ?></h6>
                                                                <?php if($item['variant']): ?>
                                                                    <div class="text-muted"><?php echo e(translate('variation')); ?>

                                                                        : <?php echo e($item['variant']); ?></div>
                                                                <?php endif; ?>
                                                                <div class="text-muted"><?php echo e(translate('qty')); ?>

                                                                    : <?php echo e($item['quantity']); ?></div>
                                                            </div>
                                                        </div>
                                                        <h5><?php echo e(setCurrencySymbol(amount: usdToDefaultCurrency(amount: $item['productSubtotal']), currencyCode: getCurrencyCode())); ?></h5>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td>
                                <?php if($singleCart['discountOnProduct']>0): ?>
                                    <del><?php echo e(setCurrencySymbol(amount:usdToDefaultCurrency(amount: round($singleCart['subtotal']+$singleCart['discountOnProduct']+$singleCart['totalTax'], 2)), currencyCode: getCurrencyCode())); ?></del>
                                <?php endif; ?>
                                <?php echo e(setCurrencySymbol(amount: usdToDefaultCurrency(amount: round($singleCart['total']+$singleCart['totalTax'], 2)), currencyCode: getCurrencyCode())); ?>

                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <button type="button" class="btn btn-soft-warning action-cart-change" data-cart="<?php echo e($key); ?>">
                                        <?php echo e(translate('resume')); ?>

                                    </button>
                                    <button type="button" class="btn btn-soft-danger action-cancel-customer-order"
                                            data-cart-id="<?php echo e($key); ?>">
                                        <?php echo e(translate('cancel_order')); ?>

                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <div class="d-flex align-items-center justify-content-center h-100">
        <div>
            <img src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/img/icons/product.svg')); ?>" alt="">
            <h4 class="text-muted text-center mt-4"><?php echo e(translate('No_Order_Found')); ?></h4>
        </div>
    </div>
<?php endif; ?>
<?php /**PATH C:\Users\musas\Desktop\softwares\6valley\POSA-latest version\POSA\resources\views/vendor-views/pos/partials/_view-hold-orders.blade.php ENDPATH**/ ?>