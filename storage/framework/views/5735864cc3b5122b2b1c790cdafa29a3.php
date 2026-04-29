

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
                                 src="<?php echo e($employee->image_full_url ?: dynamicAsset('public/assets/back-end/img/400x400/img2.jpg')); ?>" 
                                 style="object-fit: cover;">
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><?php echo e(translate('employee_image')); ?> <span class="text-info">(<?php echo e(translate('ratio')); ?> 1:1)</span></label>
                            <input type="file" name="image" id="imageInput" class="form-control image-input" data-image-id="viewer"
                                   accept=".jpg,.png,.jpeg,.gif,.bmp">
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><?php echo e(translate('identity_image')); ?></label>
                            <div class="row g-2 mb-2" id="existingIdentityImages">
                                <?php if($employee->identify_images && is_array($employee->identify_images)): ?>
                                    <?php $__currentLoopData = $employee->identify_images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col-4 position-relative existing-identity-img">
                                            <img src="<?php echo e($img); ?>" class="img-fluid rounded border w-100" style="height: 100px; object-fit: cover;">
                                            <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 m-1 remove-existing-img" data-img-url="<?php echo e($img); ?>" style="border-radius: 50%; width: 24px; height: 24px; padding: 0; line-height: 1;">
                                                <i class="fi fi-rr-trash" style="font-size: 10px;"></i>
                                            </button>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </div>
                            <div class="row g-2" id="newIdentityImagesPreview"></div>
                            <div class="mt-2">
                                <label class="btn btn-outline-secondary btn-sm">
                                    <i class="fi fi-rr-plus"></i> <?php echo e(translate('add_identity_images')); ?>

                                    <input type="file" name="identity_image[]" id="identityImageInput" class="d-none" multiple accept="image/*">
                                </label>
                                <small class="text-muted d-block mt-1"><?php echo e(translate('You can upload multiple images (JPG, PNG, max 5MB each)')); ?></small>
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
// Identity image preview logic (keep as before)
document.getElementById('identityImageInput')?.addEventListener('change', function(e) {
    const previewContainer = document.getElementById('newIdentityImagesPreview');
    previewContainer.innerHTML = '';
    const files = Array.from(e.target.files);
    files.forEach((file, index) => {
        const reader = new FileReader();
        reader.onload = function(ev) {
            const col = document.createElement('div');
            col.className = 'col-4 position-relative';
            col.innerHTML = `
                <img src="${ev.target.result}" class="img-fluid rounded border w-100" style="height: 100px; object-fit: cover;">
                <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 m-1 remove-new-img" data-index="${index}" style="border-radius: 50%; width: 24px; height: 24px; padding: 0;">
                    <i class="fi fi-rr-trash" style="font-size: 10px;"></i>
                </button>
            `;
            previewContainer.appendChild(col);
        };
        reader.readAsDataURL(file);
    });
});

$(document).on('click', '.remove-existing-img', function() {
    const container = $(this).closest('.existing-identity-img');
    const imgUrl = $(this).data('img-url');
    $('<input>').attr({ type: 'hidden', name: 'delete_identity_images[]', value: imgUrl }).appendTo('#employee-form');
    container.remove();
});

$(document).on('click', '.remove-new-img', function() {
    const index = $(this).data('index');
    $(this).closest('.col-4').remove();
    let removed = $('#removedImageIndexes').val();
    removed = removed ? removed.split(',') : [];
    removed.push(index);
    $('#removedImageIndexes').val(removed.join(','));
});
$('<input>').attr({ type: 'hidden', id: 'removedImageIndexes', name: 'removed_image_indexes' }).appendTo('#employee-form');

// Rest of your existing JavaScript (password strength, validation, etc.)
$(document).ready(function() {
    // ... all your existing validation and password toggle code from original ...
    function updatePasswordStrength() { /* ... */ }
    function passwordsMatch() { /* ... */ }
    // ... (keep everything exactly as you had it)
});
</script>

<style>
    /* Styling for selects */
    .form-select, select.form-select {
        display: block;
        width: 100%;
        padding: 0.5rem 1rem;
        font-size: 0.875rem;
        font-weight: 400;
        line-height: 1.5;
        color: #212529;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #e2e8f0;
        border-radius: 0.5rem;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 0.75rem center;
        background-size: 16px 12px;
    }
    .form-select:focus, select.form-select:focus {
        border-color: #86b7fe;
        outline: 0;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }
</style>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.vendor.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\musas\Desktop\softwares\6valley\POSA-latest version\POSA\resources\views/vendor-views/employee/edit.blade.php ENDPATH**/ ?>