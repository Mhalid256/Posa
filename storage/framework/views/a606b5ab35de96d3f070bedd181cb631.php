<?php
    $companyName = getWebConfig(name: 'company_name');
    $companyLogo = getWebConfig(name: 'company_web_logo');
    $title = $template['title'] ?? null;
    $body = $template['body'] ?? null;
    $copyrightText = $template['copyright_text'] ?? null;
    $footerText = $template['footer_text'] ?? null;
    $buttonName = $template['button_name'] ?? null;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo e(translate('Email Verification')); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php echo $__env->make('email-templates.partials.style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>
<body>
<div class="main-table">
    <?php echo $__env->make('admin-views.business-settings.email-template.'.$template['user_type'].'-mail-template'.'.'.$template['template_design_name'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
</body>
</html>

<?php /**PATH C:\Users\musas\Desktop\softwares\6valley\POSA-latest version\POSA\resources\views/email-templates/index.blade.php ENDPATH**/ ?>