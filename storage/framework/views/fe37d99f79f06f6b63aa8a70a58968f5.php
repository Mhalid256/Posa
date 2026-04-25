<div class="card-header">
    <h4 class="d-flex align-items-center text-capitalize gap-10 mb-0">
        <img width="20" src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/img/top-selling-product-icon.png')); ?>" alt="">
        <?php echo e(translate('top_selling_products')); ?>

    </h4>
</div>

<div class="card-body">
    <?php if($topSell): ?>
        <div class="grid-item-wrap">
            <?php $__currentLoopData = $topSell; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="cursor-pointer"  onclick="location.href='<?php echo e(route('vendor.products.view',[$product['id']])); ?>'">
                        <div class="grid-item bg-transparent basic-box-shadow">
                            <div class="d-flex align-items-center gap-10">
                                <img class="avatar avatar-lg rounded avatar-bordered"
                                     src="<?php echo e(getStorageImages(path:$product->thumbnail_full_url, type: 'backend-product')); ?>"
                                     alt="<?php echo e($product->name); ?> image">
                                <span class="title-color line--limit-2"><?php echo e(substr($product['name'],0,40)); ?> <?php echo e(strlen($product['name'])>20?'...':''); ?></span>
                            </div>
                            <div class="orders-count py-2 px-3 d-flex gap-1">
                                <div><?php echo e(translate('sold')); ?> :</div>
                                <div class="sold-count"><?php echo e($product['order_details_count']); ?></div>
                            </div>
                        </div>
                    </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php else: ?>
        <div class="text-center">
            <p class="text-muted"><?php echo e(translate('no_Top_Selling_Products')); ?></p>
            <img class="w-75" src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/img/no-data.png')); ?>" alt="">
        </div>
    <?php endif; ?>
</div>
<?php /**PATH C:\Users\musas\Desktop\softwares\6valley\POSA-latest\POSA\resources\views/vendor-views/partials/_top-selling-products.blade.php ENDPATH**/ ?>