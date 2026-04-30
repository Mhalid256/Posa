<?php $__env->startSection('title', translate('order_List')); ?>

<?php $__env->startPush('css_or_js'); ?>
    <link href="<?php echo e(dynamicAsset(path: 'public/assets/back-end/vendor/datatables/dataTables.bootstrap4.min.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <div class="d-flex flex-wrap gap-2 align-items-center mb-3">
            <h2 class="h1 mb-0">
                <img src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/img/all-orders.png')); ?>" class="mb-1 mr-1" alt="">
                <span class="page-header-title">
                    <?php if($status =='processing'): ?>
                        <?php echo e(translate('packaging')); ?>

                    <?php elseif($status =='failed'): ?>
                        <?php echo e(translate('failed_to_Deliver')); ?>

                    <?php elseif($status == 'all'): ?>
                        <?php echo e(translate('all')); ?>

                    <?php else: ?>
                        <?php echo e(translate(str_replace('_',' ',$status))); ?>

                    <?php endif; ?>
                </span>
                <?php echo e(translate('orders')); ?>

            </h2>
            <span class="badge badge-soft-dark radius-50 fz-14"><?php echo e($orders->total()); ?></span>
        </div>

        <div class="card mb-3">
            <div class="card-body">
                <form action="<?php echo e(route('vendor.orders.list',['status'=>request('status')])); ?>" id="form-data"
                      method="GET">
                    <div class="row gx-2">
                        <div class="col-12">
                            <h4 class="mb-3 text-capitalize"><?php echo e(translate('filter_order')); ?></h4>
                        </div>
                        <?php if(request('delivery_man_id')): ?>
                            <input type="hidden" name="delivery_man_id" value="<?php echo e(request('delivery_man_id')); ?>">
                        <?php endif; ?>

                        <?php if(request('status')=='all' || request('status')=='delivered'): ?>
                            <div class="col-sm-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label class="title-color" for="filter"><?php echo e(translate('order_Type')); ?></label>
                                    <select name="filter" id="filter" class="form-control select2-selection__arrow">
                                        <option
                                            value="all" <?php echo e($filter == 'all' ? 'selected' : ''); ?>><?php echo e(translate('all')); ?></option>
                                        <option
                                            value="default_type" <?php echo e($filter == 'default_type' ? 'selected' : ''); ?>><?php echo e(translate('website_Order')); ?></option>
                                        <?php if(($status == 'all' || $status == 'delivered') && $sellerPos == 1 && !request()->has('deliveryManId')): ?>
                                            <option
                                                value="POS" <?php echo e($filter == 'POS' ? 'selected' : ''); ?>><?php echo e(translate('POS_Order')); ?></option>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="col-sm-6 col-lg-4 col-xl-3">
                            <div class="form-group">
                                <label class="title-color" for="customer"><?php echo e(translate('customer')); ?></label>

                                <input type="hidden" id='customer_id' name="customer_id"
                                       value="<?php echo e(request('customer_id') ? request('customer_id') : 'all'); ?>">
                                <select
                                        id="customer_id_value"
                                        data-placeholder="
                                        <?php if($customer == 'all'): ?>
                                            <?php echo e(translate('all_customer')); ?>

                                        <?php else: ?>
                                            <?php echo e($customer['name'] ?? $customer['f_name'].' '.$customer['l_name'].' '.'('.$customer['phone'].')'); ?>

                                        <?php endif; ?>"
                                        class="js-data-example-ajax form-control form-ellipsis"
                                >
                                    <option value="all"><?php echo e(translate('all_customer')); ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-4 col-xl-3">
                            <label class="title-color" for="date_type"><?php echo e(translate('date_type')); ?></label>
                            <div class="form-group">
                                <select class="form-control __form-control" name="date_type" id="date_type">
                                    <option
                                        value="this_year" <?php echo e($dateType == 'this_year'? 'selected' : ''); ?>><?php echo e(translate('this_Year')); ?></option>
                                    <option
                                        value="this_month" <?php echo e($dateType == 'this_month'? 'selected' : ''); ?>><?php echo e(translate('this_Month')); ?></option>
                                    <option
                                        value="this_week" <?php echo e($dateType == 'this_week'? 'selected' : ''); ?>><?php echo e(translate('this_Week')); ?></option>
                                    <option
                                        value="custom_date" <?php echo e($dateType == 'custom_date'? 'selected' : ''); ?>><?php echo e(translate('custom_Date')); ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-4 col-xl-3" id="from_div">
                            <label class="title-color" for="customer"><?php echo e(translate('start_date')); ?></label>
                            <div class="form-group">
                                <input type="date" name="from" value="<?php echo e($from); ?>" id="from_date" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-4 col-xl-3" id="to_div">
                            <label class="title-color" for="customer"><?php echo e(translate('end_date')); ?></label>
                            <div class="form-group">
                                <input type="date" value="<?php echo e($to); ?>" name="to" id="to_date" class="form-control">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex gap-3 justify-content-end">
                                <a href="<?php echo e(route('vendor.orders.list',['status'=>request('status')])); ?>"
                                   class="btn btn-secondary px-5">
                                    <?php echo e(translate('reset')); ?>

                                </a>
                                <button type="submit" class="btn btn--primary px-5" id="formUrlChange" data-action="<?php echo e(url()->current()); ?>">
                                    <?php echo e(translate('show_data')); ?>

                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="px-3 py-4 light-bg">
                    <div class="row g-2 align-items-center flex-grow-1">
                        <div class="col-md-4">
                            <h5 class="text-capitalize d-flex gap-1">
                                <?php echo e(translate('order_list')); ?>

                                <span class="badge badge-soft-dark radius-50 fs-12"><?php echo e($orders->total()); ?></span>
                            </h5>
                        </div>
                        <div class="col-md-8 d-flex gap-3 flex-wrap flex-sm-nowrap justify-content-md-end">
                            <form action="<?php echo e(url()->current()); ?>" method="GET">
                                <div class="input-group input-group-merge input-group-custom">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="tio-search"></i>
                                        </div>
                                    </div>
                                    <input id="datatableSearch_" type="search" name="searchValue" class="form-control"
                                           placeholder="<?php echo e(translate('search_orders')); ?>" aria-label="Search orders"
                                           value="<?php echo e($searchValue); ?>" required>
                                    <button type="submit" class="btn btn--primary"><?php echo e(translate('search')); ?></button>
                                </div>
                            </form>
                            <div class="dropdown">
                                <a type="button" class="btn btn-outline--primary text-nowrap" href="<?php echo e(route('vendor.orders.export-excel', ['delivery_man_id' => request('delivery_man_id'), 'status' => $status, 'from' => $from, 'to' => $to, 'filter' => $filter, 'searchValue' => $searchValue,'seller_id'=>$vendorId,'customer_id'=>$customerId, 'date_type'=>$dateType])); ?>">
                                    <img width="14" src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/img/excel.png')); ?>" class="excel" alt="">
                                    <span class="ps-2"><?php echo e(translate('export')); ?></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="datatable"
                           class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                        <thead class="thead-light thead-50 text-capitalize">
                        <tr>
                            <th class="text-capitalize"><?php echo e(translate('SL')); ?></th>
                            <th class="text-capitalize"><?php echo e(translate('order_ID')); ?></th>
                            <th class="text-capitalize"><?php echo e(translate('order_Date')); ?></th>
                            <th class="text-capitalize"><?php echo e(translate('customer_info')); ?></th>
                            <th class="text-capitalize"><?php echo e(translate('total_amount')); ?></th>
                            <?php if($status == 'all'): ?>
                                <th class="text-capitalize"><?php echo e(translate('order_Status')); ?> </th>
                            <?php else: ?>
                                <th class="text-capitalize"><?php echo e(translate('payment_method')); ?> </th>
                            <?php endif; ?>
                            <th class="text-center"><?php echo e(translate('action')); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                    <?php echo e($orders->firstItem()+$key); ?>

                                </td>
                                <td>
                                    <a class="title-color hover-c1"
                                       href="<?php echo e(route('vendor.orders.details',$order['id'])); ?>"><?php echo e($order['id']); ?> <?php echo $order->order_type == 'POS' ? '<span class="text--primary">(POS)</span>' : ''; ?></a>
                                </td>
                                <td>
                                    <div><?php echo e(date('d M Y',strtotime($order['created_at']))); ?></div>
                                    <div><?php echo e(date('H:i A',strtotime($order['created_at']))); ?></div>
                                </td>
                                <td>
                                    <?php if($order->is_guest): ?>
                                        <strong class="title-name"><?php echo e(translate('guest_customer')); ?></strong>
                                    <?php elseif($order->customer_id == 0): ?>
                                        <strong class="title-name"><?php echo e(translate('walking_customer')); ?></strong>
                                    <?php else: ?>
                                        <?php if($order->customer): ?>
                                            <span class="text-body text-capitalize" >
                                                <strong class="title-name"><?php echo e($order->customer['f_name'].' '.$order->customer['l_name']); ?></strong>
                                            </span>
                                            <?php if($order->customer['phone']): ?>
                                                <a class="d-block title-color" href="tel:<?php echo e($order->customer['phone']); ?>"><?php echo e($order->customer['phone']); ?></a>
                                            <?php else: ?>
                                                <a class="d-block title-color" href="mailto:<?php echo e($order->customer['email']); ?>"><?php echo e($order->customer['email']); ?></a>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <label class="badge badge-danger fs-12"><?php echo e(translate('invalid_customer_data')); ?></label>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div>
                                        <?php ($orderTotalPriceSummary = \App\Utils\OrderManager::getOrderTotalPriceSummary(order: $order)); ?>
                                        <?php echo e(setCurrencySymbol(amount: usdToDefaultCurrency(amount:  $orderTotalPriceSummary['totalAmount']), currencyCode: getCurrencyCode())); ?>

                                    </div>

                                    <?php if($order->payment_status=='paid'): ?>
                                        <span class="badge badge-soft-success"><?php echo e(translate('paid')); ?></span>
                                    <?php else: ?>
                                        <span class="badge badge-soft-danger"><?php echo e(translate('unpaid')); ?></span>
                                    <?php endif; ?>
                                </td>
                                <?php if($status == 'all'): ?>
                                    <td class="text-capitalize">
                                        <?php if($order->order_status=='pending'): ?>
                                            <label
                                                class="badge badge-soft-primary"><?php echo e($order['order_status']); ?></label>
                                        <?php elseif($order->order_status=='processing' || $order->order_status=='out_for_delivery'): ?>
                                            <label
                                                class="badge badge-soft-warning"><?php echo e(str_replace('_',' ',$order['order_status'] == 'processing' ? 'packaging' : $order['order_status'])); ?></label>
                                        <?php elseif($order->order_status=='delivered' || $order->order_status=='confirmed'): ?>
                                            <label
                                                class="badge badge-soft-success"><?php echo e($order['order_status']); ?></label>
                                        <?php elseif($order->order_status=='returned'): ?>
                                            <label
                                                class="badge badge-soft-danger"><?php echo e($order['order_status']); ?></label>
                                        <?php elseif($order['order_status']=='failed'): ?>
                                            <span class="badge badge-danger fs-12">
                                                    <?php echo e(translate('failed_to_deliver')); ?>

                                            </span>
                                        <?php else: ?>
                                            <label
                                                class="badge badge-soft-danger"><?php echo e($order['order_status']); ?></label>
                                        <?php endif; ?>
                                    </td>
                                <?php else: ?>
                                    <td class="text-capitalize">
                                        <?php echo e(str_replace('_',' ',$order['payment_method'])); ?>

                                    </td>
                                <?php endif; ?>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <a class="btn btn-outline--primary btn-sm square-btn"
                                           title="<?php echo e(translate('view')); ?>"
                                           href="<?php echo e(route('vendor.orders.details',[$order['id']])); ?>">
                                            <i class="tio-invisible"></i>

                                        </a>
                                        <a class="btn btn-outline-info btn-sm square-btn" target="_blank"
                                           title="<?php echo e(translate('invoice')); ?>"
                                           href="<?php echo e(route('vendor.orders.generate-invoice',[$order['id']])); ?>">
                                            <i class="tio-download"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>

                <div class="table-responsive mt-4">
                    <div class="d-flex justify-content-lg-end">
                        <?php echo e($orders->links()); ?>

                    </div>
                </div>

                <?php if(count($orders)==0): ?>
                    <?php echo $__env->make('layouts.vendor.partials._empty-state',['text'=>'no_order_found'],['image'=>'default'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <span id="message-date-range-text" data-text="<?php echo e(translate("invalid_date_range")); ?>"></span>
    <span id="js-data-example-ajax-url" data-url="<?php echo e(route('vendor.orders.customers')); ?>"></span>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/vendor/datatables/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/vendor/datatables/dataTables.bootstrap4.min.js')); ?>"></script>
    <script src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/js/vendor/order.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.vendor.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\musas\Desktop\softwares\6valley\POSA-latest version\POSA\resources\views/vendor-views/order/list.blade.php ENDPATH**/ ?>