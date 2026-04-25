<div class="modal fade" id="sign-out-modal" tabindex="-1" aria-labelledby="sign-out-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0 d-flex justify-content-end">
                <button type="button" class="btn-close border-0 btn-circle bg-section2 shadow-none" aria-label="Close"
                        data-bs-dismiss="modal">
                </button>
            </div>
            <div class="modal-body px-20 py-0 mb-30">
                <div class="d-flex flex-column align-items-center text-center mb-30">
                    <img src="<?php echo e(dynamicAsset('public/assets/back-end/img/sign-out.png')); ?>" width="60" class="mb-20"
                         alt="">
                    <h2 class="modal-title mb-3">
                        <?php echo e(translate('do_you_want_to_logout').' ?'); ?>

                    </h2>
                    <div class="text-center">
                        <?php echo e(translate('You_will_be_logout_from_your_panel.')); ?>

                    </div>
                </div>
                <div class="d-flex justify-content-center gap-3">
                    <a href="<?php echo e(route('admin.logout')); ?>" class="btn btn-sm btn-danger max-w-120 flex-grow-1">
                        <?php echo e(translate('Yes')); ?>

                    </a>
                    <button type="button" class="btn btn-sm btn-secondary max-w-120 flex-grow-1"
                            data-bs-dismiss="modal">
                        <?php echo e(translate('No')); ?>

                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\Users\musas\Desktop\softwares\6valley\POSA-latest\POSA\resources\views/layouts/admin/partials/_sign-out-modal.blade.php ENDPATH**/ ?>