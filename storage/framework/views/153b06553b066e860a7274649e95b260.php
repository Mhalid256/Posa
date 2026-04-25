<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?php echo e(translate('ready_to_Leave').'?'); ?></h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body"><?php echo e(translate('Select_Logout_below_if_you_are_ready_to_end_your_current_session').'.'); ?></div>
            <div class="modal-footer">
                <form action="<?php echo e(route('admin.logout')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <button class="btn btn-danger" type="button" data-dismiss="modal"><?php echo e(translate('cancel')); ?></button>
                    <button class="btn btn--primary" type="submit"><?php echo e(translate('logout')); ?></button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="popup-modal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body py-4">
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex flex-wrap justify-content-center gap-2">
                            <div class="text-center w-100">
                                <h4 class="__color-8a8a8a">
                                    <i class="tio-shopping-cart-outlined"></i>
                                    <?php echo e(translate('you_have_new_order') .', '.translate('check_please').'.'); ?>

                                </h4>
                            </div>
                            <div class="d-flex justify-content-center gap-2">
                                <button class="btn btn-danger ignore-check-order">
                                    <?php echo e(translate('Ignore_this_now')); ?>

                                </button>
                                <button class="btn btn-primary check-order">
                                    <?php echo e(translate('ok') .', '. translate('let_me_check')); ?>

                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\Users\musas\Desktop\softwares\6valley\POSA-latest\POSA\resources\views/layouts/admin/partials/_modals.blade.php ENDPATH**/ ?>