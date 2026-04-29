<div class="modal fade" id="sign-out-modal" tabindex="-1" aria-labelledby="toggle-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg">
            <div class="modal-header border-0 pb-0 d-flex justify-content-end">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="tio-clear"></i></button>
            </div>
            <div class="modal-body px-4 px-sm-5 pt-0 pb-sm-5">
                <div class="d-flex flex-column align-items-center text-center gap-2 mb-2">
                    <div class="toggle-modal-img-box d-flex flex-column justify-content-center align-items-center mb-3 position-relative">
                        <img src="<?php echo e(dynamicAsset('public/assets/back-end/img/sign-out.png')); ?>" class="status-icon"  alt="" width="60"/>
                    </div>
                    <h5 class="modal-title mb-2"><?php echo e(translate('do_you_want_to_logout').'?'); ?> </h5>
                </div>
                <div class="d-flex justify-content-center gap-3">
                    <a href="<?php echo e(route('vendor.auth.logout')); ?>" class="btn btn--primary min-w-120"><?php echo e(translate('yes')); ?></a>
                    <button type="button" class="btn btn-danger-light min-w-120" data-dismiss="modal"><?php echo e(translate('cancel')); ?></button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\Users\musas\Desktop\softwares\6valley\POSA-latest version\POSA\resources\views/layouts/vendor/partials/_sign-out-modal.blade.php ENDPATH**/ ?>