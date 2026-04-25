<div class="card-header">
    <h4 class="d-flex align-items-center text-capitalize gap-10 mb-0">
        <img src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/img/top-customers.png')); ?>" alt="">
        <?php echo e(translate('top_Delivery_Man')); ?>

    </h4>
</div>

<div class="card-body">
    <?php if($topRatedDeliveryMan): ?>
        <div class="grid-card-wrap">
            <?php $__currentLoopData = $topRatedDeliveryMan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $deliveryMan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(isset($deliveryMan['id'])): ?>
                    <div class="cursor-pointer get-view-by-onclick" data-link="<?php echo e(route('admin.delivery-man.earning-statement-overview',[$deliveryMan['id']])); ?>">
                        <div class="border p-20 rounded">
                            <div class="text-center mb-2">
                                <img width="50" class="rounded-circle get-view-by-onclick aspect-1" alt=""
                                     src="<?php echo e(getStorageImages(path: $deliveryMan->image_full_url,type:'backend-profile')); ?>"
                                     data-link="<?php echo e(route('admin.delivery-man.earning-statement-overview',[$deliveryMan['id']])); ?>">
                            </div>
                            <h5 class="mb-0 get-view-by-onclick line-1 text-center" data-link="<?php echo e(route('admin.delivery-man.earning-statement-overview',[$deliveryMan['id']])); ?>">
                                <?php echo e(Str::limit($deliveryMan['f_name'].' '.$deliveryMan['l_name'], 25)); ?>

                            </h5>
                            <div class="d-flex justify-content-center">
                                <div class="border orders-count d-inline-flex justify-content-center fs-12 gap-1 mt-2 px-2 py-1 rounded text-nowrap">
                                    <div class="text-capitalize"><?php echo e(translate('order_delivered')); ?> :</div>
                                    <div class="fw-semibold text-primary"><?php echo e($deliveryMan['delivered_orders_count']); ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php else: ?>
        <div class="text-center">
            <p class="text-muted"><?php echo e(translate('no_data_found').'!'); ?></p>
            <img class="w-75" src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/img/no-data.png')); ?>" alt="">
        </div>
    <?php endif; ?>
</div>
<?php /**PATH C:\Users\musas\Desktop\softwares\6valley\POSA-latest\POSA\resources\views/admin-views/partials/_top-delivery-man.blade.php ENDPATH**/ ?>