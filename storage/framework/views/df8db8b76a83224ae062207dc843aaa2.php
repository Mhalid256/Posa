<div class="card-header">
    <h4 class="d-flex align-items-center text-capitalize gap-10 mb-0">
        <img width="20" src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/img/most-popular-product.png')); ?>" alt="">
        <?php echo e(translate('most_popular_products')); ?>

    </h4>
</div>

<div class="card-body">
    <?php if($topRatedProducts): ?>
        <div class="row">
            <div class="col-12">
                <div class="grid-card-wrap">
                    <?php $__currentLoopData = $topRatedProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="cursor-pointer grid-card basic-box-shadow"
                                 onclick="location.href='<?php echo e(route('vendor.products.view',[$product['id']])); ?>'">
                                <div class="">
                                    <img class="avatar avatar-bordered border-gold avatar-60 rounded"
                                     src="<?php echo e(getStorageImages(path: $product->thumbnail_full_url, type: 'backend-product')); ?>"
                                         alt="<?php echo e($product->name); ?> image">
                                </div>
                                <div class="fs-12 title-color text-center line--limit-1">
                                    <?php echo e(isset($product)?substr($product->name,0,30) . (strlen($product->name)>20?'...':''):'not exists'); ?>

                                </div>
                                <div class="d-flex align-items-center gap-1 fs-10">
                                    <span class="rating-color d-flex align-items-center font-weight-bold gap-1">
                                        <i class="tio-star"></i>
                                        <?php echo e(round($product['ratings_average'],2)); ?>

                                    </span>
                                    <span class="d-flex align-items-center gap-10">
                                        (<?php echo e($product['reviews_count']); ?> <?php echo e(translate('reviews')); ?>)
                                    </span>
                                </div>
                            </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="text-center">
            <p class="text-muted"><?php echo e(translate('no_Top_Selling_Products')); ?></p>
            <img class="w-75" src="<?php echo e(asset('public/assets/back-end/img/no-data.png')); ?>" alt="">
        </div>
    <?php endif; ?>
</div>
<?php /**PATH C:\Users\musas\Desktop\softwares\6valley\POSA-latest\POSA\resources\views/vendor-views/partials/_top-rated-products.blade.php ENDPATH**/ ?>