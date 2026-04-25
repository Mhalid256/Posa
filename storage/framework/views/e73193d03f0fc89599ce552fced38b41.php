

<?php $__env->startSection('title', translate('employee_edit')); ?>

<?php $__env->startSection('content'); ?>
<div class="content container-fluid">
    <div class="mb-4">
        <h2 class="h1 mb-0 text-capitalize d-flex align-items-center gap-2">
            <img src="<?php echo e(dynamicAsset('public/assets/back-end/img/add-new-employee.png')); ?>" width="30" alt="">
            <?php echo e(translate('employee_edit')); ?>

        </h2>
    </div>

    <form action="<?php echo e(route('vendor.employee.update', $employee->id)); ?>" method="POST" enctype="multipart/form-data" id="employee-form">
        <?php echo csrf_field(); ?>
        <?php echo method_field('POST'); ?>
        <input type="hidden" name="id" value="<?php echo e($employee->id); ?>">

        
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white border-0 pt-4 pb-0">
                <h3 class="mb-0 text-primary"><i class="fi fi-sr-user me-2"></i> <?php echo e(translate('general_information')); ?></h3>
            </div>
            <div class="card-body">
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label"><?php echo e(translate('full_name')); ?> <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                   value="<?php echo e(old('name', $employee->name)); ?>" required>
                            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <div class="invalid-feedback name-error"></div>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label"><?php echo e(translate('phone')); ?> <span class="text-danger">*</span></label>
                            <input type="tel" name="phone" id="phone" class="form-control <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                   value="<?php echo e(old('phone', $employee->phone)); ?>" required>
                            <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <div class="invalid-feedback phone-error"></div>
                        </div>

                        <div class="mb-3">
                            <label for="vendor_role_id" class="form-label"><?php echo e(translate('role')); ?> <span class="text-danger">*</span></label>
                            <select name="vendor_role_id" id="vendor_role_id" class="form-select <?php $__errorArgs = ['vendor_role_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                                <option value="" disabled <?php echo e(!$employee->vendor_role_id ? 'selected' : ''); ?>><?php echo e(translate('select_role')); ?></option>
                                <?php $__currentLoopData = $employee_roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($role->id); ?>" <?php echo e(old('vendor_role_id', $employee->vendor_role_id) == $role->id ? 'selected' : ''); ?>>
                                        <?php echo e(ucfirst($role->name)); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['vendor_role_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <div class="invalid-feedback role-error"></div>
                        </div>

                        <div class="mb-3">
                            <label for="identify_type" class="form-label"><?php echo e(translate('identify_type')); ?></label>
                            <select name="identify_type" id="identify_type" class="form-select">
                                <option value="" disabled <?php echo e(!$employee->identify_type ? 'selected' : ''); ?>><?php echo e(translate('select_identify_type')); ?></option>
                                <option value="nid" <?php echo e(old('identify_type', $employee->identify_type) == 'nid' ? 'selected' : ''); ?>><?php echo e(translate('NID')); ?></option>
                                <option value="passport" <?php echo e(old('identify_type', $employee->identify_type) == 'passport' ? 'selected' : ''); ?>><?php echo e(translate('passport')); ?></option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="identify_number" class="form-label"><?php echo e(translate('identify_number')); ?></label>
                            <input type="text" name="identify_number" id="identify_number" class="form-control"
                                   value="<?php echo e(old('identify_number', $employee->identify_number)); ?>">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="text-center mb-3">
                            <img class="rounded-circle border shadow-sm" id="viewer" width="150" height="150"
                                 src="<?php echo e(getStorageImages(path: $employee->image_full_url ?? [], type: 'backend-profile')); ?>" style="object-fit: cover;">
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><?php echo e(translate('employee_image')); ?> <span class="text-info">(<?php echo e(translate('ratio')); ?> 1:1)</span></label>
                            <input type="file" name="image" id="imageInput" class="form-control image-input" data-image-id="viewer"
                                   accept=".jpg,.png,.jpeg,.gif,.bmp">
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><?php echo e(translate('identity_image')); ?></label>
                            <div class="row g-2" id="identityImageContainer">
                                <?php if($employee->identify_images && is_array($employee->identify_images)): ?>
                                    <?php $__currentLoopData = $employee->identify_images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col-6">
                                            <img src="<?php echo e(getStorageImages(path: $img, type: 'backend-basic')); ?>" class="img-fluid rounded border">
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white border-0 pt-4 pb-0">
                <h3 class="mb-0 text-primary"><i class="fi fi-sr-lock me-2"></i> <?php echo e(translate('account_information')); ?></h3>
            </div>
            <div class="card-body">
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="email" class="form-label"><?php echo e(translate('email')); ?> <span class="text-danger">*</span></label>
                            <input type="email" name="email" id="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                   value="<?php echo e(old('email', $employee->email)); ?>" required>
                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <div class="invalid-feedback email-error"></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="password" class="form-label"><?php echo e(translate('password')); ?> <small class="text-muted"><?php echo e(translate('leave_blank_to_keep_current')); ?></small></label>
                            <div class="input-group">
                                <input type="password" name="password" id="password" class="form-control password-field" autocomplete="new-password">
                                <button class="btn btn-outline-secondary toggle-password" type="button" data-target="password">
                                    <i class="fi fi-sr-eye"></i>
                                </button>
                            </div>
                            <div class="password-requirements mt-2 small text-muted" style="display: none;">
                                <div class="d-flex flex-wrap gap-3">
                                    <span class="pass-req" data-req="length"><i class="fi fi-rr-circle-small"></i> 8 chars</span>
                                    <span class="pass-req" data-req="uppercase"><i class="fi fi-rr-circle-small"></i> Uppercase</span>
                                    <span class="pass-req" data-req="lowercase"><i class="fi fi-rr-circle-small"></i> Lowercase</span>
                                    <span class="pass-req" data-req="number"><i class="fi fi-rr-circle-small"></i> Number</span>
                                    <span class="pass-req" data-req="special"><i class="fi fi-rr-circle-small"></i> Special (!@#$%^&*)</span>
                                </div>
                            </div>
                            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback d-block"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <div class="invalid-feedback password-error"></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="confirm_password" class="form-label"><?php echo e(translate('confirm_password')); ?></label>
                            <div class="input-group">
                                <input type="password" name="confirm_password" id="confirm_password" class="form-control" autocomplete="new-password">
                                <button class="btn btn-outline-secondary toggle-password" type="button" data-target="confirm_password">
                                    <i class="fi fi-sr-eye"></i>
                                </button>
                            </div>
                            <div class="password-match-status small mt-1"></div>
                            <?php $__errorArgs = ['confirm_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback d-block"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <div class="invalid-feedback confirm-error"></div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-3 mt-4">
                    <a href="<?php echo e(route('vendor.employee.list')); ?>" class="btn btn-secondary px-4"><?php echo e(translate('cancel')); ?></a>
                    <button type="submit" id="submitBtn" class="btn btn-primary px-5">
                        <span class="submit-text"><?php echo e(translate('update')); ?></span>
                        <span class="spinner-border spinner-border-sm d-none" role="status"></span>
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
<script>
$(document).ready(function() {
    function updatePasswordStrength() {
        let pass = $('#password').val();
        if (pass.length === 0) return true; // optional
        const reqs = {
            length: pass.length >= 8,
            uppercase: /[A-Z]/.test(pass),
            lowercase: /[a-z]/.test(pass),
            number: /[0-9]/.test(pass),
            special: /[!@#$%^&*(),.?":{}|<>]/.test(pass)
        };
        let ok = true;
        $('.pass-req').each(function() {
            let req = $(this).data('req');
            let icon = $(this).find('i');
            if (reqs[req]) {
                icon.removeClass('fi-rr-circle-small').addClass('fi-rr-check-circle text-success');
                $(this).addClass('text-success').removeClass('text-muted');
            } else {
                icon.removeClass('fi-rr-check-circle').addClass('fi-rr-circle-small');
                $(this).removeClass('text-success').addClass('text-muted');
                ok = false;
            }
        });
        return ok;
    }
    function passwordsMatch() {
        let pass = $('#password').val();
        let confirm = $('#confirm_password').val();
        if (pass === confirm && pass !== '') {
            $('#confirm_password').removeClass('is-invalid').addClass('is-valid');
            $('.password-match-status').html('<i class="fi fi-rr-check-circle text-success"></i> <?php echo e(translate("passwords_match")); ?>');
            return true;
        } else if (confirm === '') {
            $('#confirm_password').removeClass('is-invalid is-valid');
            $('.password-match-status').html('');
            return false;
        } else {
            $('#confirm_password').removeClass('is-valid').addClass('is-invalid');
            $('.password-match-status').html('<i class="fi fi-rr-cross-circle text-danger"></i> <?php echo e(translate("passwords_do_not_match")); ?>');
            return false;
        }
    }
    $('#password, #confirm_password').on('keyup', function() {
        updatePasswordStrength();
        passwordsMatch();
    });
    $('#password').on('focus', function() { $('.password-requirements').show(); });
    $('#password').on('blur', function() { if (!$(this).val()) $('.password-requirements').hide(); });

    function validateName() {
        let val = $('#name').val().trim();
        if (val === '') { $('#name').addClass('is-invalid'); $('.name-error').text('<?php echo e(translate("name_required")); ?>'); return false; }
        else if (val.length < 2) { $('#name').addClass('is-invalid'); $('.name-error').text('<?php echo e(translate("min_2_chars")); ?>'); return false; }
        else { $('#name').removeClass('is-invalid').addClass('is-valid'); $('.name-error').text(''); return true; }
    }
    function validatePhone() {
        let val = $('#phone').val().trim();
        if (val === '') { $('#phone').addClass('is-invalid'); $('.phone-error').text('<?php echo e(translate("phone_required")); ?>'); return false; }
        else if (!/^[0-9+\-\s()]{10,15}$/.test(val)) { $('#phone').addClass('is-invalid'); $('.phone-error').text('<?php echo e(translate("valid_phone_required")); ?>'); return false; }
        else { $('#phone').removeClass('is-invalid').addClass('is-valid'); $('.phone-error').text(''); return true; }
    }
    function validateEmail() {
        let val = $('#email').val().trim();
        let re = /^[^\s@]+@([^\s@.,]+\.)+[^\s@.,]{2,}$/;
        if (val === '') { $('#email').addClass('is-invalid'); $('.email-error').text('<?php echo e(translate("email_required")); ?>'); return false; }
        else if (!re.test(val)) { $('#email').addClass('is-invalid'); $('.email-error').text('<?php echo e(translate("valid_email_required")); ?>'); return false; }
        else { $('#email').removeClass('is-invalid').addClass('is-valid'); $('.email-error').text(''); return true; }
    }
    function validateRole() {
        let role = $('#vendor_role_id').val();
        if (!role) { $('#vendor_role_id').addClass('is-invalid'); $('.role-error').text('<?php echo e(translate("role_required")); ?>'); return false; }
        else { $('#vendor_role_id').removeClass('is-invalid').addClass('is-valid'); $('.role-error').text(''); return true; }
    }
    $('#name, #phone, #email').on('keyup', function() {
        if ($(this).is('#name')) validateName();
        if ($(this).is('#phone')) validatePhone();
        if ($(this).is('#email')) validateEmail();
    });
    $('#vendor_role_id').on('change', validateRole);

    $('#employee-form').on('submit', function(e) {
        let isValid = validateName() && validatePhone() && validateEmail() && validateRole();
        let passValid = true;
        let matchValid = true;
        if ($('#password').val().length > 0) {
            passValid = updatePasswordStrength();
            matchValid = passwordsMatch();
            if (!$('#password').val().length) passValid = true;
        }
        if (!isValid || !passValid || !matchValid) {
            e.preventDefault();
            if (typeof toastr !== 'undefined') toastr.error('<?php echo e(translate("please_fix_errors")); ?>');
            else alert('<?php echo e(translate("please_fix_errors")); ?>');
            return false;
        }
        let btn = $('#submitBtn');
        btn.prop('disabled', true);
        btn.find('.submit-text').addClass('d-none');
        btn.find('.spinner-border').removeClass('d-none');
        return true;
    });

    $('.image-input').on('change', function() {
        let reader = new FileReader();
        let imgId = $(this).data('image-id');
        reader.onload = function(e) { $('#' + imgId).attr('src', e.target.result); };
        if (this.files && this.files[0]) reader.readAsDataURL(this.files[0]);
    });

    $('.toggle-password').on('click', function() {
        let target = $(this).data('target');
        let input = $('#' + target);
        let icon = $(this).find('i');
        if (input.attr('type') === 'password') {
            input.attr('type', 'text');
            icon.removeClass('fi-sr-eye').addClass('fi-sr-eye-crossed');
        } else {
            input.attr('type', 'password');
            icon.removeClass('fi-sr-eye-crossed').addClass('fi-sr-eye');
        }
    });
});
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.vendor.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\musas\Desktop\softwares\6valley\POSA-latest\POSA\resources\views/vendor-views/employee/edit.blade.php ENDPATH**/ ?>