<?php $__env->startSection('title', translate('product_Report')); ?>
<?php $__env->startPush('css_or_js'); ?>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <div class="mb-3">
            <h2 class="h1 mb-0 text-capitalize d-flex gap-2 align-items-center">
                <img width="20" src="<?php echo e(asset('public/assets/back-end/img/seller_sale.png')); ?>" alt="">
                <?php echo e(translate('product_report')); ?>

            </h2>
        </div>
        <?php echo $__env->make('vendor-views.report.product-report-inline-menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="card mb-2">
            <div class="card-body">
                <form action="" id="form-data" method="GET">
                    <h4 class="mb-3"><?php echo e(translate('filter_Data')); ?></h4>
                    <div class="row gx-2 gy-3 align-items-center text-left">
                        <div class="col-sm-6 col-md-3">
                            <select class="form-control __form-control" name="date_type" id="date_type">
                                <option value="this_year" <?php echo e($date_type == 'this_year'? 'selected' : ''); ?>><?php echo e(translate('this_Year')); ?></option>
                                <option value="this_month" <?php echo e($date_type == 'this_month'? 'selected' : ''); ?>><?php echo e(translate('this_Month')); ?></option>
                                <option value="this_week" <?php echo e($date_type == 'this_week'? 'selected' : ''); ?>><?php echo e(translate('this_Week')); ?></option>
                                <option value="today" <?php echo e($date_type == 'today'? 'selected' : ''); ?>><?php echo e(translate('today')); ?></option>
                                <option value="custom_date" <?php echo e($date_type == 'custom_date'? 'selected' : ''); ?>><?php echo e(translate('custom_Date')); ?></option>
                            </select>
                        </div>
                        <div class="col-sm-6 col-md-3" id="from_div">
                            <div class="form-floating">
                                <input type="date" name="from" value="<?php echo e($from); ?>" id="from_date" class="form-control">
                                <label><?php echo e(translate('start_date')); ?></label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3" id="to_div">
                            <div class="form-floating">
                                <input type="date" value="<?php echo e($to); ?>" name="to" id="to_date" class="form-control">
                                <label><?php echo e(translate('end_date')); ?></label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-1">
                            <button type="submit" class="btn btn--primary px-4 px-md-5">
                                <?php echo e(translate('filter')); ?>

                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="store-report-content mb-2">
            <div class="left-content">
                <div class="left-content-card">
                    <img src="<?php echo e(dynamicAsset(path: '/public/assets/back-end/img/packaging.svg')); ?>" alt="">
                    <div class="info">
                        <h4 class="subtitle"><?php echo e($product_count['reject_product_count']+$product_count['active_product_count']+$product_count['pending_product_count']); ?></h4>
                        <h6 class="subtext"><?php echo e(translate('total_Product')); ?></h6>
                    </div>
                    <div class="coupon__discount w-100 text-right d-flex flex-wrap justify-content-between gap-2">
                        <div class="text-center">
                            <strong class="text-danger"><?php echo e($product_count['reject_product_count']); ?></strong>
                            <div><?php echo e(translate('rejected')); ?></div>
                        </div>
                        <div class="text-center">
                            <strong class="text-primary"><?php echo e($product_count['pending_product_count']); ?></strong>
                            <div><?php echo e(translate('pending')); ?></div>
                        </div>
                        <div class="text-center">
                            <strong class="text-success"><?php echo e($product_count['active_product_count']); ?></strong>
                            <div>
                                <?php echo e(translate('active')); ?>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="left-content-card">
                    <img src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/img/bag.svg')); ?>" alt="">
                    <div class="info">
                        <h4 class="subtitle">
                            <?php echo e($total_product_sale); ?>

                        </h4>
                        <h6 class="subtext"><?php echo e(translate('total_Product_Sale')); ?></h6>
                    </div>
                </div>
                <div class="left-content-card">
                    <img src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/img/discount.svg')); ?>" alt="">
                    <div class="info">
                        <h4 class="subtitle">
                            <?php echo e(setCurrencySymbol(amount: usdToDefaultCurrency(amount: $total_discount_given), currencyCode: getCurrencyCode())); ?>

                        </h4>
                        <h6 class="subtext">
                            <?php echo e(translate('total_Discount_Given')); ?>

                            <span class="ml-2" data-toggle="tooltip" data-placement="top"
                                  title="<?php echo e(translate('product_wise_discounted_amount_will_be_shown_here')); ?>">
                                <img class="info-img" src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/img/info-circle.svg')); ?>"
                                     alt="<?php echo e(translate('image')); ?>">
                            </span>
                        </h6>
                    </div>
                </div>
            </div>
            <div class="center-chart-area">
                <?php echo $__env->make('layouts.vendor.partials._apexcharts',['title'=>'product_Statistics','statisticsValue'=>$chart_data['total_product'],'label'=>array_keys($chart_data['total_product']),'statisticsTitle'=>'total_product','getCurrency'=>false], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>

        <div class="card">
            <div class="card-header border-0">
                <div class="d-flex flex-wrap w-100 gap-3 align-items-center">
                    <h4 class="mb-0 mr-auto">
                        <?php echo e(translate('total_Product')); ?>

                        <span class="badge badge-soft-dark radius-50 fs-12"> <?php echo e($products->total()); ?></span>
                    </h4>
                    <form action="" method="GET">
                        <!-- Search -->
                        <div class="input-group input-group-merge input-group-custom">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="tio-search"></i>
                                </div>
                            </div>
                            <input type="hidden" name="date_type" value="<?php echo e($date_type); ?>">
                            <input type="hidden" name="from" value="<?php echo e($from); ?>">
                            <input type="hidden" name="to" value="<?php echo e($to); ?>">
                            <input id="datatableSearch_" type="search" name="search" class="form-control"
                                   placeholder="<?php echo e(translate('search_Product_Name')); ?>" aria-label="Search orders"
                                   value="<?php echo e($search); ?>" required>
                            <button type="submit" class="btn btn--primary"><?php echo e(translate('search')); ?></button>
                        </div>
                    </form>
                    <div class="dropdown">
                        <a type="button" class="btn btn-outline--primary text-nowrap" href="<?php echo e(route('vendor.report.all-product-excel', ['search' => request('search'), 'date_type' => request('date_type'), 'from' => request('from'), 'to' => request('to')])); ?>">
                            <img width="14" src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/img/excel.png')); ?>" class="excel" alt="">
                            <span class="ps-2"><?php echo e(translate('export')); ?></span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive" id="products-table">
                    <table class="table table-hover __table table-borderless table-thead-bordered table-nowrap table-align-middle card-table w-100 <?php echo e(Session::get('direction') === "rtl" ? 'text-right' : 'text-left'); ?>">
                        <thead class="thead-light thead-50 text-capitalize">
                        <tr>
                            <th><?php echo e(translate('SL')); ?></th>
                            <th>
                                <?php echo e(translate('product_Name')); ?>

                            </th>
                            <th>
                                <?php echo e(translate('product_Unit_Price')); ?>

                            </th>
                            <th>
                                <?php echo e(translate('total_Amount_Sold')); ?>

                            </th>
                            <th>
                                <?php echo e(translate('total_Quantity_Sold')); ?>

                            </th>
                            <th>
                                <?php echo e(translate('average_Product_Value')); ?>

                            </th>
                            <th>
                                <?php echo e(translate('current_Stock_Amount')); ?>

                            </th>
                            <th>
                                <?php echo e(translate('average_Ratings')); ?>

                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($products->firstItem()+$key); ?></td>
                                <td>
                                    <a href="<?php echo e(route('vendor.products.view',[$product['id']])); ?>"
                                       class="media align-items-center gap-2 w-max-content">
                                        <?php echo e(\Illuminate\Support\Str::limit($product->name, 20)); ?>

                                    </a>
                                </td>
                                <td><?php echo e(setCurrencySymbol(amount: usdToDefaultCurrency(amount: $product->unit_price), currencyCode: getCurrencyCode())); ?></td>
                                <td><?php echo e(setCurrencySymbol(amount: usdToDefaultCurrency(amount: isset($product->orderDetails[0]->total_sold_amount) ? $product->orderDetails[0]->total_sold_amount : 0), currencyCode: getCurrencyCode())); ?></td>
                                <td>
                                    <?php echo e(isset($product->orderDetails[0]->product_quantity) ? $product->orderDetails[0]->product_quantity : 0); ?>

                                </td>
                                <td>
                                    <?php echo e(setCurrencySymbol(amount: usdToDefaultCurrency(amount: (
                                            isset($product->orderDetails[0]->total_sold_amount) ? $product->orderDetails[0]->total_sold_amount : 0) /
                                            (isset($product->orderDetails[0]->product_quantity) ? $product->orderDetails[0]->product_quantity : 1)
                                        ), currencyCode: getCurrencyCode())); ?>

                                </td>
                                <td>
                                    <?php echo e($product->product_type == 'digital' ? ($product->status==1 ? translate('available') : translate('not_available')) : $product->current_stock); ?>

                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="rating mr-1"><i class="tio-star"></i>
                                            <?php echo e(count($product->rating)>0?number_format($product->rating[0]->average, 2, '.', ' '):0); ?>

                                        </div>
                                        <div>
                                            ( <?php echo e($product->reviews->count()); ?> )
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="table-responsive mt-4">
                <div class="px-4 d-flex justify-content-center justify-content-md-end">
                    <?php echo $products->links(); ?>

                </div>
            </div>
            <?php if(count($products)==0): ?>
                <?php echo $__env->make('layouts.vendor.partials._empty-state',['text'=>'no_product_found'],['image'=>'default'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/js/apexcharts.js')); ?>"></script>
    <script src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/js/apexcharts-data-show.js')); ?>"></script>
    <script src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/js/vendor/product-report.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.vendor.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\musas\Desktop\softwares\6valley\POSA-latest version\POSA\resources\views/vendor-views/report/all-product.blade.php ENDPATH**/ ?>