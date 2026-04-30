<?php (session(['last_order'=> false])); ?>
<div class="modal fade py-5" id="print-invoice" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?php echo e(translate('print_Invoice')); ?></h5>
                <button id="invoice_close" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body row">

                <div class="col-md-12">
                    <div class="text-center">
                        <input id="print_invoice" type="button" class="btn btn--primary non-printable action-print-pos-invoice"
                               data-print="#printableArea"
                               value="<?php echo e(translate('proceed')); ?>, <?php echo e(translate('if_thermal_printer_is_ready')); ?>"/>
                        <a href="<?php echo e(url()->previous()); ?>" class="btn btn-danger non-printable">
                            <?php echo e(translate('back')); ?>

                        </a>
                    </div>
                    <hr class="non-printable">
                </div>

                <div class="row m-auto" id="printableArea">
                    <?php echo $__env->make('vendor-views.pos.order.invoice', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>

            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\Users\musas\Desktop\softwares\6valley\POSA-latest version\POSA\resources\views/vendor-views/pos/partials/modals/_print-invoice.blade.php ENDPATH**/ ?>