<div class="form-group">
    <label class="form-label font-semibold">
        <?php echo e(translate('email')); ?> / <?php echo e(translate('phone')); ?>

        <span class="input-required-icon">*</span>
    </label>
    <input class="form-control text-align-direction auth-email-input" type="text" name="user_identity" id="si-email"
           value="<?php echo e(old('user_identity')); ?>" placeholder="<?php echo e(translate('enter_email_or_phone')); ?>"
           required>
    <div class="invalid-feedback"><?php echo e(translate('please_provide_valid_email_or_phone_number')); ?></div>
</div>
<?php /**PATH C:\Users\musas\Desktop\softwares\6valley\POSA-latest version\POSA\resources\themes\default/web-views/customer-views/auth/partials/_email.blade.php ENDPATH**/ ?>