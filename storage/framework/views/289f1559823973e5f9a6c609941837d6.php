
<?php $__env->startSection('title', translate('employee_add')); ?>
<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <div class="mb-3">
            <h2 class="h1 mb-0 text-capitalize d-flex align-items-center gap-2">
                <img src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/img/add-new-employee.png')); ?>" alt="">
                <?php echo e(translate('add_new_employee')); ?>

            </h2>
        </div>

        <form action="<?php echo e(route('vendor.employee.add')); ?>" method="post" enctype="multipart/form-data" class="text-start">
            <?php echo csrf_field(); ?>
            <div class="card">
                <div class="card-body">
                    <h3 class="mb-0 page-header-title text-capitalize d-flex align-items-center gap-2 border-bottom pb-3 mb-3">
                        <i class="fi fi-sr-user"></i>
                        <?php echo e(translate('general_information')); ?>

                    </h3>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="mb-2"><?php echo e(translate('full_name')); ?> <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" id="name"
                                       placeholder="<?php echo e(translate('ex') . ': ' . translate('John_Doe')); ?>"
                                       value="<?php echo e(old('name')); ?>" required>
                                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="form-group">
                                <label for="phone" class="mb-2"><?php echo e(translate('phone_number')); ?> <span class="text-danger">*</span></label>
                                <input type="tel" name="phone" class="form-control" value="<?php echo e(old('phone')); ?>"
                                       placeholder="<?php echo e(translate('ex') . ': 017xxxxxxxx'); ?>" required>
                                <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="form-group">
                                <label for="vendor_role_id" class="mb-2"><?php echo e(translate('role')); ?> <span class="text-danger">*</span></label>
                                <div class="select-wrapper">
                                    <select class="form-select" name="vendor_role_id" id="vendor_role_id" required>
                                        <option value="" selected disabled><?php echo e(translate('select_role')); ?></option>
                                        <?php $__currentLoopData = $employee_roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($role->id); ?>" <?php echo e(old('vendor_role_id')==$role->id?'selected':''); ?>><?php echo e(ucfirst($role->name)); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <?php $__errorArgs = ['vendor_role_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="form-group">
                                <label for="identify_type" class="mb-2"><?php echo e(translate('identify_type')); ?></label>
                                <div class="select-wrapper">
                                    <select class="form-select" name="identify_type" id="identify_type">
                                        <option value="" selected disabled><?php echo e(translate('select_identify_type')); ?></option>
                                        <option value="nid" <?php echo e(old('identify_type')=='nid'?'selected':''); ?>><?php echo e(translate('NID')); ?></option>
                                        <option value="passport" <?php echo e(old('identify_type')=='passport'?'selected':''); ?>><?php echo e(translate('passport')); ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="identify_number" class="mb-2"><?php echo e(translate('identify_number')); ?></label>
                                <input type="text" name="identify_number" value="<?php echo e(old('identify_number')); ?>" class="form-control"
                                       placeholder="<?php echo e(translate('ex') . ': 9876123123'); ?>" id="identify_number">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="text-center mb-3">
                                    <img class="upload-img-view" id="viewer"
                                         src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/img/400x400/img2.jpg')); ?>"
                                         alt="" style="width:150px;height:150px;object-fit:cover;border-radius:50%;">
                                </div>
                                <label for="custom-file-upload" class="mb-2"><?php echo e(translate('employee_image')); ?></label>
                                <span class="text-info">( <?php echo e(translate('ratio') . ' 1:1'); ?> )</span>
                                <div class="form-group">
                                    <div class="custom-file text-left">
                                        <input type="file" name="image" id="custom-file-upload"
                                               class="custom-file-input image-input"
                                               data-image-id="viewer"
                                               accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                                        <label class="custom-file-label"
                                               for="custom-file-upload"><?php echo e(translate('choose_file')); ?></label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="mb-4">
                                    <label class="mb-2"><?php echo e(translate('identity_image')); ?></label>
                                    <div>
                                        <div class="row" id="coba"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-body">
                    <h3 class="mb-0 page-header-title d-flex align-items-center gap-2 border-bottom pb-3 mb-3">
                        <i class="fi fi-sr-user"></i>
                        <?php echo e(translate('account_Information')); ?>

                    </h3>
                    <div class="row g-4">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="email" class="mb-2"><?php echo e(translate('email')); ?> <span class="text-danger">*</span></label>
                                <input type="email" name="email" value="<?php echo e(old('email')); ?>" class="form-control" id="email"
                                       placeholder="<?php echo e(translate('ex') . ': ex@gmail.com'); ?>" required>
                                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="password" class="mb-2 d-flex gap-2 align-items-center">
                                    <?php echo e(translate('password')); ?> <span class="text-danger">*</span>
                                    <span class="input-label-secondary cursor-pointer" data-bs-toggle="tooltip"
                                          data-bs-title="<?php echo e(translate('The_password_must_be_at_least_8_characters_long_and_contain_at_least_one_uppercase_letter') . ',' . translate('_one_lowercase_letter') . ',' . translate('_one_digit_') . ',' . translate('_one_special_character') . ',' . translate('_and_no_spaces') . '.'); ?>">
                                        <i class="fi fi-rr-info"></i>
                                    </span>
                                </label>
                                <div class="password-wrapper">
                                    <input type="password" class="form-control password-input" name="password" required id="password"
                                           placeholder="<?php echo e(translate('password_minimum_8_characters')); ?>">
                                    <i class="fi fi-sr-eye toggle-password-icon"></i>
                                </div>
                                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="password_confirmation" class="mb-2"><?php echo e(translate('confirm_password')); ?> <span class="text-danger">*</span></label>
                                <div class="password-wrapper">
                                    <input type="password" class="form-control password-input" name="password_confirmation" required id="password_confirmation"
                                           placeholder="<?php echo e(translate('confirm_password')); ?>">
                                    <i class="fi fi-sr-eye toggle-password-icon"></i>
                                </div>
                                <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end gap-3 mt-4">
                        <button type="reset" id="reset" class="btn btn-secondary"><?php echo e(translate('reset')); ?></button>
                        <button type="submit" class="btn btn-primary"><?php echo e(translate('submit')); ?></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <span id="coba-image" data-url="<?php echo e(dynamicAsset(path: "public/assets/back-end/img/400x400/img2.jpg")); ?>"></span>
    <span id="extension-error" data-text="<?php echo e(translate("please_only_input_png_or_jpg_type_file")); ?>"></span>
    <span id="size-error" data-text="<?php echo e(translate("file_size_too_big")); ?>"></span>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/js/spartan-multi-image-picker.js')); ?>"></script>
    <script src="<?php echo e(dynamicAsset(path: 'public/assets/backend/admin/js/user-management/employee.js')); ?>"></script>
    <script>
        $(document).ready(function() {
            // Image preview
            $('.image-input').on('change', function() {
                let reader = new FileReader();
                let imgId = $(this).data('image-id');
                reader.onload = function(e) { $('#' + imgId).attr('src', e.target.result); };
                if (this.files && this.files[0]) reader.readAsDataURL(this.files[0]);
            });

            // Password toggle inside input
            $('.password-wrapper').each(function() {
                let input = $(this).find('.password-input');
                let icon = $(this).find('.toggle-password-icon');
                icon.on('click', function() {
                    let type = input.attr('type') === 'password' ? 'text' : 'password';
                    input.attr('type', type);
                    icon.toggleClass('fi-sr-eye fi-sr-eye-crossed');
                });
            });
        });
    </script>
    <style>
        .password-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }
        .password-wrapper .password-input {
            padding-right: 35px;
            width: 100%;
        }
        .password-wrapper .toggle-password-icon {
            position: absolute;
            right: 10px;
            cursor: pointer;
            z-index: 10;
            color: #6c757d;
        }
        .password-wrapper .toggle-password-icon:hover {
            color: #007bff;
        }

        .select-wrapper select.form-select {
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            border: 1px solid #e2e8f0;
            background-color: white;
        }
    </style>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.vendor.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\musas\Desktop\softwares\6valley\POSA-latest version\POSA\resources\views/vendor-views/employee/add-new.blade.php ENDPATH**/ ?>