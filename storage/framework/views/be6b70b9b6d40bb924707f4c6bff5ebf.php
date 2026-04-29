<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="_token" content="<?php echo e(csrf_token()); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo e(translate('staff_login')); ?> | <?php echo e($web_config['company_name']); ?></title>
    <link rel="shortcut icon" href="<?php echo e(getStorageImages(path: getWebConfig(name: 'company_fav_icon'), type:'backend-logo')); ?>">
    <link rel="stylesheet" href="<?php echo e(dynamicAsset(path: 'public/assets/back-end/css/google-fonts.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(dynamicAsset(path: 'public/assets/back-end/css/vendor.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(dynamicAsset(path: 'public/assets/back-end/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(dynamicAsset(path: 'public/assets/back-end/vendor/icon-set/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(dynamicAsset(path: 'public/assets/back-end/css/theme.minc619.css?v=1.0')); ?>">
    <link rel="stylesheet" href="<?php echo e(dynamicAsset(path: 'public/assets/back-end/css/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(dynamicAsset(path: 'public/assets/back-end/css/toastr.css')); ?>">

    <style>
        :root { --c1: <?php echo e($web_config['primary_color']); ?>; }
    </style>
    <?php echo ToastMagic::styles(); ?>

</head>

<body>
<main id="content" role="main" class="main">
    <div class="auth-wrapper">

        
        <div class="auth-wrapper-left"
             style="background: url('<?php echo e(dynamicAsset(path: 'public/assets/back-end/img/login-bg.png')); ?>') no-repeat center center / cover">
            <div class="auth-left-cont">
                <?php ($eCommerceLogo = getWebConfig(name: 'company_web_logo')); ?>
                <a class="d-inline-flex mb-5" href="<?php echo e(route('home')); ?>">
                    <img width="310" src="<?php echo e(getStorageImages(path: $eCommerceLogo, type:'backend-logo')); ?>" alt="Logo">
                </a>
                <h2 class="title">
                    <?php echo e(translate('vendor_staff_portal')); ?>

                    <span class="font-weight-bold c1 d-block text-capitalize">
                        <?php echo e(translate('sign_in_to_your_workspace')); ?>

                    </span>
                </h2>
            </div>
        </div>

        
        <div class="auth-wrapper-right">
            <div class="auth-wrapper-form">
                <div class="d-block d-lg-none mb-4">
                    <a href="<?php echo e(route('home')); ?>">
                        <img width="100" src="<?php echo e(getStorageImages(path: $eCommerceLogo, type:'backend-logo')); ?>" alt="Logo">
                    </a>
                </div>

                
                <div class="d-flex align-items-center gap-2 mb-4">
                    <span class="badge text-bg-primary px-3 py-2 fs-6">
                        <i class="fi fi-sr-user me-1"></i>
                        <?php echo e(translate('staff_login')); ?>

                    </span>
                </div>

                <div class="mb-4">
                    <h1 class="display-4"><?php echo e(translate('sign_in')); ?></h1>
                    <p class="text-muted"><?php echo e(translate('enter_your_staff_credentials_to_access_your_vendor_dashboard')); ?></p>
                </div>

                <form action="<?php echo e(route('vendor.employee.auth.login.submit')); ?>" method="POST">
                    <?php echo csrf_field(); ?>

                    
                    <div class="js-form-message form-group">
                        <label class="input-label" for="staffEmail"><?php echo e(translate('your_email')); ?></label>
                        <input type="email"
                               class="form-control form-control-lg <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               name="email"
                               id="staffEmail"
                               placeholder="email@address.com"
                               value="<?php echo e(old('email')); ?>"
                               required>
                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    
                    <div class="js-form-message form-group">
                        <label class="input-label" for="staffPassword"><?php echo e(translate('password')); ?></label>
                        <div class="input-group input-group-merge">
                            <input type="password"
                                class="js-toggle-password form-control form-control-lg <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                name="password"
                                id="staffPassword"
                                placeholder="<?php echo e(translate('8+_characters_required')); ?>"
                                data-hs-toggle-password-options='{
                                    "target": "#changePassTarget",
                                    "defaultClass": "tio-visible-outlined",
                                    "showClass": "tio-hidden-outlined",
                                    "classChangeTarget": "#changePassIcon"
                                }'
                                required>
                            <div id="changePassTarget" class="input-group-append">
                                <a class="input-group-text" href="javascript:void(0)">
                                    <i id="changePassIcon" class="tio-visible-outlined"></i>
                                </a>
                            </div>
                        </div>
                        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="text-danger small mt-1"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    
                    <div class="form-group mb-3">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="rememberMe" name="remember">
                            <label class="custom-control-label text-muted" for="rememberMe">
                                <?php echo e(translate('remember_me')); ?>

                            </label>
                        </div>
                    </div>



                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                            <?php echo e(translate('sign_in')); ?>

                        </button>
                    </div>

                    
                    <div class="text-center mt-4">
                        <p class="text-muted small">
                            <?php echo e(translate('are_you_a_vendor')); ?>?
                            <a href="<?php echo e(route('vendor.auth.login')); ?>" class="text-primary fw-semibold">
                                <?php echo e(translate('vendor_login_here')); ?>

                            </a>
                        </p>
                    </div>

                </form>
            </div>
        </div>
    </div>
</main>

<span id="route-get-session-recaptcha-code"
      data-route="<?php echo e(route('get-session-recaptcha-code')); ?>"
      data-mode="<?php echo e(env('APP_MODE')); ?>"></span>

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
</html><?php /**PATH C:\Users\musas\Desktop\softwares\6valley\POSA-latest version\POSA\resources\views/vendor-views/employee/auth/login.blade.php ENDPATH**/ ?>