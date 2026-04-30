<div class="modal fade" id="add-customer" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?php echo e(translate('add_new_customer')); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo e(route('vendor.customer.add')); ?>" method="post" id="product_form">
                    <?php echo csrf_field(); ?>
                    <div class="row pl-2">
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label class="input-label"><?php echo e(translate('first_name')); ?> <span
                                        class="input-label-secondary text-danger">*</span></label>
                                <input type="text" name="f_name" class="form-control" value="<?php echo e(old('f_name')); ?>"
                                       placeholder="<?php echo e(translate('first_name')); ?>" required>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label class="input-label"><?php echo e(translate('last_name')); ?>

                                    <span class="input-label-secondary text-danger">*</span></label>
                                <input type="text" name="l_name" class="form-control" value="<?php echo e(old('l_name')); ?>"
                                       placeholder="<?php echo e(translate('last_name')); ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="row pl-2">
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label class="input-label"><?php echo e(translate('email')); ?><span
                                        class="input-label-secondary text-danger">*</span></label>
                                <input type="email" name="email" class="form-control" value="<?php echo e(old('email')); ?>"
                                       placeholder="<?php echo e(translate('ex').': ex@example.com'); ?>" required>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label class="input-label"><?php echo e(translate('phone')); ?><span
                                        class="input-label-secondary text-danger">*</span></label>
                                <div class="mb-3">
                                    <input class="form-control form-control-user phone-input-with-country-picker"
                                           type="tel" id="exampleInputPhone" value="<?php echo e(old('phone')); ?>"
                                           placeholder="<?php echo e(translate('enter_phone_number')); ?>" required>
                                    <div class="">
                                        <input type="text" class="country-picker-phone-number w-50" value="<?php echo e(old('phone')); ?>" name="phone" hidden  readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row pl-2">
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label class="input-label"><?php echo e(translate('country')); ?></label>
                                <select name="country" class="form-control js-select2-custom" data-live-search="true">
                                    <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($country['name']); ?>"><?php echo e($country['name']); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label class="input-label"><?php echo e(translate('city')); ?></label>
                                <input type="text" name="city" class="form-control" value="<?php echo e(old('city')); ?>"
                                       placeholder="<?php echo e(translate('city')); ?>">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label class="input-label"><?php echo e(translate('zip_code')); ?></label>
                                <?php if($zipCodes): ?>
                                    <select name="zip" class="form-control js-select2-custom" data-live-search="true">
                                        <?php $__currentLoopData = $zipCodes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option
                                                value="<?php echo e($code->zipcode); ?>"><?php echo e($code->zipcode); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                <?php else: ?>
                                <input type="text" name="zip_code" class="form-control"
                                       value="<?php echo e(old('zip_code')); ?>" placeholder="<?php echo e(translate('zip_code')); ?>">
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label class="input-label"><?php echo e(translate('address')); ?></label>
                                <input type="text" name="address" class="form-control" value="<?php echo e(old('address')); ?>"
                                       placeholder="<?php echo e(translate('address')); ?>">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-end">
                        <button type="submit" id="submit_new_customer"
                                class="btn btn--primary"><?php echo e(translate('submit')); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\Users\musas\Desktop\softwares\6valley\POSA-latest version\POSA\resources\views/vendor-views/pos/partials/modals/_add-customer.blade.php ENDPATH**/ ?>