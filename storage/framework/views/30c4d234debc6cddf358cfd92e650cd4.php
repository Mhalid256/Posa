<?php if(isset($productDetails) && isset($metaContentData)): ?>
    <?php if($metaContentData?->title): ?>
        <meta name="title" content="<?php echo e($metaContentData?->title); ?>">
        <meta property="og:title" content="<?php echo e($metaContentData?->title); ?>">
        <meta name="twitter:title" content="<?php echo e($metaContentData?->title); ?>">
    <?php else: ?>
        <meta name="title" content="<?php echo e($productDetails?->name); ?>">
        <meta property="og:title" content="<?php echo e($productDetails?->name); ?>">
        <meta name="twitter:title" content="<?php echo e($productDetails?->name); ?>">
    <?php endif; ?>

    <?php if($metaContentData?->description): ?>
        <meta name="description" content="<?php echo Str::limit($metaContentData?->description, 160); ?>">
        <meta property="og:description" content="<?php echo Str::limit($metaContentData?->description, 160); ?>">
        <meta name="twitter:description" content="<?php echo Str::limit($metaContentData?->description, 160); ?>">
    <?php else: ?>
        <meta name="description" content="<?php $__currentLoopData = explode(' ',$productDetails['name']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keyword): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e($keyword.' , '); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>">
        <meta property="og:description" content="<?php $__currentLoopData = explode(' ',$productDetails['name']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keyword): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e($keyword.' , '); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>">
        <meta name="twitter:description" content="<?php $__currentLoopData = explode(' ',$productDetails['name']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keyword): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e($keyword.' , '); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>">
    <?php endif; ?>

    <meta name="keywords" content="<?php $__currentLoopData = explode(' ',$productDetails['name']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keyword): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e($keyword.' , '); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>">

    <?php if($productDetails->added_by == 'seller'): ?>
        <meta name="author" content="<?php echo e($productDetails->seller->shop?$productDetails->seller->shop->name:$productDetails->seller->f_name); ?>">
    <?php elseif($productDetails->added_by == 'admin'): ?>
        <meta name="author" content="<?php echo e($web_config['company_name']); ?>">
    <?php endif; ?>

    <meta property="og:image" content="<?php echo e($metaContentData?->image_full_url['path']); ?>">
    <meta name="twitter:image" content="<?php echo e($metaContentData?->image_full_url['path']); ?>">

    <meta property="og:url" content="<?php echo e(route('product', [$productDetails->slug])); ?>">
    <meta name="twitter:url" content="<?php echo e(route('product', [$productDetails->slug])); ?>">

    <?php if($metaContentData?->index != 'noindex'): ?>
        <meta name="robots" content="index">
    <?php endif; ?>

    <?php if($metaContentData?->no_follow || $metaContentData?->no_image_index || $metaContentData?->no_archive || $metaContentData?->no_snippet): ?>
        <meta name="robots" content="<?php echo e(($metaContentData?->no_follow ? 'nofollow' : '') . ($metaContentData?->no_image_index ? ' noimageindex' : '') . ($metaContentData?->no_archive ? ' noarchive' : '') . ($metaContentData?->no_snippet ? ' nosnippet' : '')); ?>">
    <?php endif; ?>

    <?php if($metaContentData?->meta_max_snippet): ?>
        <meta name="robots" content="max-snippet<?php echo e($metaContentData?->max_snippet_value ? ': ' . $metaContentData?->max_snippet_value : ''); ?>">
    <?php endif; ?>

    <?php if($metaContentData?->max_video_preview): ?>
        <meta name="robots" content="max-video-preview<?php echo e($metaContentData?->max_video_preview_value ? ': ' . $metaContentData?->max_video_preview_value : ''); ?>">
    <?php endif; ?>

    <?php if($metaContentData?->max_image_preview): ?>
        <meta name="robots" content="max-image-preview<?php echo e($metaContentData?->max_image_preview_value ? ': ' . $metaContentData?->max_image_preview_value : ''); ?>">
    <?php endif; ?>
<?php endif; ?>
<?php /**PATH C:\Users\musas\Desktop\softwares\6valley\POSA-latest version\POSA\resources\themes\default/web-views/partials/_productSEOMetaContentData.blade.php ENDPATH**/ ?>