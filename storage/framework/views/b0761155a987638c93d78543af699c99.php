<div class="d-lg-none">
    <h6 class="font-semibold fs-13 mb-2"><?php echo e(translate('Sort_By')); ?></h6>
    <select class="form-control product-list-filter-input" name="sort_by">
        <option value="latest" <?php echo e(request('sort_by') == 'latest' ? 'selected':''); ?>>
            <?php echo e(translate('Default')); ?>

        </option>
        <option value="low-high" <?php echo e(request('sort_by') == 'low-high' ? 'selected':''); ?>>
            <?php echo e(translate('Price')); ?> (<?php echo e(translate('Low_to_High')); ?>)
        </option>
        <option value="high-low" <?php echo e(request('sort_by') == 'high-low' ? 'selected':''); ?>>
            <?php echo e(translate('Price')); ?> (<?php echo e(translate('High_to_Low')); ?>)
        </option>
        <option value="rating-low-high" <?php echo e(request('sort_by') == 'rating-low-high' ? 'selected':''); ?>>
            <?php echo e(translate('Rating')); ?> (<?php echo e(translate('Low_to_High')); ?>)
        </option>
        <option value="rating-high-low" <?php echo e(request('sort_by') == 'rating-high-low' ? 'selected':''); ?>>
            <?php echo e(translate('Rating')); ?> (<?php echo e(translate('High_to_Low')); ?>)
        </option>
        <option value="a-z" <?php echo e(request('sort_by') == 'a-z' ? 'selected':''); ?>>
            <?php echo e(translate('Alphabetical')); ?> (<?php echo e('A '.translate('to').' Z'); ?>)
        </option>
        <option value="z-a" <?php echo e(request('sort_by') == 'z-a' ? 'selected':''); ?>>
            <?php echo e(translate('Alphabetical')); ?> (<?php echo e('Z '.translate('to').' A'); ?>)
        </option>
    </select>
</div>
<?php /**PATH C:\Users\musas\Desktop\softwares\6valley\POSA-latest version\POSA\resources\themes\default/web-views/products/partials/_filter-product-sort.blade.php ENDPATH**/ ?>