<div class="card-header">
    <h4 class="d-flex align-items-center text-capitalize gap-10 mb-0">
        <img width="20" src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/img/most-popular-product.png')); ?>" alt="">
        <?php echo e(translate('most_Popular_Products')); ?>

    </h4>
</div>

<div class="card-body">
    <?php if($mostRatedProducts): ?>
        <div class="row">
            <div class="col-12">
                <div class="grid-card-wrap">
                    <?php $__currentLoopData = $mostRatedProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(isset($product['id'])): ?>
                            <div class="border p-20 rounded get-view-by-onclick" data-link="<?php echo e(route('admin.products.view',['addedBy'=>($product['added_by']=='seller'?'vendor' : 'in-house'),'id'=>$product['id']])); ?>">
                                <div class="d-flex align-items-center justify-content-center mb-3">
                                    <img width="60" class="border rounded aspect-1" src="<?php echo e(getStorageImages(path: $product->thumbnail_full_url, type: 'backend-product')); ?>" alt="<?php echo e($product->name); ?><?php echo e(translate('image')); ?>">
                                </div>
                                <div class="fs-12 text-center line-1">
                                    <?php echo e(isset($product['name']) ? $product->name : 'not exists'); ?>

                                </div>

                                <div class="d-flex justify-content-center align-items-center gap-1 fs-10">
                                    <span class="text-warning d-flex align-items-center fw-bold gap-1">
                                        <i class="fi fi-sr-star"></i>
                                        <?php echo e(round($product['ratings_average'],2)); ?>

                                    </span>
                                    <span class="d-flex align-items-center gap-10">
                                        (<?php echo e($product['reviews_count']); ?> <?php echo e(translate('reviews')); ?>)
                                    </span>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="text-center">
            <p class="text-muted"><?php echo e(translate('no_Top_Selling_Products')); ?></p>
            <img class="w-75" src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/img/no-data.png')); ?>" alt="">
        </div>
    <?php endif; ?>
</div>
<?php /**PATH C:\Users\musas\Desktop\softwares\6valley\POSA-latest\POSA\resources\views/admin-views/partials/_most-rated-products.blade.php ENDPATH**/ ?>