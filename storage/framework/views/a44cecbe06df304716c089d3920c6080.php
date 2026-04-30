<?php $__env->startSection('title', translate('order_Transactions')); ?>
<?php $__env->startSection('content'); ?>
    <div class="content container-fluid ">
        <div class="mb-4">
            <h2 class="h1 mb-0 text-capitalize d-flex align-items-center gap-2">
                <img width="20" src="<?php echo e(asset('public/assets/back-end/img/order_report.png')); ?>" alt="">
                <?php echo e(translate('transaction_report')); ?>

            </h2>
        </div>
        <?php echo $__env->make('vendor-views.transaction.transaction-report-inline-menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="card mb-2">
            <div class="card-body">
                <h4 class="mb-3"><?php echo e(translate('filter_Data')); ?></h4>
                <form action="#" id="form-data" method="GET" class="w-100">
                    <div class="row  gx-2 gy-3 align-items-center text-<?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>">
                        <div class="col-sm-6 col-md-3">
                            <div class="">
                                <select class="form-control __form-control" name="status">
                                    <option class="text-center" value="0" disabled>
                                        ---<?php echo e(translate('select_status')); ?>---
                                    </option>
                                    <option class="text-capitalize"
                                            value="all" <?php echo e($status == 'all'? 'selected' : ''); ?> ><?php echo e(translate('all')); ?> </option>
                                    <option class="text-capitalize"
                                            value="disburse" <?php echo e($status == 'disburse'? 'selected' : ''); ?> ><?php echo e(translate('disburse')); ?> </option>
                                    <option class="text-capitalize"
                                            value="hold" <?php echo e($status == 'hold'? 'selected' : ''); ?>><?php echo e(translate('hold')); ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="">
                                <select class="js-select2-custom form-control __form-control" name="customer_id">
                                    <option class="text-center"
                                            value="all" <?php echo e($customer_id == 'all' ? 'selected' : ''); ?>>
                                        <?php echo e(translate('all_customer')); ?>

                                    </option>

                                    <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option class="text-left text-capitalize"
                                                value="<?php echo e($customer->id); ?>" <?php echo e($customer->id == $customer_id ? 'selected' : ''); ?>>
                                            <?php echo e($customer->f_name.' '.$customer->l_name); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>

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
                                <input type="date" name="from" value="<?php echo e($from); ?>" id="from_date"
                                       class="form-control __form-control">
                                <label><?php echo e(translate('start_date')); ?></label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3" id="to_div">
                            <div class="form-floating">
                                <input type="date" value="<?php echo e($to); ?>" name="to" id="to_date"
                                       class="form-control __form-control">
                                <label><?php echo e(translate('end_date')); ?></label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-2 d-flex gap-2">
                            <button type="submit" class="btn btn--primary px-4 min-w-120 __h-45px"
                                    id="formUrlChange"
                                    data-action="<?php echo e(url()->current()); ?>">
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
                    <img src="<?php echo e(dynamicAsset(path: '/public/assets/back-end/img/cart.svg')); ?>" alt="">
                    <div class="info">
                        <h4 class="subtitle"><?php echo e($product_data['total_products']); ?></h4>
                        <h6 class="subtext"><?php echo e(translate('total_Products')); ?></h6>
                    </div>
                </div>
                <div class="left-content-card">
                    <img src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/img/products.svg')); ?>" alt="">
                    <div class="info">
                        <h4 class="subtitle"><?php echo e($product_data['active_products']); ?></h4>
                        <h6 class="subtext"><?php echo e(translate('active_Products')); ?></h6>
                    </div>
                </div>
                <div class="left-content-card">
                    <img src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/img/inactive-product.svg')); ?>" alt="">
                    <div class="info">
                        <h4 class="subtitle"><?php echo e($product_data['inactive_products']); ?></h4>
                        <h6 class="subtext"><?php echo e(translate('inactive_Products')); ?></h6>
                    </div>
                </div>
                <div class="left-content-card">
                    <img src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/img/pending_products.svg')); ?>" alt="">
                    <div class="info">
                        <h4 class="subtitle"><?php echo e($product_data['pending_products']); ?></h4>
                        <h6 class="subtext"><?php echo e(translate('pending_Products')); ?></h6>
                    </div>
                </div>
            </div>
            <?php $__currentLoopData = $order_transaction_chart['order_amount']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $amount): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php ($chartVal[] = usdToDefaultCurrency(amount: $amount)); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <div class="center-chart-area">
                <?php echo $__env->make('layouts.vendor.partials._apexcharts',['title'=>'order_Statistics','statisticsValue'=>$chartVal,'label'=>array_keys($order_transaction_chart['order_amount']),'statisticsTitle'=>'total_order_amount'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <div class="right-content">
                <div class="card h-100 bg-white payment-statistics-shadow">
                    <div class="card-header border-0 ">
                        <h5 class="card-title">
                            <span><?php echo e(translate('payment_Statistics')); ?></span>
                        </h5>
                    </div>
                    <div class="card-body px-0 pt-0">
                        <div class="position-relative pie-chart">
                            <div id="dognut-pie" class="label-hide"></div>
                            <div class="total--orders">
                                <h3><?php echo e(getCurrencySymbol(currencyCode: getCurrencyCode())); ?><?php echo e(getFormatCurrency(amount: usdToDefaultCurrency(amount: $payment_data['total_payment']))); ?></h3>
                                <span><?php echo e(translate('completed_payments')); ?></span>
                            </div>
                        </div>
                        <div class="apex-legends">
                            <div class="before-bg-004188">
                                <span><?php echo e(translate('cash_payments')); ?> (<?php echo e(setCurrencySymbol(amount: usdToDefaultCurrency(amount: $payment_data['cash_payment']), currencyCode: getCurrencyCode())); ?>)</span>
                            </div>
                            <div class="before-bg-0177CD">
                                <span><?php echo e(translate('digital_payments')); ?> (<?php echo e(setCurrencySymbol(amount: usdToDefaultCurrency(amount: $payment_data['digital_payment']), currencyCode: getCurrencyCode())); ?>) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            </div>
                            <div class="before-bg-A2CEEE">
                                <span><?php echo e(translate('wallet')); ?> (<?php echo e(setCurrencySymbol(amount: usdToDefaultCurrency(amount: $payment_data['wallet_payment']), currencyCode: getCurrencyCode())); ?>)</span>
                            </div>
                            <div class="before-bg-CDE6F5">
                                <span><?php echo e(translate('offline_payments')); ?> (<?php echo e(setCurrencySymbol(amount: usdToDefaultCurrency(amount: $payment_data['offline_payment']), currencyCode: getCurrencyCode())); ?>)</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="px-3 py-4">
                <div class="d-flex flex-wrap gap-3 align-items-center">
                    <h4 class="mb-0 mr-auto">
                        <?php echo e(translate('total_Transactions')); ?>

                        <span class="badge badge-soft-dark radius-50 fs-12"><?php echo e($transactions->total()); ?></span>
                    </h4>
                    <form action="<?php echo e(url()->full()); ?>" method="GET" class="mb-0">
                        <div class="input-group input-group-merge input-group-custom">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="tio-search"></i>
                                </div>
                            </div>
                            <input id="datatableSearch_" type="search" name="search" class="form-control"
                                   placeholder="<?php echo e(translate('search_by_orders_id_or_transaction_ID')); ?>"
                                   aria-label="Search orders"
                                   value="<?php echo e($search); ?>"
                                   required>
                            <button type="submit" class="btn btn--primary"><?php echo e(translate('search')); ?></button>
                        </div>
                    </form>
                    <div>
                        <a href="<?php echo e(route('vendor.transaction.order-transaction-summary-pdf', ['date_type'=>request('date_type'), 'customer_id'=>request('customer_id'), 'status'=>request('status'), 'from'=>request('from'), 'to'=>request('to'), 'search'=>request('search')])); ?>"
                           class="btn btn-outline--primary text-nowrap btn-block">
                            <i class="tio-file-text"></i>
                            <?php echo e(translate('download_PDF')); ?>

                        </a>
                    </div>
                    <div class="dropdown">
                        <a type="button" class="btn btn-outline--primary text-nowrap" href="<?php echo e(route('vendor.transaction.order-transaction-export-excel', ['date_type'=>request('date_type'), 'customer_id'=>request('customer_id')??'all', 'search'=>request('search'), 'status'=>request('status'), 'from'=>request('from'), 'to'=>request('to')])); ?>">
                            <img width="14" src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/img/excel.png')); ?>" class="excel" alt="">
                            <span class="ps-2"><?php echo e(translate('export')); ?></span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table id="datatable" class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table w-100 __table">
                    <thead class="thead-light thead-50 text-capitalize">
                    <tr>
                        <th><?php echo e(translate('SL')); ?></th>
                        <th><?php echo e(translate('order_id')); ?></th>
                        <th><?php echo e(translate('customer_name')); ?></th>
                        <th><?php echo e(translate('total_product_amount')); ?></th>
                        <th><?php echo e(translate('product_discount')); ?></th>
                        <th><?php echo e(translate('coupon_discount')); ?></th>
                        <th><?php echo e(translate('discounted_amount')); ?></th>
                        <th><?php echo e(translate('VAT/TAX')); ?></th>
                        <th><?php echo e(translate('shipping_charge')); ?></th>
                        <th><?php echo e(translate('order_amount')); ?></th>
                        <th><?php echo e(translate('delivered_by')); ?></th>
                        <th><?php echo e(translate('deliveryman_incentive')); ?></th>
                        <th><?php echo e(translate('admin_discount')); ?></th>
                        <th><?php echo e(translate('vendor_discount')); ?></th>
                        <th><?php echo e(translate('admin_commission')); ?></th>
                        <th><?php echo e(translate('vendor_net_income')); ?></th>
                        <th><?php echo e(translate('payment_method')); ?></th>
                        <th><?php echo e(translate('payment_Status')); ?></th>
                        <th class="text-center"><?php echo e(translate('action')); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($transaction->order): ?>
                            <tr>
                                <td><?php echo e($transactions->firstItem()+$key); ?></td>
                                <td>
                                    <a class="title-color hover-c1"
                                       href="<?php echo e(route('vendor.orders.details',$transaction['order_id'])); ?>"><?php echo e($transaction['order_id']); ?></a>
                                </td>
                                <td>
                                    <?php if(!$transaction->order->is_guest && isset($transaction->customer)): ?>
                                        <?php echo e($transaction->customer->f_name); ?> <?php echo e($transaction->customer->l_name); ?>

                                    <?php elseif($transaction->order->is_guest): ?>
                                        <?php echo e(translate('guest_customer')); ?>

                                    <?php else: ?>
                                        <?php echo e(translate('not_found')); ?>

                                    <?php endif; ?>
                                </td>
                                <td><?php echo e(setCurrencySymbol(amount: usdToDefaultCurrency(amount: $transaction->orderDetails[0]->order_details_sum_price), currencyCode: getCurrencyCode())); ?></td>
                                <td><?php echo e(setCurrencySymbol(amount: usdToDefaultCurrency(amount: $transaction->orderDetails[0]->order_details_sum_discount), currencyCode: getCurrencyCode())); ?></td>
                                <td><?php echo e(setCurrencySymbol(amount: usdToDefaultCurrency(amount: $transaction->order->discount_amount), currencyCode: getCurrencyCode())); ?></td>
                                <td><?php echo e(setCurrencySymbol(amount: usdToDefaultCurrency(amount: $transaction->orderDetails[0]->order_details_sum_price - $transaction->orderDetails[0]->order_details_sum_discount - (isset($transaction->order->coupon) && $transaction->order->coupon->coupon_type != 'free_delivery'?$transaction->order->discount_amount:0)), currencyCode: getCurrencyCode())); ?></td>
                                <td><?php echo e(setCurrencySymbol(amount: usdToDefaultCurrency(amount: $transaction['tax']), currencyCode: getCurrencyCode())); ?></td>
                                <td><?php echo e(setCurrencySymbol(amount: usdToDefaultCurrency(amount: $transaction->order->shipping_cost), currencyCode: getCurrencyCode())); ?></td>
                                <td><?php echo e(setCurrencySymbol(amount: usdToDefaultCurrency(amount: $transaction->order->order_amount), currencyCode: getCurrencyCode())); ?></td>
                                <td><?php echo e($transaction['delivered_by']); ?></td>
                                <td><?php echo e(setCurrencySymbol(amount: usdToDefaultCurrency(amount: ($transaction->order->delivery_type == 'self_delivery' && $transaction->order->shipping_responsibility == 'sellerwise_shipping') ? $transaction->order->deliveryman_charge : 0), currencyCode: getCurrencyCode())); ?></td>
                                <td>
                                    <?php ($admin_coupon_discount = ($transaction->order->coupon_discount_bearer == 'inhouse' && $transaction->order->discount_type == 'coupon_discount') ? $transaction->order->discount_amount : 0); ?>
                                    <?php ($admin_shipping_discount = ($transaction->order->free_delivery_bearer=='admin' && $transaction->order->is_shipping_free) ? $transaction->order->extra_discount : 0); ?>
                                    <?php echo e(setCurrencySymbol(amount: usdToDefaultCurrency(amount: $admin_coupon_discount+$admin_shipping_discount), currencyCode: getCurrencyCode())); ?>

                                </td>
                                <td>
                                    <?php ($seller_coupon_discount = ($transaction->order->coupon_discount_bearer == 'seller' && $transaction->order->discount_type == 'coupon_discount') ? $transaction->order->discount_amount : 0); ?>
                                    <?php ($seller_shipping_discount = ($transaction->order->free_delivery_bearer=='seller' && $transaction->order->is_shipping_free) ? $transaction->order->extra_discount : 0); ?>
                                    <?php echo e(setCurrencySymbol(amount: usdToDefaultCurrency(amount: $seller_coupon_discount + $seller_shipping_discount), currencyCode: getCurrencyCode())); ?>

                                </td>
                                <td><?php echo e(setCurrencySymbol(amount: usdToDefaultCurrency(amount: $transaction['admin_commission']), currencyCode: getCurrencyCode())); ?></td>
                                <td>
                                        <?php
                                        $seller_net_income = 0;
                                        if (isset($transaction->order->delivery_man) && $transaction->order->delivery_man->seller_id != '0') {
                                            $seller_net_income += $transaction['delivery_charge'];
                                        }
                                        if ($transaction['seller_is'] == 'seller') {
                                            $seller_net_income += $transaction['order_amount'] + $transaction['tax'] - $transaction['admin_commission'];
                                        }

                                        if($transaction->order->delivery_type == 'self_delivery' && $transaction->order->shipping_responsibility == 'sellerwise_shipping' && $transaction->order->seller_is == 'seller'){
                                            $seller_net_income -= $transaction->order->deliveryman_charge;
                                        }
                                        if ($transaction['seller_is'] == 'seller') {
                                            if ($transaction->order->shipping_responsibility == 'inhouse_shipping') {
                                                $seller_net_income += $transaction->order->coupon_discount_bearer == 'inhouse' ? $admin_coupon_discount : 0;
                                                $seller_net_income -= ($transaction->order->coupon_discount_bearer == 'seller' && $transaction->order->coupon->coupon_type == 'free_delivery') ? $admin_coupon_discount : 0;
                                                $seller_net_income -= ($transaction->order->free_delivery_bearer == 'seller') ? $admin_shipping_discount : 0;

                                            } elseif ($transaction->order->shipping_responsibility == 'sellerwise_shipping') {
                                                $seller_net_income += $transaction->order->coupon_discount_bearer == 'inhouse' ? $admin_coupon_discount : 0;
                                                $seller_net_income += $transaction->order->free_delivery_bearer == 'admin' ? $admin_shipping_discount : 0;
                                                $seller_shipping_discount = 0;
                                            }
                                        }
                                        ?>
                                    <?php echo e(setCurrencySymbol(amount: usdToDefaultCurrency(amount: $seller_net_income-$seller_shipping_discount), currencyCode: getCurrencyCode())); ?>

                                </td>
                                <td><?php echo e(str_replace('_',' ',$transaction['payment_method'])); ?></td>
                                <td>
                                    <div class="text-center">
                                        <span class="badge <?php echo e($transaction['status'] == 'disburse' ? 'badge-soft-success' : 'badge-soft-warning'); ?>">
                                            <?php echo e(translate(str_replace('_',' ',$transaction['status']))); ?>

                                        </span>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <a href="<?php echo e(route('vendor.transaction.pdf-order-wise-transaction', ['order_id'=>$transaction->order_id])); ?>"
                                           class="btn btn-outline-success square-btn btn-sm">
                                            <i class="tio-download-to"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </tbody>
                </table>
            </div>

            <div class="table-responsive mt-4">
                <div class="px-4 d-flex justify-content-lg-end">
                    <?php echo e($transactions->links()); ?>

                </div>
            </div>
            <?php if(count($transactions)==0): ?>
                <?php echo $__env->make('layouts.vendor.partials._empty-state',['text'=>'no_data_found'],['image'=>'default'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
        </div>
    </div>

    <span id="currency_symbol" data-text="<?php echo e(getCurrencySymbol(currencyCode: getCurrencyCode())); ?>"></span>

    <span id="digital_payment" data-text="<?php echo e(usdToDefaultCurrency(amount: $payment_data['digital_payment'])); ?>"></span>
    <span id="cash_payment" data-text="<?php echo e(usdToDefaultCurrency(amount: $payment_data['cash_payment'])); ?>"></span>
    <span id="wallet_payment" data-text="<?php echo e(usdToDefaultCurrency(amount: $payment_data['wallet_payment'])); ?>"></span>
    <span id="offline_payment" data-text="<?php echo e(usdToDefaultCurrency(amount: $payment_data['offline_payment'])); ?>"></span>

    <span id="digital_payment_text" data-text="<?php echo e(translate('digital_payment')); ?>"></span>
    <span id="cash_payment_text" data-text="<?php echo e(translate('cash_payment')); ?>"></span>
    <span id="wallet_payment_text" data-text="<?php echo e(translate('wallet_payment')); ?>"></span>
    <span id="offline_payment_text" data-text="<?php echo e(translate('offline_payments')); ?>"></span>

    <span id="digital_payment_format" data-text="<?php echo e(getFormatCurrency(amount: usdToDefaultCurrency(amount: $payment_data['digital_payment']))); ?>"></span>
    <span id="cash_payment_format" data-text="<?php echo e(getFormatCurrency(amount: usdToDefaultCurrency(amount: $payment_data['cash_payment']))); ?>"></span>
    <span id="wallet_payment_format" data-text="<?php echo e(getFormatCurrency(amount: usdToDefaultCurrency(amount: $payment_data['wallet_payment']))); ?>"></span>
    <span id="offline_payment_format" data-text="<?php echo e(getFormatCurrency(amount: usdToDefaultCurrency(amount: $payment_data['offline_payment']))); ?>"></span>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/js/apexcharts.js')); ?>"></script>
    <script src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/js/apexcharts-data-show.js')); ?>"></script>
    <script src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/js/vendor/transaction-report.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.vendor.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\musas\Desktop\softwares\6valley\POSA-latest version\POSA\resources\views/vendor-views/transaction/order-list.blade.php ENDPATH**/ ?>