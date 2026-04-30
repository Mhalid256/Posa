<div class="modal fade" id="add-discount" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title"><?php echo e(translate('update_discount')); ?></h3>
                <button type="button" class="btn-close border-0 btn-circle bg-section2 shadow-none" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="title-color mb-1"><?php echo e(translate('type')); ?></label>
                    <select name="type" id="type_ext_dis" class="form-control">
                        <option value="amount" <?php echo e(isset($discount_type) && $discount_type == 'amount' ? 'selected' : ''); ?>>
                            <?php echo e(translate('amount')); ?>

                        </option>
                        <option
                            value="percent" <?php echo e(isset($discount_type) && $discount_type == 'percent' ? 'selected' : ''); ?>>
                            <?php echo e(translate('percent')); ?>(%)
                        </option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="title-color mb-1"><?php echo e(translate('discount')); ?></label>
                    <input type="number" id="dis_amount" class="form-control" name="discount" placeholder="<?php echo e(translate('ex').':500'); ?>">
                </div>
                <div class="form-group">
                    <button class="btn btn-primary action-extra-discount" data-error-message="<?php echo e(translate('please_enter_discount_amount')); ?>">
                        <?php echo e(translate('submit')); ?>

                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\Users\musas\Desktop\softwares\6valley\POSA-latest version\POSA\resources\views/admin-views/pos/partials/modals/_add-discount.blade.php ENDPATH**/ ?>