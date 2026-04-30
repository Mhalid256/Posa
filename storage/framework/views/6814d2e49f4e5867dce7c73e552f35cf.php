<div class="pb-4">
    <a class="d-flex align-items-center" href="<?php echo e(route('vendor.products.view', ['addedBy' => ($product['added_by']=='seller'?'vendor' : 'in-house'), 'id' => $product['id']])); ?>">
        <div class="avatar rounded avatar-70 border">
            <img class="avatar-img" src="<?php echo e(getStorageImages(path: $product->thumbnail_full_url, type:'backend-product')); ?>" alt="">
        </div>
        <div class="ml-3">
            <div class="d-block">
                <span class="line--limit-2 h5 text-hover-primary mb-2">
               <?php echo e($product['name']); ?>

            </span>
            </div>
            <span class="d-block font-size-sm text-body">
                <?php echo e(translate('Price')); ?> : <?php echo e(setCurrencySymbol(amount: usdToDefaultCurrency(amount: $product['unit_price']), currencyCode: getCurrencyCode())); ?>

            </span>
        </div>
    </a>
</div>
<div class="card-body bg-soft-secondary rounded mb-4">
    <input name="product_id" value="<?php echo e($product['id']); ?>" class="d-none">
    <div id="quantity" class="mb-3">
        <label class="form-label text-dark"><?php echo e(translate('main_stock')); ?></label>
        <input type="number" min="0" value=<?php echo e($product->current_stock); ?> step="1" placeholder="<?php echo e(translate('main_stock')); ?>" name="current_stock" class="form-control bg-white"<?php if(!empty($product['variation']) && count(json_decode($product['variation'], true)) > 0): ?>  readonly <?php endif; ?> required>
    </div>
    <?php if($product['variation'] && count(json_decode($product['variation'], true)) > 0): ?>
        <div>
            <label class="form-label text-dark"><?php echo e(translate('Variations_Stock')); ?></label>
            <div class="bg-white p-2 rounded">
                <div class="sku_combination py-2" id="sku_combination">
                    <?php if($restockId): ?>
                        <?php echo $__env->make('vendor-views.product.partials._edit-restock-combinations', ['combinations'=>json_decode($product['variation'], true)], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <input type="hidden" name="restock_id" id="" value="<?php echo e($restockId); ?>">
                    <?php else: ?>
                        <?php echo $__env->make('vendor-views.product.partials._edit-sku-combinations', ['combinations'=>json_decode($product['variation'], true)], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
<?php /**PATH C:\Users\musas\Desktop\softwares\6valley\POSA-latest version\POSA\resources\views/vendor-views/product/partials/_update-stock.blade.php ENDPATH**/ ?>