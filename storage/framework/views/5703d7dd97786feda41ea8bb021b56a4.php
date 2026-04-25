<?php use App\Utils\Helpers; ?>

<?php $__env->startSection('title', translate('dashboard')); ?>
<?php $__env->startPush('css_or_js'); ?>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <?php if(auth('admin')->user()->admin_role_id == 1 || Helpers::module_permission_check('dashboard')): ?>
        <div class="content container-fluid">
            <div class="mb-3">
                <h1 class="page-header-title"><?php echo e(translate('welcome') . ' ' . auth('admin')->user()->name); ?></h1>
                <p><?php echo e(translate('monitor_your_business_analytics_and_statistics') . '.'); ?></p>
            </div>

            <div class="card mb-2 remove-card-shadow">
                <div class="card-body">
                    <div class="row flex-between align-items-center g-2 mb-3">
                        <div class="col-sm-6">
                            <h4 class="d-flex align-items-center text-capitalize gap-10 mb-0">
                                <img src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/img/business_analytics.png')); ?>"
                                    alt=""><?php echo e(translate('business_analytics')); ?>

                            </h4>
                        </div>
                        <div class="col-sm-6 d-flex justify-content-sm-end">
                            <div class="min-w-200">
                                <select class="custom-select w-auto" name="statistics_type" id="statistics_type">
                                    <option value="overall"
                                        <?php echo e(session()->has('statistics_type') && session('statistics_type') == 'overall' ? 'selected' : ''); ?>>
                                        <?php echo e(translate('overall_statistics')); ?>

                                    </option>
                                    <option value="today"
                                        <?php echo e(session()->has('statistics_type') && session('statistics_type') == 'today' ? 'selected' : ''); ?>>
                                        <?php echo e(translate('todays_Statistics')); ?>

                                    </option>
                                    <option value="this_month"
                                        <?php echo e(session()->has('statistics_type') && session('statistics_type') == 'this_month' ? 'selected' : ''); ?>>
                                        <?php echo e(translate('this_Months_Statistics')); ?>

                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row g-2" id="order_stats">
                        <?php echo $__env->make('admin-views.partials._dashboard-order-status', ['data' => $data], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
            </div>

            <div class="card mb-3 remove-card-shadow">
                <div class="card-body">
                    <h4 class="d-flex align-items-center text-capitalize gap-10 mb-3">
                        <img width="20" class="mb-1"
                            src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/img/admin-wallet.png')); ?>" alt="">
                        <?php echo e(translate('admin_wallet')); ?>

                    </h4>

                    <div class="row g-2" id="order_stats">
                        <?php echo $__env->make('admin-views.partials._dashboard-wallet-stats', ['data' => $data], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
            </div>

            <div class="row g-3">
                <div class="col-lg-8" id="order-statistics-div">
                    <?php echo $__env->make('admin-views.system.partials.order-statistics', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
                <div class="col-lg-4">
                    <div class="card remove-card-shadow h-100">
                        <div class="card-header">
                            <h4 class="d-flex align-items-center text-capitalize gap-10 mb-0 ">
                                <?php echo e(translate('user_overview')); ?>

                            </h4>
                        </div>
                        <div class="card-body justify-content-center d-flex flex-column">
                            <div>
                                <div class="position-relative">
                                    <div id="chart" class="apex-pie-chart d-flex justify-content-center"></div>
                                    <div class="total--orders">
                                        <h3 class="fw-bold"><?php echo e($data['getTotalCustomerCount'] + $data['getTotalVendorCount'] + $data['getTotalDeliveryManCount']); ?>

                                        </h3>
                                        <span class="text-capitalize"><?php echo e(translate('total_User')); ?></span>
                                    </div>
                                </div>
                                <div class="apex-legends flex-column">
                                    <div data-color="#7bc4ff">
                                        <span class="text-capitalize"><?php echo e(translate('total_customer') . ' ' . '(' . $data['getTotalCustomerCount'] . ')'); ?>

                                        </span>
                                    </div>
                                    <div data-color="#f9b530">
                                        <span
                                            class="text-capitalize"><?php echo e(translate('total_vendor') . ' ' . '(' . $data['getTotalVendorCount'] . ')'); ?></span>
                                    </div>
                                    <div data-color="#1c1a93">
                                        <span
                                            class="text-capitalize"><?php echo e(translate('total_delivery_man') . ' ' . '(' . $data['getTotalDeliveryManCount'] . ')'); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12" id="earn-statistics-div">
                    <?php echo $__env->make('admin-views.system.partials.earning-statistics', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
                <div class="col-md-6 col-xl-4">
                    <div class="card h-100 remove-card-shadow">
                        <?php echo $__env->make('admin-views.partials._top-customer', [
                            'top_customer' => $data['top_customer'],
                        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
                <div class="col-md-6 col-xl-4">
                    <div class="card h-100 remove-card-shadow">
                        <?php echo $__env->make('admin-views.partials._top-store-by-order', [
                            'top_store_by_order_received' => $data['top_store_by_order_received'],
                        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>

                <div class="col-md-6 col-xl-4">
                    <div class="card h-100 remove-card-shadow">
                        <?php echo $__env->make('admin-views.partials._top-selling-store', [
                            'topVendorByEarning' => $data['topVendorByEarning'],
                        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>

                <div class="col-md-6 col-xl-4">
                    <div class="card h-100 remove-card-shadow">
                        <?php echo $__env->make('admin-views.partials._most-rated-products', [
                            'mostRatedProducts' => $data['mostRatedProducts'],
                        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>

                <div class="col-md-6 col-xl-4">
                    <div class="card h-100 remove-card-shadow">
                        <?php echo $__env->make('admin-views.partials._top-selling-products', [
                            'topSellProduct' => $data['topSellProduct'],
                        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>

                <div class="col-md-6 col-xl-4">
                    <div class="card h-100 remove-card-shadow">
                        <?php echo $__env->make('admin-views.partials._top-delivery-man', [
                            'topRatedDeliveryMan' => $data['topRatedDeliveryMan'],
                        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-12 mb-2 mb-sm-0">
                        <h3 class="text-center"><?php echo e(translate('hi')); ?> <?php echo e(auth('admin')->user()->name); ?>

                            <?php echo e(' , ' . translate('welcome_to_dashboard')); ?>.</h3>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <span id="earning-statistics-url" data-url="<?php echo e(route('admin.dashboard.earning-statistics')); ?>"></span>
    <span id="order-status-url" data-url="<?php echo e(route('admin.dashboard.order-status')); ?>"></span>
    <span id="seller-text" data-text="<?php echo e(translate('vendor')); ?>"></span>
    <span id="message-commission-text" data-text="<?php echo e(translate('commission')); ?>"></span>
    <span id="in-house-text" data-text="<?php echo e(translate('In-house')); ?>"></span>
    <span id="customer-text" data-text="<?php echo e(translate('customer')); ?>"></span>
    <span id="store-text" data-text="<?php echo e(translate('store')); ?>"></span>
    <span id="product-text" data-text="<?php echo e(translate('product')); ?>"></span>
    <span id="order-text" data-text="<?php echo e(translate('order')); ?>"></span>
    <span id="brand-text" data-text="<?php echo e(translate('brand')); ?>"></span>
    <span id="business-text" data-text="<?php echo e(translate('business')); ?>"></span>
    <span id="orders-text" data-text="<?php echo e($data['order']); ?>"></span>
    <span id="user-overview-data" style="background-color: #000;" data-customer="<?php echo e($data['getTotalCustomerCount']); ?>"
        data-customer-title="<?php echo e(translate('Total_Customer')); ?>" data-vendor="<?php echo e($data['getTotalVendorCount']); ?>"
        data-vendor-title="<?php echo e(translate('Total_Vendor')); ?>" data-delivery-man="<?php echo e($data['getTotalDeliveryManCount']); ?>"
        data-delivery-man-title="<?php echo e(translate('Total_Delivery_Man')); ?>"></span>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script src="<?php echo e(dynamicAsset(path: 'public/assets/new/back-end/js/apexcharts.js')); ?>"></script>
    <script src="<?php echo e(dynamicAsset(path: 'public/assets/new/back-end/js/admin/dashboard.js')); ?>"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const guideModal = document.getElementById('guideModal');
            const arrowIcon = document.querySelector('.setup-guide__button .fi');
    
            if (guideModal && arrowIcon) {
                guideModal.addEventListener('shown.bs.modal', () => {
                    arrowIcon.classList.remove('fi-sr-angle-right');
                    arrowIcon.classList.add('fi-sr-angle-down');
                });
    
                guideModal.addEventListener('hidden.bs.modal', () => {
                    arrowIcon.classList.remove('fi-sr-angle-down');
                    arrowIcon.classList.add('fi-sr-angle-right');
                });
            }
        });
    </script>
        
    
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\musas\Desktop\softwares\6valley\POSA-latest\POSA\resources\views/admin-views/system/dashboard.blade.php ENDPATH**/ ?>