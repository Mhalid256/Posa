<div class="inline-page-menu my-4">
    <ul class="list-unstyled">
        <li class="<?php echo e(Request::is('vendor/transaction/order-list') ?'active':''); ?>"><a href="<?php echo e(route('vendor.transaction.order-list')); ?>"><?php echo e(translate('order_Transactions')); ?></a></li>
        <li class="<?php echo e(Request::is('vendor/transaction/expense-list') ?'active':''); ?>"><a href="<?php echo e(route('vendor.transaction.expense-list')); ?>"><?php echo e(translate('expense_Transactions')); ?></a></li>
    </ul>
</div>
<?php /**PATH C:\Users\musas\Desktop\softwares\6valley\POSA-latest version\POSA\resources\views/vendor-views/transaction/transaction-report-inline-menu.blade.php ENDPATH**/ ?>