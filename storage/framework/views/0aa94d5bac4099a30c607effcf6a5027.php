<div class="alert--container active">
    <a href="<?php echo e(route((is_null(auth('seller')->id())? 'admin':'vendor').'.messages.index', ['type' => 'customer'])); ?>">
        <div class="alert alert--message-2 alert-dismissible fade show "  id="chatting-new-notification-check" role="alert">
            <img width="28" src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/img/icons/chatting-notification.svg')); ?>" alt="">
            <div class="w-0">
                <h6><?php echo e(translate('Message')); ?></h6>
                <span id="chatting-new-notification-check-message">
                    <?php echo e(translate('New_Message')); ?>

                </span>
            </div>
            <button type="button" class="close position-relative p-0" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </a>

    <?php if(env('APP_MODE') == 'demo'): ?>
        <div class="alert alert--message-2 alert-dismissible fade show" id="demo-reset-warning">
            <img width="28" class="align-self-start" src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/img/info-2.png')); ?>" alt="">
            <div class="w-0">
                <h6><?php echo e(translate('warning').'!'); ?></h6>
                <span class="warning-message">
                    <?php echo e(translate('though_it_is_a_demo_site').'.'.translate('_our_system_automatically_reset_after_one_hour_&_that_why_you_logged_out').'.'); ?>

                </span>
            </div>
            <button type="button" class="close position-relative p-0" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <div class="alert alert--message-2 alert-dismissible fade show product-limited-stock-alert">
        <div class="d-flex">
            <img width="28" class="align-self-start image" src="" alt="">
        </div>
        <div class="w-0 text-start">
            <h6 class="title text-truncate"></h6>
            <span class="message">
            </span>
            <div class="d-flex justify-content-between gap-3 mt-2">
                <a href="javascript:" class="text-decoration-underline text-capitalize product-stock-alert-hide"><?php echo e(translate('do_not_show_again')); ?></a>
                <a href="javascript:" class="text-decoration-underline text-capitalize product-list"><?php echo e(translate('click_to_view')); ?></a>
            </div>
        </div>
        <button type="button" class="close position-relative p-0 product-stock-limit-close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>


    <div class="alert alert--message-2 alert-dismissible fade show product-restock-stock-alert">
        <div class="d-flex">
            <img width="28" class="align-self-start aspect-1 border rounded image" src="" alt="">
        </div>
        <div class="w-0 text-start">
            <h6 class="title text-truncate"></h6>
            <span class="message">
            </span>
            <div class="d-flex justify-content-between gap-3 mt-2">
                <a href="javascript:" class="text-decoration-underline text-capitalize product-restock-request-alert-hide"><?php echo e(translate('do_not_show_again')); ?></a>
                <a href="javascript:" class="text-decoration-underline text-capitalize get-view-by-onclick product-link"
                   data-link="">
                    <?php echo e(translate('click_to_view')); ?>

                </a>
            </div>
        </div>
        <button type="button" class="close position-relative p-0 product-restock-stock-close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>


    <div class="alert alert--message-3 alert--message-for-pos border-bottom alert-dismissible fade show">
        <img width="28" src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/img/warning.png')); ?>" alt="">
        <div class="w-0">
            <h6><?php echo e(translate('Warning').'!'); ?></h6>
            <span class="warning-message"></span>
        </div>
        <button type="button" class="close position-relative p-0 close-alert--message-for-pos">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>

<?php /**PATH C:\Users\musas\Desktop\softwares\6valley\POSA-latest\POSA\resources\views/layouts/vendor/partials/_alert-message.blade.php ENDPATH**/ ?>