<?php ($rememberId = rand(111, 999)); ?>
<div class="form-group d-flex flex-wrap justify-content-between mb-1">
    <div class="rtl">
        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" name="remember"
                   id="remember<?php echo e($rememberId); ?>" <?php echo e(old('remember') ? 'checked' : ''); ?>>
            <label class="custom-control-label text-primary" for="remember<?php echo e($rememberId); ?>"><?php echo e(translate('remember_me')); ?></label>
        </div>
    </div>
    <?php if(isset($forgotPassword) && $forgotPassword): ?>
        <a class="font-size-sm text-primary text-underline" href="<?php echo e(route('customer.auth.recover-password')); ?>">
            <?php echo e(translate('forgot_password')); ?>?
        </a>
    <?php endif; ?>
</div>
<?php /**PATH C:\Users\musas\Desktop\softwares\6valley\POSA-latest version\POSA\resources\themes\default/web-views/customer-views/auth/partials/_remember-me.blade.php ENDPATH**/ ?>