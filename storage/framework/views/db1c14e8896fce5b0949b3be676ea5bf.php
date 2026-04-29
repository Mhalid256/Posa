<?php $__env->startSection('title', translate('bank_Info')); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid text-start">
        <div class="mb-3">
            <h2 class="h1 mb-0 text-capitalize d-flex align-items-center gap-2">
                <img width="20" src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/img/my-bank-info.png')); ?>" alt="">
                <?php echo e(translate('edit_Bank_info')); ?>

            </h2>
        </div>
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0 text-capitalize"><?php echo e(translate('edit_bank_info')); ?></h4>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo e(route('vendor.profile.update-bank-info',[$vendor->id])); ?>" method="post"
                              enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="name" class="title-color"><?php echo e(translate('bank_Name')); ?> <span class="text-danger">*</span></label>
                                        <input type="text" name="bank_name" value="<?php echo e($vendor->bank_name); ?>"
                                               class="form-control" id="name"
                                               required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="name" class="title-color"><?php echo e(translate('branch_Name')); ?> <span class="text-danger">*</span></label>
                                        <input type="text" name="branch" value="<?php echo e($vendor->branch); ?>" class="form-control"
                                               id="name"
                                               required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="account_no" class="title-color"><?php echo e(translate('holder_Name')); ?> <span class="text-danger">*</span></label>
                                        <input type="text" name="holder_name" value="<?php echo e($vendor->holder_name); ?>"
                                               class="form-control" id="account_no"
                                               required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="account_no" class="title-color"><?php echo e(translate('account_No')); ?> <span class="text-danger">*</span></label>
                                        <input type="number" name="account_no" value="<?php echo e($vendor->account_no); ?>"
                                               class="form-control" id="account_no"
                                               required>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end gap-2">
                                <a class="btn btn-danger" href="<?php echo e(route('vendor.profile.index')); ?>"><?php echo e(translate('cancel')); ?></a>
                                <button type="submit" class="btn btn--primary" id="btn_update"><?php echo e(translate('update')); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.vendor.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\musas\Desktop\softwares\6valley\POSA-latest\POSA\resources\views/vendor-views/profile/bank-info-update-view.blade.php ENDPATH**/ ?>