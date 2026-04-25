<?php $__env->startSection('title', translate('dashboard')); ?>
<?php $__env->startPush('css_or_js'); ?>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <div class="page-header pb-0 border-0 mb-3">
            <div class="flex-between row align-items-center mx-1">
                <div>
                    <h1 class="page-header-title text-capitalize">
                        <?php echo e(translate('welcome') . ' '); ?>

                        <?php if(isVendorEmployee()): ?>
                            <?php echo e(auth('vendor_employee')->user()->f_name . ' ' . auth('vendor_employee')->user()->l_name); ?>

                        <?php else: ?>
                            <?php echo e(auth('seller')->user()->f_name . ' ' . auth('seller')->user()->l_name); ?>

                        <?php endif; ?>
                    </h1>
                    <p><?php echo e(translate('monitor_your_business_analytics_and_statistics').'.'); ?></p>
                </div>

                <div>
                    <a class="btn btn--primary" href="<?php echo e(route('vendor.products.list',['type'=>'all'])); ?>">
                        <i class="tio-premium-outlined mr-1"></i> <?php echo e(translate('products')); ?>

                    </a>
                </div>
            </div>
        </div>
        <div class="card mb-3 remove-card-shadow">
            <div class="card-body">
                <div class="row justify-content-between align-items-center g-2 mb-3">
                    <div class="col-sm-6">
                        <h4 class="d-flex align-items-center text-capitalize gap-10 mb-0">
                            <img src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/img/business_analytics.png')); ?>" alt="">
                            <?php echo e(translate('order_analytics')); ?>

                        </h4>
                    </div>
                    <div class="col-sm-6 d-flex justify-content-sm-end">
                        <select class="custom-select w-auto" id="statistics_type" name="statistics_type">
                            <option value="overall">
                                <?php echo e(translate('overall_Statistics')); ?>

                            </option>
                            <option value="today">
                                <?php echo e(translate('todays_Statistics')); ?>

                            </option>
                            <option value="thisMonth">
                                <?php echo e(translate('this_Months_Statistics')); ?>

                            </option>
                        </select>
                    </div>
                </div>
                <div class="row g-2" id="order_stats">
                    <?php echo $__env->make('vendor-views.partials._dashboard-order-status',['orderStatus'=>$dashboardData['orderStatus']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
        </div>
        <?php if(!isVendorEmployee()): ?>
        <div class="card mb-3 remove-card-shadow">
            <div class="card-body">
                <div class="row justify-content-between align-items-center g-2 mb-3">
                    <div class="col-sm-6">
                        <h4 class="d-flex align-items-center text-capitalize gap-10 mb-0">
                            <img width="20" class="mb-1" src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/img/admin-wallet.png')); ?>" alt="">
                            <?php echo e(translate('vendor_Wallet')); ?>

                        </h4>
                    </div>
                </div>
                <div class="row g-2" id="order_stats">
                    <?php echo $__env->make('vendor-views.partials._dashboard-wallet-status',['dashboardData'=>$dashboardData], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
        </div>
        <?php endif; ?> 

        <div class="modal fade" id="balance-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><?php echo e(translate('withdraw_Request')); ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?php echo e(route('vendor.dashboard.withdraw-request')); ?>" method="post">
                        <div class="modal-body">
                            <?php echo csrf_field(); ?>
                            <div class="">
                                <select class="form-control" id="withdraw_method" name="withdraw_method" required>
                                    <?php $__currentLoopData = $withdrawalMethods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($method['id']); ?>" <?php echo e($method['is_default'] ? 'selected':''); ?>><?php echo e($method['method_name']); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            <div class="" id="method-filed__div">

                            </div>

                            <div class="mt-1">
                                <label for="recipient-name" class="col-form-label fz-16"><?php echo e(translate('amount')); ?>

                                    :</label>
                                <input type="number" name="amount" step=".01"
                                       value="<?php echo e(setCurrencySymbol(amount: usdToDefaultCurrency(amount: $dashboardData['totalEarning']), currencyCode: getCurrencyCode(type: 'default'))); ?>"
                                       class="form-control" id="">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                    data-dismiss="modal"><?php echo e(translate('close')); ?></button>
                                <button type="submit"
                                        class="btn btn--primary"><?php echo e(translate('request')); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row g-2">
            <?php ( $shippingMethod = getWebConfig('shipping_method')); ?>
            <div class="col-12" id="earn-statistics-div">
                <?php echo $__env->make('vendor-views.dashboard.partials.earning-statistics', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <div class="col-lg-<?php echo e($shippingMethod != 'sellerwise_shipping' ? '6':'4'); ?>">
                <div class="card h-100 remove-card-shadow">
                    <?php echo $__env->make('vendor-views.partials._top-rated-products',['topRatedProducts'=>$dashboardData['topRatedProducts']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
            <div class="col-lg-<?php echo e($shippingMethod != 'sellerwise_shipping' ? '6':'4'); ?>">
                <div class="card h-100 remove-card-shadow">
                    <?php echo $__env->make('vendor-views.partials._top-selling-products',['topSell'=>$dashboardData['topSell']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
            <?php if($shippingMethod=='sellerwise_shipping'): ?>
                <div class="col-lg-4">
                    <div class="card h-100 remove-card-shadow">
                        <?php echo $__env->make('vendor-views.partials._top-rated-delivery-man',['topRatedDeliveryMan'=>$dashboardData['topRatedDeliveryMan']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
           <?php endif; ?>
        </div>
    </div>
    <span id="withdraw-method-url" data-url="<?php echo e(route('vendor.dashboard.method-list')); ?>"></span>
    <span id="order-status-url" data-url="<?php echo e(route('vendor.dashboard.order-status', ['type' => ':type'])); ?>"></span>
    <span id="seller-text" data-text="<?php echo e(translate('vendor')); ?>"></span>
    <span id="in-house-text" data-text="<?php echo e(translate('In-house')); ?>"></span>
    <span id="customer-text" data-text="<?php echo e(translate('customer')); ?>"></span>
    <span id="store-text" data-text="<?php echo e(translate('store')); ?>"></span>
    <span id="product-text" data-text="<?php echo e(translate('product')); ?>"></span>
    <span id="order-text" data-text="<?php echo e(translate('order')); ?>"></span>
    <span id="brand-text" data-text="<?php echo e(translate('brand')); ?>"></span>
    <span id="business-text" data-text="<?php echo e(translate('business')); ?>"></span>
    <span id="customers-text" data-text="<?php echo e($dashboardData['customers']); ?>"></span>
    <span id="products-text" data-text="<?php echo e($dashboardData['products']); ?>"></span>
    <span id="orders-text" data-text="<?php echo e($dashboardData['orders']); ?>"></span>
    <span id="brands-text" data-text="<?php echo e($dashboardData['brands']); ?>"></span>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>
    <script src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/js/apexcharts.js')); ?>"></script>
    <script src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/js/vendor/dashboard.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.vendor.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\musas\Desktop\softwares\6valley\POSA-latest\POSA\resources\views/vendor-views/dashboard/index.blade.php ENDPATH**/ ?>