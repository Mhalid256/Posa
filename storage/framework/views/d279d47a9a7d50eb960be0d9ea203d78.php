<?php if($web_config['digital_product_setting']): ?>
    <div class="">
        <h6 class="font-semibold fs-13 mb-2"><?php echo e(translate('Product_Type')); ?></h6>
        <label class="w-100 opacity-75 text-nowrap for-sorting d-block mb-0 ps-0" for="sorting">
            <select class="form-control product-list-filter-input" name="product_type">
                <option value="all" <?php echo e(!request('product_type') ? 'selected' : ''); ?>><?php echo e(translate('All')); ?></option>
                <option value="physical" <?php echo e(request('product_type') == 'physical' ? 'selected' : ''); ?>>
                    <?php echo e(translate('physical')); ?>

                </option>
                <option value="digital" <?php echo e(request('product_type') == 'digital' ? 'selected' : ''); ?>>
                    <?php echo e(translate('digital')); ?>

                </option>
            </select>
        </label>
    </div>
<?php endif; ?>
<?php /**PATH C:\Users\musas\Desktop\softwares\6valley\POSA-latest version\POSA\resources\themes\default/web-views/products/partials/_filter-product-type.blade.php ENDPATH**/ ?>