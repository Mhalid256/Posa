<?php $__env->startSection('title', translate('sign_in')); ?>

<?php $__env->startPush('css_or_js'); ?>
    <link rel="stylesheet"
          href="<?php echo e(theme_asset(path: 'public/assets/front-end/plugin/intl-tel-input/css/intlTelInput.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

    <?php
    $customerManualLogin = $web_config['customer_login_options']['manual_login'] ?? 0;
    $customerOTPLogin = $web_config['customer_login_options']['otp_login'] ?? 0;
    $customerSocialLogin = $web_config['customer_login_options']['social_login'] ?? 0;

    if (!$customerOTPLogin && $customerManualLogin && $customerSocialLogin) {
        $multiColumn = 1;
    } elseif ($customerOTPLogin && !$customerManualLogin && $customerSocialLogin) {
        $multiColumn = 1;
    } elseif ($customerOTPLogin && $customerManualLogin && !$customerSocialLogin) {
        $multiColumn = 1;
    } elseif ($customerOTPLogin && $customerManualLogin && $customerSocialLogin) {
        $multiColumn = 1;
    } else {
        $multiColumn = 0;
    }
    ?>

    <div class="container py-4 py-lg-5 my-4 text-align-direction">
        <div class="row justify-content-center">
            <div class="<?php echo e($multiColumn ? 'col-md-9' : 'col-md-6'); ?> login-card">
                <div class="d-flex justify-content-center align-items-center flex-column">
                    <img src="<?php echo e(theme_asset(path: 'public/assets/front-end/img/icons/user-vector.svg')); ?>"
                         alt="" class="w-70px">
                    <h2 class="text-center font-bold text-capitalize fs-20 my-4 fs-18-mobile">
                        <?php echo e(translate('Sign_In')); ?>

                    </h2>
                </div>
                <div class="position-relative">
                    <div class="row justify-content-center align-items-center g-4 <?php echo e($multiColumn ? 'or-sign-in-with-row' : ''); ?>">
                        <?php if($customerOTPLogin && !$customerManualLogin && !$customerSocialLogin): ?>
                            <div class="col-md-12">
                                <form autocomplete="off"
                                    action="<?php echo e(route('customer.auth.login')); ?>"
                                    method="post"
                                    data-recaptcha="skip"
                                    class="customer-centralize-login-form"
                                    data-firebase-auth="<?php echo e($web_config['firebase_otp_verification_status'] ? 'active': 'deactivate'); ?>"
                                >
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="login_type" value="otp-login">
                                    <?php echo $__env->make("web-views.customer-views.auth.partials._phone", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    
                                    <button class="btn btn--primary btn-block btn-shadow font-semi-bold" type="submit">
                                        <?php echo e(translate('Get_OTP')); ?>

                                    </button>
                                </form>
                            </div>
                        <?php elseif(!$customerOTPLogin && $customerManualLogin && !$customerSocialLogin): ?>
                            <div class="col-md-12">
                                <form autocomplete="off"
                                    class="customer-centralize-login-form mt-2"
                                    action="<?php echo e(route('customer.auth.login')); ?>"
                                    method="post" id="customer-login-form">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="login_type" value="manual-login">
                                    <?php echo $__env->make("web-views.customer-views.auth.partials._email", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    <?php echo $__env->make("web-views.customer-views.auth.partials._password", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    <?php echo $__env->make("web-views.customer-views.auth.partials._remember-me", ['forgotPassword' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    
                                    <button class="btn btn--primary btn-block btn-shadow font-semi-bold" type="submit">
                                        <?php echo e(translate('sign_in')); ?>

                                    </button>
                                    <?php if(!$multiColumn): ?>
                                        <?php echo $__env->make("web-views.customer-views.auth.partials._sign-up-instruction", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    <?php endif; ?>
                                </form>
                            </div>
                        <?php elseif(!$customerOTPLogin && $customerManualLogin && $customerSocialLogin): ?>
                            <div class="col-md-6">
                                <form autocomplete="off"
                                    class="customer-centralize-login-form mt-2"
                                    action="<?php echo e(route('customer.auth.login')); ?>"
                                    method="post" id="customer-login-form">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="login_type" value="manual-login">
                                    <?php echo $__env->make("web-views.customer-views.auth.partials._email", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    <?php echo $__env->make("web-views.customer-views.auth.partials._password", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    <?php echo $__env->make("web-views.customer-views.auth.partials._remember-me", ['forgotPassword' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    
                                    <button class="btn btn--primary btn-block btn-shadow font-semi-bold" type="submit">
                                        <?php echo e(translate('sign_in')); ?>

                                    </button>
                                    <?php if(!$multiColumn): ?>
                                        <?php echo $__env->make("web-views.customer-views.auth.partials._sign-up-instruction", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    <?php endif; ?>
                                </form>
                            </div>
                        <?php elseif($customerOTPLogin && !$customerManualLogin && $customerSocialLogin): ?>
                            <div class="col-md-6">
                                <form autocomplete="off"
                                    class="customer-centralize-login-form mt-2"
                                    action="<?php echo e(route('customer.auth.login')); ?>"
                                    method="post"
                                    data-recaptcha="skip"
                                    id="<?php echo e($web_config['firebase_otp_verification_status'] ? 'customer-firebase-login-form': 'customer-login-form'); ?>"
                                    data-firebase-auth="<?php echo e($web_config['firebase_otp_verification_status'] ? 'active': 'deactivate'); ?>"
                                >
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="login_type" value="otp-login">
                                    <?php echo $__env->make("web-views.customer-views.auth.partials._phone", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    
                                    <button class="btn btn--primary btn-block btn-shadow font-semi-bold" type="submit">
                                        <?php echo e(translate('Get_OTP')); ?>

                                    </button>
                                </form>
                            </div>
                        <?php elseif($customerOTPLogin && $customerManualLogin): ?>
                            <div class="col-md-6">
                                <div class="manual-login-container">
                                    <form autocomplete="off"
                                        class="customer-centralize-login-form mt-2"
                                        action="<?php echo e(route('customer.auth.login')); ?>"
                                        method="post" id="customer-login-form">
                                        <?php echo csrf_field(); ?>
                                        <input type="hidden" name="login_type" class="auth-login-type-input" value="manual-login">
                                        <div class="manual-login-items">
                                            <?php echo $__env->make("web-views.customer-views.auth.partials._email", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                            <?php echo $__env->make("web-views.customer-views.auth.partials._password", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                            <?php echo $__env->make("web-views.customer-views.auth.partials._remember-me", ['forgotPassword' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        </div>
                                        <div class="otp-login-items d-none">
                                            <?php echo $__env->make("web-views.customer-views.auth.partials._phone", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        </div>
                                        
                                        <div class="manual-login-items">
                                            <button class="btn btn--primary btn-block btn-shadow font-semi-bold" type="submit">
                                                <?php echo e(translate('sign_in')); ?>

                                            </button>
                                        </div>
                                        <div class="otp-login-items d-none">
                                            <button class="btn btn--primary btn-block btn-shadow font-semi-bold" type="submit">
                                                <?php echo e(translate('Get_OTP')); ?>

                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if($multiColumn): ?>
                            <div class="or-sign-in-with"><span><?php echo e(translate('Or Sign in with')); ?></span></div>
                        <?php endif; ?>

                        <?php if($multiColumn || $customerSocialLogin): ?>
                            <div class="<?php echo e($multiColumn ? 'col-md-6' : 'col-12'); ?>">
                                <div class="d-flex justify-content-center flex-column align-items-center my-3 gap-3">
                                    <?php if($customerSocialLogin): ?>
                                        <?php $__currentLoopData = $web_config['customer_social_login_options']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $socialLoginServiceKey => $socialLoginService): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($socialLoginService && $socialLoginServiceKey != 'apple'): ?>
                                                <a class="social-media-login-btn"
                                                href="<?php echo e(route('customer.auth.service-login', $socialLoginServiceKey)); ?>">
                                                    <img alt=""
                                                        src="<?php echo e(theme_asset(path: 'public/assets/front-end/img/icons/'.$socialLoginServiceKey.'.png')); ?>">
                                                    <span class="text">
                                                        <?php echo e(translate($socialLoginServiceKey)); ?>

                                                    </span>
                                                </a>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                    <?php if($customerOTPLogin && $customerManualLogin): ?>
                                        <a class="social-media-login-btn otp-login-btn" href="javascript:">
                                            <img alt=""
                                                src="<?php echo e(theme_asset(path: 'public/assets/front-end/img/icons/otp-login-icon.svg')); ?>">
                                            <span class="text"><?php echo e(translate('OTP_Sign_in')); ?></span>
                                        </a>
                                        <a class="social-media-login-btn manual-login-btn d-none" href="javascript:">
                                            <img alt=""
                                                src="<?php echo e(theme_asset(path: 'public/assets/front-end/img/icons/otp-login-icon.svg')); ?>">
                                            <span class="text"><?php echo e(translate('Manual_Login')); ?></span>
                                        </a>
                                    <?php endif; ?>
                                </div>
                                <?php if($multiColumn): ?>
                                    <?php echo $__env->make("web-views.customer-views.auth.partials._sign-up-instruction", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    
    <?php if($web_config['firebase_otp_verification_status']): ?>
        <script>
            $('.or-sign-in-with').css('width', $('.or-sign-in-with-row').height())
        </script>
    <?php endif; ?>

    <script src="<?php echo e(theme_asset(path: 'public/assets/front-end/plugin/intl-tel-input/js/intlTelInput.js')); ?>"></script>
    <script src="<?php echo e(theme_asset(path: 'public/assets/front-end/js/country-picker-init.js')); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    "use strict";
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.customer-centralize-login-form').forEach(function (form) {
            form.addEventListener('submit', function () {
                Swal.fire({
                    title: 'Processing...',
                    text: 'Please wait',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    didOpen: function () { Swal.showLoading(); }
                });
            });
        });
    });
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.front-end.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\musas\Desktop\softwares\6valley\POSA-latest version\POSA\resources\themes\default/web-views/customer-views/auth/login.blade.php ENDPATH**/ ?>