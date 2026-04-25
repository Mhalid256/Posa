<div class="col-sm-6 col-lg-3">
    <a class="order-stats order-stats_pending" href="<?php echo e(route('vendor.orders.list',['pending'])); ?>">
        <div class="order-stats__content">
            <img width="20" src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/img/pending.png')); ?>" alt="">
            <h6 class="order-stats__subtitle"><?php echo e(translate('pending')); ?></h6>
        </div>
        <span class="order-stats__title"><?php echo e($orderStatus['pending']); ?></span>
    </a>
</div>
<div class="col-sm-6 col-lg-3">
    <a class="order-stats order-stats_confirmed" href="<?php echo e(route('vendor.orders.list',['confirmed'])); ?>">
        <div class="order-stats__content">
            <img width="20" src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/img/confirmed.png')); ?>" alt="">
            <h6 class="order-stats__subtitle"><?php echo e(translate('confirmed')); ?></h6>
        </div>
        <span class="order-stats__title"><?php echo e($orderStatus['confirmed']); ?></span>
    </a>
</div>
<div class="col-sm-6 col-lg-3">
    <a class="order-stats order-stats_packaging" href="<?php echo e(route('vendor.orders.list',['processing'])); ?>">
        <div class="order-stats__content">
            <img width="20" src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/img/packaging.png')); ?>" alt="">
            <h6 class="order-stats__subtitle"><?php echo e(translate('packaging')); ?></h6>
        </div>
        <span class="order-stats__title"><?php echo e($orderStatus['processing']); ?></span>
    </a>
</div>
<div class="col-sm-6 col-lg-3">
    <a class="order-stats order-stats_out-for-delivery" href="<?php echo e(route('vendor.orders.list',['out_for_delivery'])); ?>">
        <div class="order-stats__content">
            <img width="20" src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/img/out-of-delivery.png')); ?>" alt="">
            <h6 class="order-stats__subtitle"><?php echo e(translate('out_For_Delivery')); ?></h6>
        </div>
        <span class="order-stats__title"><?php echo e($orderStatus['out_for_delivery']); ?></span>
    </a>
</div>


<div class="ol-sm-6 col-lg-3">
    <a class="order-stats order-stats_delivered" href="<?php echo e(route('vendor.orders.list',['delivered'])); ?>">
        <div class="order-stats__content">
            <img width="20" src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/img/delivered.png')); ?>" alt="">
            <h6 class="order-stats__subtitle"><?php echo e(translate('delivered')); ?></h6>
        </div>
        <span class="order-stats__title"><?php echo e($orderStatus['delivered']); ?></span>
    </a>
</div>
<div class="ol-sm-6 col-lg-3">
    <a class="order-stats order-stats_canceled" href="<?php echo e(route('vendor.orders.list',['canceled'])); ?>">
        <div class="order-stats__content">
            <img width="20" src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/img/canceled.png')); ?>" alt="">
            <h6 class="order-stats__subtitle"><?php echo e(translate('canceled')); ?></h6>
        </div>
        <span class="order-stats__title"><?php echo e($orderStatus['canceled']); ?></span>
    </a>
</div>
<div class="ol-sm-6 col-lg-3">
    <a class="order-stats order-stats_returned" href="<?php echo e(route('vendor.orders.list',['returned'])); ?>">
        <div class="order-stats__content">
            <img width="20" src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/img/returned.png')); ?>" alt="">
            <h6 class="order-stats__subtitle"><?php echo e(translate('returned')); ?></h6>
        </div>
        <span class="order-stats__title"><?php echo e($orderStatus['returned']); ?></span>
    </a>
</div>
<div class="ol-sm-6 col-lg-3">
    <a class="order-stats order-stats_failed" href="<?php echo e(route('vendor.orders.list',['failed'])); ?>">
        <div class="order-stats__content">
            <img width="20" src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/img/failed-to-deliver.png')); ?>" alt="">
            <h6 class="order-stats__subtitle"><?php echo e(translate('failed_To_Delivery')); ?></h6>
        </div>
        <span class="order-stats__title"><?php echo e($orderStatus['failed']); ?></span>
    </a>
</div>
<?php /**PATH C:\Users\musas\Desktop\softwares\6valley\POSA-latest\POSA\resources\views/vendor-views/partials/_dashboard-order-status.blade.php ENDPATH**/ ?>