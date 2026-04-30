<div class="inline-page-menu my-4">
    <ul class="list-unstyled">
        <li class="<?php echo e(Request::is('vendor/report/all-product') ?'active':''); ?>"><a href="<?php echo e(route('vendor.report.all-product')); ?>"><?php echo e(translate('all_Products')); ?></a></li>
        <li class="<?php echo e(Request::is('vendor/report/stock-product-report') ?'active':''); ?>"><a href="<?php echo e(route('vendor.report.stock-product-report')); ?>"><?php echo e(translate('products_Stock')); ?></a></li>
    </ul>
</div>
<?php /**PATH C:\Users\musas\Desktop\softwares\6valley\POSA-latest version\POSA\resources\views/vendor-views/report/product-report-inline-menu.blade.php ENDPATH**/ ?>