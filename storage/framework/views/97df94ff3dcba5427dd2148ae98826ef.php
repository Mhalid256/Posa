<?php $__env->startSection('title', translate('Page_Expired')); ?>

<?php $__env->startSection('message'); ?>
    <div class="container">
        <div class="row justify-content-center align-items-center vh-100">
            <div class="col-12">
                <h1 class="text-center display-1"><?php echo e('419'); ?></h1>
                <h2 class="text-center text-muted py-2"><?php echo e(translate('Page_Expired')); ?></h2>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('errors::minimal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\musas\Desktop\softwares\6valley\POSA-latest version\POSA\resources\views/errors/419.blade.php ENDPATH**/ ?>