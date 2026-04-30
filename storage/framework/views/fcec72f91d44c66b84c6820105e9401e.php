<?php if(count($products) > 0): ?>
    <?php ($decimal_point_settings = getWebConfig(name: 'decimal_point_settings')); ?>
    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if(!empty($product['product_id'])): ?>
            <?php ($product=$product->product); ?>
        <?php endif; ?>

        <div class="col-lg-3 col-md-3 col-sm-4 col-6 p-2">
            <?php if(!empty($product)): ?>
                <?php echo $__env->make('web-views.partials._filter-single-product',['product'=>$product, 'decimal_point_settings'=>$decimal_point_settings], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <div class="col-12">
        <nav class="d-flex justify-content-between pt-2" aria-label="Page navigation"
             id="paginator-ajax">
            <?php echo $products->links(); ?>

        </nav>
    </div>
<?php else: ?>
    <div class="d-flex justify-content-center align-items-center w-100 py-5">
        <div>
            <img src="<?php echo e(theme_asset(path: 'public/assets/front-end/img/media/product.svg')); ?>" class="img-fluid" alt="">
            <h6 class="text-muted"><?php echo e(translate('no_product_found')); ?></h6>
        </div>
    </div>
<?php endif; ?>
<?php /**PATH C:\Users\musas\Desktop\softwares\6valley\POSA-latest version\POSA\resources\themes\default/web-views/products/_ajax-products.blade.php ENDPATH**/ ?>