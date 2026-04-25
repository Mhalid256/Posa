<div class="card-header gap-10">
    <h4 class="d-flex align-items-center text-capitalize gap-10 mb-0">
        <img width="20" src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/img/shop-info.png')); ?>" alt="">
        <?php echo e(translate('top_selling_store')); ?>

    </h4>
</div>

<div class="card-body">
    <div class="d-flex flex-column gap-10">
        <?php if($topVendorByEarning): ?>
            <?php $__currentLoopData = $topVendorByEarning; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(isset($vendor->seller->shop)): ?>
                    <div class="border p-20 rounded d-flex align-items-center gap-2 justify-content-between cursor-pointer get-view-by-onclick" data-link="<?php echo e(route('admin.vendors.view', $vendor['seller_id'])); ?>">
                        <div class="d-flex align-items-center gap-10">
                            <img width="35" class="rounded-circle aspect-1" alt="" src="<?php echo e(getStorageImages(path: $vendor->seller->shop->image_full_url,type:'backend-basic')); ?>">

                            <h5 class="mb-0"><?php echo e($vendor->seller->shop['name'] ?? 'Not exist'); ?></h5>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <h5 class="shop-sell mb-0">
                                <?php echo e(setCurrencySymbol(amount: currencyConverter(amount: $vendor['total_earning']))); ?>

                            </h5>
                            <img src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/img/cart2.png')); ?>" alt="">
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
<?php /**PATH C:\Users\musas\Desktop\softwares\6valley\POSA-latest\POSA\resources\views/admin-views/partials/_top-selling-store.blade.php ENDPATH**/ ?>