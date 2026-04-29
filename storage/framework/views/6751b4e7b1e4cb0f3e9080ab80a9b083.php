<div class="card-header gap-10">
    <h4 class="d-flex align-items-center text-capitalize gap-10 mb-0">
        <img width="20" src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/img/top-selling-product-icon.png')); ?>" alt="">
        <?php echo e(translate('top_selling_products')); ?>

    </h4>
</div>

<div class="card-body">
    <div class="d-flex flex-column gap-10">
        <?php if(isset($topSellProduct)): ?>
            <?php $__currentLoopData = $topSellProduct; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(isset($product['id'])): ?>
                    <div class="cursor-pointer get-view-by-onclick" data-link="<?php echo e(route('admin.products.view',['addedBy'=>($product['added_by']=='seller'?'vendor' : 'in-house'),'id'=>$product['id']])); ?>">
                        <div class="border p-20 rounded d-flex align-items-center gap-2 justify-content-between">
                            <div class="d-flex gap-10 align-items-center">
                                <img width="50" src="<?php echo e(getStorageImages(path: $product->thumbnail_full_url, type: 'backend-product')); ?>" class="rounded border aspect-1"
                                     alt="<?php echo e($product['name'].'_'.translate('image')); ?>">
                                <div class="fs-12 line-1"><?php echo e($product['name']); ?></div>
                            </div>

                            <div class="border orders-count d-inline-flex justify-content-center fs-12 gap-1 mt-2 px-2 py-1 rounded text-nowrap">
                                <div><?php echo e(translate('sold')); ?> :</div>
                                <div class="fw-semibold text-primary"><?php echo e($product['order_details_count']); ?></div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <div class="text-center">
                <p class="text-muted"><?php echo e(translate('no_Top_Selling_Products')); ?></p>
                <img class="w-75" src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/img/no-data.png')); ?>" alt="">
            </div>
        <?php endif; ?>
    </div>
</div>
<?php /**PATH C:\Users\musas\Desktop\softwares\6valley\POSA-latest version\POSA\resources\views/admin-views/partials/_top-selling-products.blade.php ENDPATH**/ ?>