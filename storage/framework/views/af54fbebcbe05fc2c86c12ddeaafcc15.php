<div class="text-center p-4">
    <img class="mb-3 w-<?php echo e($width ?? 160); ?>" alt="<?php echo e(translate('image_description')); ?>"
         src="<?php echo e(dynamicAsset(path: 'public/assets/new/back-end/img/empty-state-icon/'.$image.'.png')); ?>">
    <p class="mb-0"><?php echo e(translate($text)); ?></p>
    <?php if($button ?? false): ?>
        <a href="<?php echo e($route); ?>" class="btn btn-primary mt-3">
            <i class="fi fi-sr-add"></i> <?php echo e(translate($buttonText)); ?>

        </a>
    <?php endif; ?>
</div>
<?php /**PATH C:\Users\musas\Desktop\softwares\6valley\POSA-latest\POSA\resources\views/layouts/admin/partials/_empty-state.blade.php ENDPATH**/ ?>