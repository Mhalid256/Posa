<script src="<?php echo e(dynamicAsset(path: 'public/assets/new/back-end/libs/jquery/jquery-3.7.1.min.js')); ?>"></script>
<script src="<?php echo e(dynamicAsset(path: 'public/assets/backend/libs/bootstrap/bootstrap.bundle.min.js')); ?>"></script>
<script src="<?php echo e(dynamicAsset(path: 'public/assets/backend/libs/select2/select2.min.js')); ?>"></script>
<script src="<?php echo e(dynamicAsset(path: 'public/assets/new/back-end/js/select-2-init.js')); ?>"></script>

<script src="<?php echo e(dynamicAsset(path: 'public/assets/new/back-end/libs/intl-tel-input/js/intlTelInput.js')); ?>"></script>
<script src="<?php echo e(dynamicAsset(path: 'public/assets/new/back-end/libs/intl-tel-input/js/utils.js')); ?>"></script>
<script
    src="<?php echo e(dynamicAsset(path: 'public/assets/new/back-end/libs/intl-tel-input/js/country-picker-init.js')); ?>"></script>


<script src="<?php echo e(dynamicAsset(path: 'public/assets/new/back-end/libs/tags-input/tags-input.min.js')); ?>"></script>

<script
    src="<?php echo e(dynamicAsset(path: 'public/assets/new/back-end/libs/spartan-multi-image-picker/spartan-multi-image-picker-min.js')); ?>"></script>

<script src="<?php echo e(dynamicAsset(path: 'public/assets/new/back-end/libs/swiper/swiper-bundle.min.js')); ?>"></script>

<script src="<?php echo e(dynamicAsset(path: 'public/assets/backend/libs/sweetalert2/sweetalert2.all.min.js')); ?>"></script>

<script src="<?php echo e(dynamicAsset(path: 'public/assets/new/back-end/libs/lightbox/lightbox.min.js')); ?>"></script>

<script src="<?php echo e(dynamicAsset(path: 'public/assets/new/back-end/libs/moment.min.js')); ?>"></script>
<script src="<?php echo e(dynamicAsset(path: 'public/assets/new/back-end/libs/daterangepicker/daterangepicker.min.js')); ?>"></script>

<script src="<?php echo e(dynamicAsset(path: 'public/assets/new/back-end/js/single-image-upload.js')); ?>"></script>
<script src="<?php echo e(dynamicAsset(path: 'public/assets/new/back-end/js/multiple-image-upload.js')); ?>"></script>
<script src="<?php echo e(dynamicAsset(path: 'public/assets/new/back-end/js/file.upload.js')); ?>"></script>
<script src="<?php echo e(dynamicAsset(path: 'public/assets/new/back-end/js/multiple_file_upload.js')); ?>"></script>
<script src="<?php echo e(dynamicAsset(path: 'public/assets/backend/multiple-file-upload.js')); ?>"></script>

<script src="<?php echo e(dynamicAsset(path: 'public/assets/new/back-end/js/product.js')); ?>"></script>

<script src="<?php echo e(dynamicAsset(path: 'public/assets/new/back-end/js/intlTelInout-validation.js')); ?>"></script>

<script src="<?php echo e(dynamicAsset(path: 'public/assets/new/back-end/js/script.js')); ?>"></script>
<script src="<?php echo e(dynamicAsset(path: 'public/assets/new/back-end/js/script_neha.js')); ?>"></script>
<script src="<?php echo e(dynamicAsset(path: 'public/assets/backend/admin/js/custom.js')); ?>"></script>
<script src="<?php echo e(dynamicAsset(path: 'public/assets/new/back-end/js/custom_old.js')); ?>"></script>
<script src="<?php echo e(dynamicAsset(path: 'public/assets/new/back-end/js/app-utils.js')); ?>"></script>

<script src="<?php echo e(dynamicAsset(path: 'public/assets/backend/admin/js/auto-load-func.js')); ?>"></script>

<script src="<?php echo e(dynamicAsset(path: 'public/assets/backend/admin/js/common/custom-modal-plugin.js')); ?>"></script>

<?php echo ToastMagic::scripts(); ?>


<?php if($errors->any()): ?>
    <script>
        'use strict';
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        toastMagic.error('<?php echo e($error); ?>');
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </script>
<?php endif; ?>

<?php echo $__env->make("layouts.admin.partials._firebase-script", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<script>
    let placeholderImageUrl = "<?php echo e(dynamicAsset(path: 'public/assets/new/back-end/img/svg/image-upload.svg')); ?>";
    const iconPath = "<?php echo e(dynamicAsset(path: 'public/assets/new/back-end/img/icons/file.svg')); ?>";
</script>

<?php if(App\Utils\Helpers::module_permission_check('order_management') && env('APP_MODE') != 'dev'): ?>
    <script>
        'use strict'
        setInterval(function () {
            getInitialDataForPanel();
        }, 10000);
    </script>
<?php endif; ?>

<?php if(env('APP_MODE') == 'dev'): ?>
    <script>
        'use strict'
        function checkDemoResetTime() {
            let currentMinute = new Date().getMinutes();
            if (currentMinute > 55 && currentMinute <= 60) {
                $('#demo-reset-warning').addClass('active');
            } else {
                $('#demo-reset-warning').removeClass('active');
            }
        }
        checkDemoResetTime();
        setInterval(checkDemoResetTime, 60000);
    </script>
<?php endif; ?>
<?php /**PATH C:\Users\musas\Desktop\softwares\6valley\POSA-latest version\POSA\resources\views/layouts/admin/partials/_script-partials.blade.php ENDPATH**/ ?>