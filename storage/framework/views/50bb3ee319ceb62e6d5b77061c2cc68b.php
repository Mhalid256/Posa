<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" dir="<?php echo e(session('direction') ?? "ltr"); ?>">

<head>
    <meta charset="utf-8">
    <meta name="_token" content="<?php echo e(csrf_token()); ?>">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <meta name="robots" content="nofollow, noindex">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title><?php echo $__env->yieldContent('title'); ?></title>
    <link rel="shortcut icon"
          href="<?php echo e(getStorageImages(path: getWebConfig(name: 'company_fav_icon'), type: 'backend-logo')); ?>">

    <?php echo $__env->make("layouts.admin.partials._style-partials", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo ToastMagic::styles(); ?>


    <?php echo $__env->yieldPushContent('css_or_js'); ?>
</head>

<body data-bs-theme="light">
<script type="text/javascript">
    localStorage.getItem('aside-mini') === 'true' ? document.body.classList.add('aside-mini') : document.body.classList.remove('aside-mini');
</script>

<div class="row">
    <div class="col-12 position-fixed loader-container mt-10rem">
        <div id="loading" class="d--none">
            <div id="loader"></div>
        </div>
    </div>
</div>

<?php echo $__env->make('layouts.admin.partials._header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layouts.admin.partials._side-bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<main id="content" role="main" class="main-content">
    <?php echo $__env->yieldContent('content'); ?>
    <?php echo $__env->make('layouts.admin.partials._toggle-modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('layouts.admin.components.image-modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('layouts.admin.partials._sign-out-modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('layouts.admin.partials._modals', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('layouts.admin.partials._alert-message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</main>

<audio id="myAudio">
    <source src="<?php echo e(dynamicAsset(path: 'public/assets/backend/sound/notification.mp3')); ?>" type="audio/mpeg">
</audio>

<?php echo $__env->make('layouts.admin.partials._translator-for-js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make("layouts.admin.partials._translated-message-container", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make("layouts.admin.partials._routes-list-container", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make("layouts.admin.partials._script-partials", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->yieldPushContent('script'); ?>
</body>

</html>
<?php /**PATH C:\Users\musas\Desktop\softwares\6valley\POSA-latest version\POSA\resources\views/layouts/admin/app.blade.php ENDPATH**/ ?>