<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="_token" content="<?php echo e(csrf_token()); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo e(translate('vendor_Login')); ?></title>
    <link rel="shortcut icon" href="<?php echo e(getStorageImages(path: getWebConfig(name: 'company_fav_icon'), type:'backend-logo')); ?>">
    <link rel="stylesheet" href="<?php echo e(dynamicAsset(path: 'public/assets/back-end/css/google-fonts.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(dynamicAsset(path: 'public/assets/back-end/css/vendor.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(dynamicAsset(path: 'public/assets/back-end/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(dynamicAsset(path: 'public/assets/back-end/vendor/icon-set/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(dynamicAsset(path: 'public/assets/back-end/css/theme.minc619.css?v=1.0')); ?>">
    <link rel="stylesheet" href="<?php echo e(dynamicAsset(path: 'public/assets/back-end/css/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(dynamicAsset(path: 'public/assets/back-end/css/toastr.css')); ?>">

    <style>
        :root {
            --c1: <?php echo e($web_config['primary_color']); ?>;
        }
    </style>

    <?php echo ToastMagic::styles(); ?>

</head>

<body>
<main id="content" role="main" class="main">
    <div class="auth-wrapper">
        <div class="auth-wrapper-left" style="background: url('<?php echo e(dynamicAsset(path: 'public/assets/back-end/img/login-bg.png')); ?>') no-repeat center center / cover">
            <div class="auth-left-cont">
                <?php ($eCommerceLogo = getWebConfig(name: 'company_web_logo')); ?>
                <a class="d-inline-flex mb-5" href="<?php echo e(route('home')); ?>">
                    <img width="310" src="<?php echo e(getStorageImages(path: $eCommerceLogo, type:'backend-logo')); ?>" alt="Logo">
                </a>
                <h2 class="title"><?php echo e(translate('Make Your Business')); ?> <span class="font-weight-bold c1 d-block text-capitalize"><?php echo e(translate('Profitable...')); ?></span></h2>
            </div>
        </div>
        <div class="auth-wrapper-right">
            <div class="auth-wrapper-form">
                <div class="d-block d-lg-none">
                    <a class="d-inline-flex mb-3" href="<?php echo e(route('home')); ?>">
                        <img width="100" src="<?php echo e(getStorageImages(path: $eCommerceLogo, type:'backend-logo')); ?>"
                             alt="Logo">
                    </a>
                </div>

                <form id="form-id" action="<?php echo e(route('vendor.auth.login')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div>
                        <div class="mb-5">
                            <h1 class="display-4"><?php echo e(translate('sign_in')); ?></h1>
                            <h1 class="h4 text-gray-900 mb-4">
                                <?php echo e(translate('welcome_back_to')); ?> <?php echo e(translate('Vendor_Login')); ?>

                            </h1>
                        </div>
                    </div>

                    <div class="js-form-message form-group">
                        <label class="input-label" for="signingVendorEmail"><?php echo e(translate('your_email')); ?></label>
                        <input type="email" class="form-control form-control-lg" name="email" id="signingVendorEmail"
                               tabindex="1" placeholder="email@address.com" aria-label="email@address.com"
                               required data-msg="Please enter a valid email address.">
                    </div>

                    <div class="js-form-message form-group">
                        <label class="input-label" for="signingVendorPassword" tabindex="0">
                            <span class="d-flex justify-content-between align-items-center">
                              <?php echo e(translate('password')); ?>

                                    <a href="<?php echo e(route('vendor.auth.forgot-password.index')); ?>">
                                        <?php echo e(translate('forgot_password')); ?>

                                    </a>
                            </span>
                        </label>
                        <div class="input-group input-group-merge">
                            <input type="password" class="js-toggle-password form-control form-control-lg"
                                   name="password" id="signingVendorPassword"
                                   placeholder="<?php echo e(translate('8+_characters_required')); ?>"
                                   aria-label="8+ characters required" required
                                   data-msg="Your password is invalid. Please try again."
                                   data-hs-toggle-password-options='{
                                                "target": "#changePassTarget",
                                    "defaultClass": "tio-hidden-outlined",
                                    "showClass": "tio-visible-outlined",
                                    "classChangeTarget": "#changePassIcon"
                                    }'>
                            <div id="changePassTarget" class="input-group-append">
                                <a class="input-group-text" href="javascript:">
                                    <i id="changePassIcon" class="tio-visible-outlined"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-1">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="termsCheckbox"
                                   name="remember">
                            <label class="custom-control-label text-muted" for="termsCheckbox">
                                <?php echo e(translate('remember_me')); ?>

                            </label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-lg btn-block btn--primary">
                        <?php echo e(translate('sign_in')); ?>

                    </button>
                </form>

                <?php if(env('APP_MODE')=='demo'): ?>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-10">
                                <span id="vendor-email" data-email="<?php echo e(\App\Enums\DemoConstant::VENDOR['email']); ?>"><?php echo e(translate('email')); ?> : <?php echo e(\App\Enums\DemoConstant::VENDOR['email']); ?></span><br>
                                <span id="vendor-password" data-password="<?php echo e(\App\Enums\DemoConstant::VENDOR['password']); ?>"><?php echo e(translate('password')); ?> : <?php echo e(\App\Enums\DemoConstant::VENDOR['password']); ?></span>
                            </div>
                            <div class="col-2">
                                <button class="btn btn--primary" id="copyLoginInfo"><i class="tio-copy"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>

<span id="message-copied_success" data-text="<?php echo e(translate('copied_successfully')); ?>"></span>

<script src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/js/vendor.min.js')); ?>"></script>
<script src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/js/theme.min.js')); ?>"></script>
<script src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/js/toastr.js')); ?>"></script>
<script src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/js/vendor/login.js')); ?>"></script>

<?php echo ToastMagic::scripts(); ?>


<?php if($errors->any()): ?>
    <script>
        'use strict';
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        toastMagic.error('<?php echo e($error); ?>');
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </script>
<?php endif; ?>

</body>
</html><?php /**PATH C:\Users\musas\Desktop\softwares\6valley\POSA-latest version\POSA\resources\views/vendor-views/auth/login.blade.php ENDPATH**/ ?>