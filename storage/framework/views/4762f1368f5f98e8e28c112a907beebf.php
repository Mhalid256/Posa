<div class="modal fade" id="chatting_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-faded-info">
                <h6 class="modal-title text-capitalize" id="exampleModalLongTitle">
                    <?php if(isset($seller) && isset($user_type) && $user_type == 'admin'): ?>
                        <?php echo e(translate('send_message_to')); ?> <?php echo e(getWebConfig(name: 'company_name')); ?>

                    <?php elseif(isset($seller) && isset($user_type) && $user_type == 'seller'): ?>
                        <?php echo e(translate('send_message_to')); ?> <?php echo e($seller->shop['name']); ?>

                    <?php endif; ?>
                </h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo e(route('messages')); ?>" method="post" id="seller-chat-form">
                    <?php echo csrf_field(); ?>

                    <input value="<?php echo e(isset($user_type) && $user_type == 'admin' ? 0 : $seller->id); ?>" name="vendor_id" hidden>
                    <textarea name="message" class="form-control min-height-100px max-height-200px" required placeholder="<?php echo e(translate('Write_here')); ?>..."></textarea>
                    <br>
                    <div class="justify-content-end gap-2 d-flex flex-wrap">
                        <a href="<?php echo e(route('chat', ['type' => 'vendor'])); ?>" class="btn btn-soft-primary bg--secondary border">
                            <?php echo e(translate('go_to_chatbox')); ?>

                        </a>
                        <button class="btn btn--primary text-white"><?php echo e(translate('send')); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\Users\musas\Desktop\softwares\6valley\POSA-latest version\POSA\resources\themes\default/layouts/front-end/partials/modal/_chatting.blade.php ENDPATH**/ ?>