<div class="col-12 col-md-6 col-xl-3">
    <a class="business-analytics border card" href="<?php echo e(route('admin.orders.list',['all'])); ?>">
        <h4 class="business-analytics__subtitle"><?php echo e(translate('total_order')); ?></h4>
        <h3 class="h2"><?php echo e($data['order']); ?></h3>
        <img  src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/img/all-orders.png')); ?>" width="30" height="30" class="position-absolute end-3 top-3" alt="">
    </a>
</div>
<div class="col-12 col-md-6 col-xl-3">
    <a class="business-analytics border get-view-by-onclick card" href="<?php echo e(route('admin.vendors.vendor-list')); ?>">
        <h4><?php echo e(translate('total_Stores')); ?></h4>
        <h3 class="h2"><?php echo e($data['store']); ?></h3>
        <img width="30" src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/img/total-stores.png')); ?>" class="position-absolute end-3 top-3" alt="">
    </a>
</div>
<div class="col-12 col-md-6 col-xl-3">
    <a class="business-analytics border card">
        <h4 class="business-analytics__subtitle"><?php echo e(translate('total_Products')); ?></h4>
        <h3 class="h2"><?php echo e($data['product']); ?></h3>
        <img width="30" src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/img/total-product.png')); ?>" class="position-absolute end-3 top-3" alt="">
    </a>
</div>
<div class="col-12 col-md-6 col-xl-3">
    <a class="business-analytics border card" href="<?php echo e(route('admin.customer.list')); ?>">
        <h4 class="business-analytics__subtitle"><?php echo e(translate('total_Customers')); ?></h4>
        <h3 class="h2"><?php echo e($data['customer']); ?></h3>
        <img width="30" src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/img/total-customer.png')); ?>" class="position-absolute end-3 top-3" alt="">
    </a>
</div>


<div class="col-12 col-md-6 col-xl-3">
    <a class="d-flex gap-3 align-items-center justify-content-between p-20 bg-section rounded" href="<?php echo e(route('admin.orders.list',['pending'])); ?>">
        <div class="d-flex gap-3 align-items-center">
            <img width="20" src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/img/pending.png')); ?>" alt="">
            <h4 class="mb-0"><?php echo e(translate('pending')); ?></h4>
        </div>
        <span class="text-primary h3 mb-0">
            <?php echo e($data['pending']); ?>

        </span>
    </a>
</div>

<div class="col-12 col-md-6 col-xl-3">
    <a class="d-flex gap-3 align-items-center justify-content-between p-20 bg-section rounded order-stats_confirmed" href="<?php echo e(route('admin.orders.list',['confirmed'])); ?>">
        <div class="d-flex gap-3 align-items-center">
            <img width="20" src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/img/confirmed.png')); ?>" alt="">
            <h4 class="mb-0"><?php echo e(translate('confirmed')); ?></h4>
        </div>
        <span class="text-primary h3 mb-0">
            <?php echo e($data['confirmed']); ?>

        </span>
    </a>
</div>

<div class="col-12 col-md-6 col-xl-3">
    <a class="d-flex gap-3 align-items-center justify-content-between p-20 bg-section rounded order-stats_packaging" href="<?php echo e(route('admin.orders.list',['processing'])); ?>">
        <div class="d-flex gap-3 align-items-center">
            <img width="20" src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/img/packaging.png')); ?>" alt="">
            <h4 class="mb-0"><?php echo e(translate('packaging')); ?></h4>
        </div>
        <span class="text-primary h3 mb-0">
            <?php echo e($data['processing']); ?>

        </span>
    </a>
</div>

<div class="col-12 col-md-6 col-xl-3">
    <a class="d-flex gap-3 align-items-center justify-content-between p-20 bg-section rounded order-stats_out-for-delivery" href="<?php echo e(route('admin.orders.list',['out_for_delivery'])); ?>">
        <div class="d-flex gap-3 align-items-center">
            <img width="20" src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/img/out-of-delivery.png')); ?>" alt="">
            <h4 class="mb-0"><?php echo e(translate('out_for_delivery')); ?></h4>
        </div>
        <span class="text-primary h3 mb-0">
            <?php echo e($data['out_for_delivery']); ?>

        </span>
    </a>
</div>



<div class="col-12 col-md-6 col-xl-3">
    <div class="d-flex gap-3 align-items-center justify-content-between p-20 bg-section rounded order-stats_delivered cursor-pointer get-view-by-onclick" data-link="<?php echo e(route('admin.orders.list',['delivered'])); ?>">
        <div class="d-flex gap-3 align-items-center">
            <img width="20" src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/img/delivered.png')); ?>" alt="">
            <h4 class="mb-0"><?php echo e(translate('delivered')); ?></h4>
        </div>
        <span class="text-primary h3 mb-0"><?php echo e($data['delivered']); ?></span>
    </div>
</div>

<div class="col-12 col-md-6 col-xl-3">
    <div class="d-flex gap-3 align-items-center justify-content-between p-20 bg-section rounded order-stats_canceled cursor-pointer get-view-by-onclick" data-link="<?php echo e(route('admin.orders.list',['canceled'])); ?>">
        <div class="d-flex gap-3 align-items-center">
            <img width="20" src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/img/canceled.png')); ?>" alt="">
            <h4 class="mb-0"><?php echo e(translate('canceled')); ?></h4>
        </div>
        <span class="text-primary h3 mb-0 h3"><?php echo e($data['canceled']); ?></span>
    </div>
</div>

<div class="col-12 col-md-6 col-xl-3">
    <div class="d-flex gap-3 align-items-center justify-content-between p-20 bg-section rounded order-stats_returned cursor-pointer get-view-by-onclick" data-link="<?php echo e(route('admin.orders.list',['returned'])); ?>">
        <div class="d-flex gap-3 align-items-center">
            <img width="20" src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/img/returned.png')); ?>" alt="">
            <h4 class="mb-0"><?php echo e(translate('returned')); ?></h4>
        </div>
        <span class="text-primary h3 mb-0 h3"><?php echo e($data['returned']); ?></span>
    </div>
</div>

<div class="col-12 col-md-6 col-xl-3">
    <div class="d-flex gap-3 align-items-center justify-content-between p-20 bg-section rounded order-stats_failed cursor-pointer get-view-by-onclick" data-link="<?php echo e(route('admin.orders.list',['failed'])); ?>">
        <div class="d-flex gap-3 align-items-center">
            <img width="20" src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/img/failed-to-deliver.png')); ?>" alt="">
            <h4 class="mb-0"><?php echo e(translate('failed_to_delivery')); ?></h4>
        </div>
        <span class="text-primary h3 mb-0 h3"><?php echo e($data['failed']); ?></span>
    </div>
</div>
<?php /**PATH C:\Users\musas\Desktop\softwares\6valley\POSA-latest version\POSA\resources\views/admin-views/partials/_dashboard-order-status.blade.php ENDPATH**/ ?>