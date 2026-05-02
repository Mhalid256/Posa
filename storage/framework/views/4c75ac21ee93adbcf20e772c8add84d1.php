<?php use App\Enums\DemoConstant; ?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="_token" content="<?php echo e(csrf_token()); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo e(translate($role)); ?> | <?php echo e(translate('login')); ?></title>
    <link rel="shortcut icon" href="<?php echo e(getStorageImages(path: getWebConfig(name: 'company_fav_icon'), type:'backend-logo')); ?>">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap">

    <link rel="stylesheet" href="<?php echo e(dynamicAsset(path: 'public/assets/backend/libs/bootstrap/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(dynamicAsset(path: 'public/assets/backend/webfonts/uicons-regular-rounded.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(dynamicAsset(path: 'public/assets/backend/webfonts/uicons-solid-rounded.css')); ?>">

    <link rel="stylesheet" href="<?php echo e(dynamicAsset(path: 'public/assets/new/back-end/css/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(dynamicAsset(path: 'public/assets/new/back-end/css/style_neha.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(dynamicAsset(path: 'public/assets/backend/admin/css/custom.css')); ?>">

    <?php if($web_config['panel_sidebar_color']): ?>
        <style>
            :root {
                --bs-primary: <?php echo ($web_config['panel_sidebar_color']); ?>;
            }
        </style>
    <?php endif; ?>

    <?php echo ToastMagic::styles(); ?>

</head>

<body>
<main id="content" role="main" class="main">
    <div class="auth-wrapper">
        <div class="auth-wrapper-left"
             style="background: url('<?php echo e(dynamicAsset('public/assets/back-end/img/login-bg.png')); ?>') no-repeat center center / cover">
            <div class="auth-left-cont user-select-none">
                <?php ($eCommerceLogo = getWebConfig(name: 'company_web_logo')); ?>
                <a class="d-inline-flex mb-5" href="<?php echo e(route('home')); ?>">
                    <img width="310" src="<?php echo e(getStorageImages(path: $eCommerceLogo, type:'backend-logo')); ?>" alt="Logo">
                </a>
                <h2 class="title h1">
                    <?php echo e(translate('Make Your Business')); ?>

                    <span class="fw-bold text-primary d-block text-capitalize">
                        <?php echo e(translate('Profitable...')); ?>

                    </span>
                </h2>
            </div>
        </div>
        <div class="auth-wrapper-right">
            <?php if(SOFTWARE_VERSION): ?>
                <label class="badge badge-success text-bg-success float-end __inline-2 user-select-none">
                    <?php echo e(translate('software_version')); ?> : <?php echo e(SOFTWARE_VERSION); ?>

                </label>
            <?php endif; ?>
            <div class="auth-wrapper-form">
                <form id="form-id" action="<?php echo e(route('login')); ?>" method="post" id="admin-login-form">
                    <?php echo csrf_field(); ?>
                    <div>
                        <div class="mb-5 user-select-none">
                            <h1 class="display-4"><?php echo e(translate('sign_in')); ?></h1>
                            <h1 class="h3 text-body mb-4">
                                <?php echo e(translate('welcome_back_to')); ?> <?php echo e(translate($role)); ?> <?php echo e(translate('Login')); ?>

                            </h1>
                        </div>
                    </div>

                    <input type="hidden" class="form-control mb-3" name="role" id="role" value="<?php echo e($role); ?>">

                    <div class="js-form-message form-group">
                        <label class="form-label user-select-none" for="signingAdminEmail">
                            <?php echo e(translate('your_email')); ?>

                        </label>
                        <input type="email" class="form-control form-control-lg" name="email" id="signingAdminEmail"
                               tabindex="1" placeholder="email@address.com" aria-label="email@address.com"
                               required data-msg="Please enter a valid email address.">
                    </div>

                    <div class="js-form-message form-group">
                        <label class="form-label user-select-none" for="signingAdminPassword" tabindex="0">
                            <span class="d-flex justify-content-between align-items-center">
                                <?php echo e(translate('password')); ?>

                            </span>
                        </label>
                        <div class="input-group">
                            <input type="password" class="js-toggle-password form-control form-control-lg"
                                   name="password" id="signingAdminPassword"
                                   placeholder="<?php echo e(translate('8+_characters_required')); ?>"
                                   aria-label="8+ characters required" required
                                   data-msg="Your password is invalid. Please try again.">
                            <div id="changePassTarget" class="input-group-append changePassTarget">
                                <a class="text-body-light" href="javascript:">
                                    <i id="changePassIcon" class="fi fi-sr-eye-crossed"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-check d-flex gap-2">
                            <input type="checkbox" class="custom-control-input form-check-input checkbox--input"
                                   id="termsCheckbox" name="remember">
                            <label class="custom-control-label text-muted user-select-none" for="termsCheckbox">
                                <?php echo e(translate('remember_me')); ?>

                            </label>
                        </div>
                    </div>

                    

                    <button type="submit" class="btn btn-lg btn-block btn-primary">
                        <?php echo e(translate('sign_in')); ?>

                    </button>
                </form>
                <?php if(env('APP_MODE')=='demo'): ?>
                    <div class="card-footer py-3">
                        <div class="row">
                            <div class="col-10">
                                <span id="admin-email" data-email="<?php echo e(DemoConstant::ADMIN['email']); ?>">
                                    <?php echo e(translate('email')); ?> : <?php echo e(DemoConstant::ADMIN['email']); ?>

                                </span>
                                <br>
                                <span id="admin-password" data-password="<?php echo e(DemoConstant::ADMIN['password']); ?>">
                                    <?php echo e(translate('password')); ?> : <?php echo e(DemoConstant::ADMIN['password']); ?>

                                </span>
                            </div>
                            <div class="col-2">
                                <button class="btn btn-primary icon-btn" id="copyLoginInfo">
                                    <i class="fi fi-rr-copy"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>

<span id="message-please-check-recaptcha" data-text="<?php echo e(translate('please_check_the_recaptcha')); ?>"></span>
<span id="message-copied_success" data-text="<?php echo e(translate('copied_successfully')); ?>"></span>
<span id="route-get-session-recaptcha-code" data-route="<?php echo e(route('get-session-recaptcha-code')); ?>"
      data-mode="<?php echo e(env('APP_MODE')); ?>"></span>

<script src="<?php echo e(dynamicAsset(path: 'public/assets/new/back-end/libs/jquery/jquery-3.7.1.min.js')); ?>"></script>
<script src="<?php echo e(dynamicAsset(path: 'public/assets/backend/libs/bootstrap/bootstrap.bundle.min.js')); ?>"></script>
<script src="<?php echo e(dynamicAsset(path: 'public/assets/new/back-end/js/script.js')); ?>"></script>
<script src="<?php echo e(dynamicAsset(path: 'public/assets/new/back-end/js/script_neha.js')); ?>"></script>
<script src="<?php echo e(dynamicAsset(path: 'public/assets/backend/admin/js/auth.js')); ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php echo ToastMagic::scripts(); ?>


<script>
"use strict";
document.getElementById('admin-login-form')?.addEventListener('submit', function () {
    Swal.fire({
        title: 'Processing...',
        text: 'Please wait',
        allowOutsideClick: false,
        allowEscapeKey: false,
        didOpen: function () { Swal.showLoading(); }
    });
});
</script>

<?php if($errors->any()): ?>
    <script>
        "use strict";
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        toastMagic.error('<?php echo e($error); ?>');
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </script>
<?php endif; ?>

</body>
</html><?php /**PATH C:\Users\musas\Desktop\softwares\6valley\POSA-latest version\POSA\resources\views/admin-views/auth/login.blade.php ENDPATH**/ ?>