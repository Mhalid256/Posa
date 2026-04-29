<div class="inline-page-menu my-4">
    <ul class="list-unstyled">
        <li class="<?php echo e(Request::is('vendor/shop/index') && !request()->has('pagetype') ?'active':''); ?>"><a href="<?php echo e(route('vendor.shop.index')); ?>"><?php echo e(translate('general')); ?></a></li>
        <?php if(($minimumOrderAmountStatus && $minimumOrderAmountByVendor ) || ($freeDeliveryStatus && $freeDeliveryResponsibility == 'seller')): ?>
            <li class="<?php echo e(Request::is('vendor/shop/index') && request('pagetype') == 'order_settings' ?'active':''); ?>">
                <a href="<?php echo e(route('vendor.shop.index',['pagetype'=>'order_settings'])); ?>"><?php echo e(translate('order_settings')); ?></a>
            </li>
        <?php endif; ?>
    </ul>
</div>
<?php /**PATH C:\Users\musas\Desktop\softwares\6valley\POSA-latest\POSA\resources\views/vendor-views/shop/inline-menu.blade.php ENDPATH**/ ?>