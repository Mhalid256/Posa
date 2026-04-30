<?php if(count($combinations) > 0): ?>
    <table class="table physical_product_show table-borderless">
        <thead class="thead-light thead-50 text-capitalize">
        <tr>
            <th class="text-center">
                <label for="" class="control-label">
                    <?php echo e(translate('SL')); ?>

                </label>
            </th>
            <th class="text-center">
                <label for="" class="control-label">
                    <?php echo e(translate('attribute_Variation')); ?>

                </label>
            </th>
            <th class="text-center">
                <label for="" class="control-label">
                    <?php echo e(translate('variation_Wise_Price')); ?>

                    (<?php echo e(getCurrencySymbol()); ?>)
                </label>
            </th>
            <th class="text-center">
                <label for="" class="control-label">
                    <?php echo e(translate('SKU')); ?>

                </label>
            </th>
            <th class="text-center">
                <label for="" class="control-label">
                    <?php echo e(translate('Variation_Wise_Stock')); ?>

                </label>
            </th>
        </tr>
        </thead>
        <tbody>

        <?php $__currentLoopData = $combinations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $combination): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td class="text-center">
                    <?php echo e($key+1); ?>

                </td>
                <td>
                    <label for="" class="control-label"><?php echo e($combination['type']); ?></label>
                    <input value="<?php echo e($combination['type']); ?>" name="type[]" class="d-none">
                </td>
                <td>
                    <input type="number" name="price_<?php echo e($combination['type']); ?>"
                           value="<?php echo e(usdToDefaultCurrency(amount: $combination['price'])); ?>" min="0"
                           step="0.01"
                           class="form-control" required placeholder="<?php echo e(translate('ex')); ?>: <?php echo e(translate('535')); ?>">
                </td>
                <td>
                    <input type="text" name="sku_<?php echo e($combination['type']); ?>" value="<?php echo e($combination['sku']); ?>"
                           class="form-control store-keeping-unit">
                </td>
                <td>
                    <input type="number" name="qty_<?php echo e($combination['type']); ?>"
                           value="<?php echo e($combination['qty']); ?>" min="0" max="100000" step="1"
                           class="form-control" placeholder="<?php echo e(translate('ex')); ?>: <?php echo e(translate('5')); ?>"
                           required>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
<?php endif; ?>
<?php /**PATH C:\Users\musas\Desktop\softwares\6valley\POSA-latest version\POSA\resources\views/vendor-views/product/partials/_edit-sku-combinations.blade.php ENDPATH**/ ?>