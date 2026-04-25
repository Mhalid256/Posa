<!-- Header -->
<div class="card-header">
    <h4 class="d-flex align-items-center text-capitalize gap-10 mb-0">
        <img src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/img/top-customers.png')); ?>" alt="">
        <?php echo e(translate('top_customer')); ?>

    </h4>
</div>
<div class="card-body">
    <?php if($top_customer): ?>
        <div class="grid-card-wrap">
            <?php $__currentLoopData = $top_customer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(isset($item->customer)): ?>
                    <a href="<?php echo e(route('admin.customer.view', [$item['customer_id']])); ?>">
                        <div class="border p-20 rounded text-center">
                            <div class="text-center mb-3">
                                <img width="50" class="aspect-1 rounded-circle" src="<?php echo e(getStorageImages(path: $item->customer->image_full_url, type:'backend-profile')); ?>" alt="">
                            </div>

                            <h4 class="mb-0"><?php echo e($item->customer['f_name'] ?? translate('not_exist')); ?></h4>

                            <div class="border orders-count d-inline-flex justify-content-center fs-12 gap-1 mt-2 px-2 py-1 rounded">
                                <div><?php echo e(translate('orders')); ?> : </div>
                                <div class="fw-semibold"><?php echo e($item['count']); ?></div>
                            </div>
                        </div>
                    </a>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php else: ?>
        <div class="text-center">
            <p class="text-muted"><?php echo e(translate('no_Top_Selling_Products')); ?></p>
            <img class="w-75" src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/img/no-data.png')); ?>" alt="">
        </div>
    <?php endif; ?>
</div>
<?php /**PATH C:\Users\musas\Desktop\softwares\6valley\POSA-latest\POSA\resources\views/admin-views/partials/_top-customer.blade.php ENDPATH**/ ?>