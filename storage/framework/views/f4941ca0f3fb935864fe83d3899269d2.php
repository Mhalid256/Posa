<div>
    <div class="text-center">
        <img width="100" class="mb-4" id="view-mail-icon"
             src="<?php echo e($template->image_full_url['path'] ?? dynamicAsset(path: 'public/assets/back-end/img/email-template/registration-success.png')); ?>"
             alt="">
        <h3 class="mb-3 view-mail-title text-capitalize">
            <?php echo e($title ?? translate('registration_Approved')); ?>

        </h3>
    </div>
    <div class="view-mail-body">
        <?php echo $body; ?>

    </div>
    <hr>
    <?php echo $__env->make('admin-views.business-settings.email-template.partials-design.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<?php /**PATH C:\Users\musas\Desktop\softwares\6valley\POSA-latest version\POSA\resources\views/admin-views/business-settings/email-template/vendor-mail-template/registration-approved.blade.php ENDPATH**/ ?>