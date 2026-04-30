<?php $__env->startSection('title', translate('order_Details')); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">

        <div class="d-flex flex-wrap gap-2 align-items-center mb-3">
            <h2 class="h1 mb-0">
                <img src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/img/all-orders.png')); ?>" alt="">
                <?php echo e(translate('order_Details')); ?>

            </h2>
        </div>

        <div class="row gx-2 gy-3" id="printableArea">
            <div class="col-lg-8 col-xl-9">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex flex-wrap gap-10 flex-md-nowrap justify-content-between mb-4">
                            <div class="d-flex flex-column gap-10">
                                <h4 class="text-capitalize">
                                    <?php echo e(translate('order_ID')); ?> #<?php echo e($order['id']); ?>

                                    <?php if($order['order_type'] == 'POS'): ?>
                                        <span>(<?php echo e('POS'); ?>)</span>
                                    <?php endif; ?>
                                </h4>
                                <div class="">
                                    <i class="tio-date-range"></i> <?php echo e(date('d M Y H:i:s',strtotime($order['created_at']))); ?>

                                </div>
                            </div>
                            <div class="text-sm-right flex-grow-1">
                                <div class="d-flex flex-wrap gap-10 justify-content-sm-end">
                                    <a class="btn btn--primary px-4" target="_blank"
                                       href="<?php echo e(route('vendor.orders.generate-invoice',[$order['id']])); ?>">
                                        <img src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/img/icons/uil_invoice.svg')); ?>"
                                             alt="" class="mr-1">
                                        <?php echo e(translate('print_Invoice')); ?>

                                    </a>
                                </div>
                                <div class="d-flex flex-column gap-2 mt-3">
                                    <div class="order-status d-flex justify-content-sm-end gap-10 text-capitalize">
                                        <span class="title-color"><?php echo e(translate('status')); ?>: </span>
                                        <?php if($order['order_status']=='pending'): ?>
                                            <span
                                                class="badge badge-soft-info font-weight-bold radius-50 d-flex align-items-center py-1 px-2">
                                                <?php echo e(translate(str_replace('_',' ',$order['order_status']))); ?>

                                            </span>
                                        <?php elseif($order['order_status']=='failed'): ?>
                                            <span
                                                class="badge badge-soft-danger font-weight-bold radius-50 d-flex align-items-center py-1 px-2">
                                                <?php echo e(translate(str_replace('_',' ',$order['order_status']))); ?>

                                            </span>
                                        <?php elseif($order['order_status']=='processing' || $order['order_status']=='out_for_delivery'): ?>
                                            <span
                                                class="badge badge-soft-warning font-weight-bold radius-50 d-flex align-items-center py-1 px-2">
                                                <?php echo e(translate(str_replace('_',' ',$order['order_status']))); ?>

                                            </span>
                                        <?php elseif($order['order_status']=='delivered' || $order['order_status']=='confirmed'): ?>
                                            <span
                                                class="badge badge-soft-success font-weight-bold radius-50 d-flex align-items-center py-1 px-2">
                                                <?php echo e(translate(str_replace('_',' ',$order['order_status']))); ?>

                                            </span>
                                        <?php else: ?>
                                            <span
                                                class="badge badge-soft-danger font-weight-bold radius-50 d-flex align-items-center py-1 px-2">
                                                <?php echo e(translate(str_replace('_',' ',$order['order_status']))); ?>

                                            </span>
                                        <?php endif; ?>
                                    </div>

                                    <div class="payment-method d-flex justify-content-sm-end gap-10 text-capitalize">
                                        <span class="title-color"><?php echo e(translate('payment_Method')); ?> :</span>
                                        <strong>  <?php echo e(translate(str_replace('_',' ',$order['payment_method']))); ?></strong>
                                    </div>
                                    <?php if(isset($order['transaction_ref']) && $order->payment_method != 'cash_on_delivery' && $order->payment_method != 'pay_by_wallet' && !isset($order->offline_payments)): ?>
                                        <div
                                            class="reference-code d-flex justify-content-sm-end gap-10 text-capitalize">
                                            <span class="title-color"><?php echo e(translate('reference_Code')); ?> :</span>
                                            <strong><?php echo e(translate(str_replace('_',' ',$order['transaction_ref']))); ?> <?php echo e($order->payment_method == 'offline_payment' ? '('.$order->payment_by.')':''); ?></strong>
                                        </div>
                                    <?php endif; ?>
                                    <div class="payment-status d-flex justify-content-sm-end gap-10">
                                        <span class="title-color"><?php echo e(translate('payment_Status')); ?>:</span>
                                        <?php if($order['payment_status']=='paid'): ?>
                                            <span class="text-success font-weight-bold">
                                                <?php echo e(translate('paid')); ?>

                                            </span>
                                        <?php else: ?>
                                            <span class="text-danger font-weight-bold">
                                                <?php echo e(translate('unpaid')); ?>

                                            </span>
                                        <?php endif; ?>
                                    </div>
                                    <?php if(getWebConfig('order_verification') && $order->order_type == "default_type"): ?>
                                        <span class="ml-2 ml-sm-3">
                                            <b>
                                                <?php echo e(translate('order_verification_code')); ?> : <?php echo e($order['verification_code']); ?>

                                            </b>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive datatable-custom">
                            <table
                                class="table fs-12 table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table w-100">
                                <thead class="thead-light thead-50 text-capitalize">
                                <tr>
                                    <th><?php echo e(translate('SL')); ?></th>
                                    <th><?php echo e(translate('item_details')); ?></th>
                                    <th><?php echo e(translate('item_price')); ?></th>
                                    <th><?php echo e(translate('tax')); ?></th>
                                    <th><?php echo e(translate('item_discount')); ?></th>
                                    <th><?php echo e(translate('total_price')); ?></th>
                                </tr>
                                </thead>

                                <tbody>
                                <?php ($itemPrice=0); ?>
                                <?php ($subtotal=0); ?>
                                <?php ($total=0); ?>
                                <?php ($shipping=0); ?>
                                <?php ($discount=0); ?>
                                <?php ($tax=0); ?>
                                <?php ($extraDiscount=0); ?>
                                <?php ($productPrice=0); ?>
                                <?php ($totalProductPrice=0); ?>
                                <?php ($couponDiscount=0); ?>
                                <?php $__currentLoopData = $order->details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        if($detail->product) {
                                            $productDetails = $detail?->productAllStatus;
                                        }else {
                                            $productDetails = json_decode($detail->product_details, true);
                                        }
                                    ?>
                                    <?php if($productDetails): ?>
                                        <tr>
                                            <td><?php echo e(++$key); ?></td>
                                            <td>
                                                <div class="media align-items-center gap-10">
                                                    <img class="avatar avatar-60 rounded img-fit"
                                                         src="<?php echo e(getStorageImages(path:$detail?->productAllStatus?->thumbnail_full_url, type:'backend-product')); ?>"
                                                         alt="<?php echo e(translate('image_description')); ?>">
                                                    <div>
                                                        <h6 class="title-color"><?php echo e(substr($productDetails['name'], 0, 30)); ?><?php echo e(strlen($productDetails['name'])>10?'...':''); ?></h6>
                                                        <div>
                                                            <strong><?php echo e(translate('qty')); ?> :</strong> <?php echo e($detail['qty']); ?>

                                                        </div>
                                                        <div>
                                                            <strong><?php echo e(translate('unit_price')); ?> :</strong>
                                                            <?php echo e(setCurrencySymbol(amount: usdToDefaultCurrency(amount: $detail['price'] + ($detail->tax_model =='include' ? ($detail['tax'] / $detail['qty']) :0)))); ?>

                                                            <?php if($detail->tax_model =='include'): ?>
                                                                (<?php echo e(translate('tax_incl.')); ?>)
                                                            <?php else: ?>
                                                                (<?php echo e(translate('tax').":".($productDetails->tax)); ?><?php echo e($productDetails->tax_type ==="percent" ? '%' :''); ?>)
                                                            <?php endif; ?>
                                                        </div>
                                                        <?php if($detail->variant): ?>
                                                            <div>
                                                                <strong><?php echo e(translate('variation')); ?> :</strong> <?php echo e($detail['variant']); ?>

                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <?php if(isset($productDetails['digital_product_type']) && $productDetails['digital_product_type'] == 'ready_after_sell'): ?>
                                                    <button type="button" class="btn btn-sm btn--primary mt-2"
                                                            title="File Upload" data-toggle="modal"
                                                            data-target="#fileUploadModal-<?php echo e($detail->id); ?>">
                                                        <i class="tio-file-outlined"></i> <?php echo e(translate('file')); ?>

                                                    </button>
                                                <?php endif; ?>

                                            </td>
                                            <td><?php echo e(setCurrencySymbol(amount: usdToDefaultCurrency(amount:  $detail['price']*$detail['qty']), currencyCode: getCurrencyCode())); ?></td>
                                            <td>
                                                <?php echo e(setCurrencySymbol(amount: usdToDefaultCurrency(amount:  $detail['tax']), currencyCode: getCurrencyCode())); ?>

                                            </td>
                                            <td><?php echo e(setCurrencySymbol(amount: usdToDefaultCurrency(amount:  $detail['discount']), currencyCode: getCurrencyCode())); ?></td>
                                            <?php ($itemPrice+=$detail['price']*$detail['qty']); ?>
                                            <?php ($subtotal=$detail['price']*$detail['qty']+$detail['tax']-$detail['discount']); ?>
                                            <?php ($productPrice = $detail['price']*$detail['qty']); ?>
                                            <?php ($totalProductPrice+=$productPrice); ?>
                                            <td><?php echo e(setCurrencySymbol(amount: usdToDefaultCurrency(amount:  $subtotal), currencyCode: getCurrencyCode())); ?></td>
                                            <?php if($productDetails['product_type'] == 'digital'): ?>
                                                <div class="modal fade" id="fileUploadModal-<?php echo e($detail->id); ?>"
                                                     tabindex="-1" aria-labelledby="exampleModalLabel"
                                                     aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <form
                                                                action="<?php echo e(route('vendor.orders.digital-file-upload-after-sell')); ?>"
                                                                method="post" enctype="multipart/form-data">
                                                                <?php echo csrf_field(); ?>
                                                                <div class="modal-body">
                                                                    <?php if(($detail?->digital_file_after_sell_full_url) && isset($detail->digital_file_after_sell_full_url['key'])): ?>
                                                                        <div class="mb-4">
                                                                            <?php echo e(translate('uploaded_file')); ?> :
                                                                            <span data-file-path="<?php echo e($detail->digital_file_after_sell_full_url['path']); ?>"
                                                                                  class="btn btn-success btn-sm getDownloadFileUsingFileUrl"
                                                                                  title="<?php echo e(translate('download')); ?>"><i
                                                                                    class="tio-download"></i>
                                                                                <?php echo e(translate('download')); ?>

                                                                            </span>
                                                                        </div>
                                                                    <?php elseif($productDetails['digital_product_type'] == 'ready_after_sell' && $detail->digital_file_after_sell): ?>
                                                                        <div class="mb-4">
                                                                            <?php echo e(translate('uploaded_file')); ?> :
                                                                            <a href="<?php echo e(dynamicStorage(path: 'storage/app/public/product/digital-product/'.$detail->digital_file_after_sell)); ?>"
                                                                               class="btn btn-success btn-sm"
                                                                               title="<?php echo e(translate('download')); ?>"><i
                                                                                    class="tio-download"></i>
                                                                                <?php echo e(translate('download')); ?></a>
                                                                        </div>
                                                                    <?php elseif($productDetails['digital_product_type'] == 'ready_product' && $productDetails['digital_file_ready']): ?>
                                                                        <div class="mb-4">
                                                                            <?php echo e(translate('uploaded_file')); ?> :
                                                                            <a href="<?php echo e(dynamicStorage(path: 'storage/app/public/product/digital-product/'.$productDetails['digital_file_ready'])); ?>"
                                                                               class="btn btn-success btn-sm"
                                                                               title="<?php echo e(translate('download')); ?>"><i
                                                                                    class="tio-download"></i>
                                                                                <?php echo e(translate('download')); ?></a>
                                                                        </div>
                                                                    <?php endif; ?>

                                                                    <?php if($productDetails['digital_product_type'] == 'ready_after_sell'): ?>
                                                                            <div class="inputDnD form-group input_image"
                                                                                 data-title="<?php echo e(translate('drag_and_drop_file_or_Browse_file')); ?>">
                                                                                <input type="file" name="digital_file_after_sell"
                                                                                       class="form-control-file text--primary font-weight-bold readUrl"
                                                                                       accept=".jpg, .jpeg, .png, .gif, .zip, .pdf"
                                                                                       data-title="<?php echo e(translate('drag_&_drop_file_or_browse_file')); ?>">
                                                                                <input type="text" class="form-control mt-2 selected-file-name" placeholder="<?php echo e(translate('no_file_selected')); ?>" readonly>
                                                                            </div>
                                                                        <div
                                                                            class="mt-1 text-info"><?php echo e(translate('file_type').' '.':'.' '.' jpg, jpeg, png, gif, zip, pdf'); ?>

                                                                        </div>
                                                                        <input type="hidden" value="<?php echo e($detail->id); ?>"
                                                                               name="order_id">
                                                                    <?php endif; ?>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal"><?php echo e(translate('close')); ?></button>
                                                                    <?php if($productDetails['digital_product_type'] == 'ready_after_sell'): ?>
                                                                        <button type="submit"
                                                                                class="btn btn--primary"><?php echo e(translate('upload')); ?></button>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </tr>
                                        <?php ($discount+=$detail['discount']); ?>
                                        <?php ($tax+=$detail['tax']); ?>
                                        <?php ($total+=$subtotal); ?>
                                    <?php endif; ?>
                                    <?php ($sellerId=$detail->seller_id); ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                        <hr>
                        <?php ($orderTotalPriceSummary = \App\Utils\OrderManager::getOrderTotalPriceSummary(order: $order)); ?>
                        <div class="row justify-content-md-end mb-3">
                            <div class="col-md-9 col-lg-8">
                                <dl class="row text-sm-right">
                                    <dt class="col-5"><?php echo e(translate('item_price')); ?></dt>
                                    <dd class="col-6 title-color">
                                        <strong><?php echo e(setCurrencySymbol(amount: usdToDefaultCurrency(amount:  $orderTotalPriceSummary['itemPrice']), currencyCode: getCurrencyCode())); ?></strong>
                                    </dd>
                                    <dt class="col-5 text-capitalize"><?php echo e(translate('item_discount')); ?></dt>
                                    <dd class="col-6 title-color">
                                        -
                                        <strong><?php echo e(setCurrencySymbol(amount: usdToDefaultCurrency(amount:  $orderTotalPriceSummary['itemDiscount']), currencyCode: getCurrencyCode())); ?></strong>
                                    </dd>
                                    <dt class="col-sm-5"><?php echo e(translate('extra_discount')); ?></dt>
                                    <dd class="col-sm-6 title-color">
                                        <strong>- <?php echo e(setCurrencySymbol(amount: usdToDefaultCurrency(amount:  $orderTotalPriceSummary['extraDiscount']), currencyCode: getCurrencyCode())); ?></strong>
                                    </dd>
                                    <dt class="col-5 text-capitalize"><?php echo e(translate('sub_total')); ?></dt>
                                    <dd class="col-6 title-color">
                                        <strong><?php echo e(setCurrencySymbol(amount: usdToDefaultCurrency(amount:  $orderTotalPriceSummary['subTotal']), currencyCode: getCurrencyCode())); ?></strong>
                                    </dd>
                                    <dt class="col-sm-5"><?php echo e(translate('coupon_discount')); ?></dt>
                                    <dd class="col-sm-6 title-color">
                                        <strong>- <?php echo e(setCurrencySymbol(amount: usdToDefaultCurrency(amount:  $orderTotalPriceSummary['couponDiscount']), currencyCode: getCurrencyCode())); ?></strong>
                                    </dd>
                                    <dt class="col-5 text-uppercase"><?php echo e(translate('vat')); ?>/<?php echo e(translate('tax')); ?></dt>
                                    <dd class="col-6 title-color">
                                        <strong><?php echo e(setCurrencySymbol(amount: usdToDefaultCurrency(amount:  $orderTotalPriceSummary['taxTotal']), currencyCode: getCurrencyCode())); ?></strong>
                                    </dd>
                                    <dt class="col-sm-5"><?php echo e(translate('total')); ?></dt>
                                    <dd class="col-sm-6 title-color">
                                        <strong><?php echo e(setCurrencySymbol(amount: usdToDefaultCurrency(amount:  $orderTotalPriceSummary['totalAmount']), currencyCode: getCurrencyCode())); ?></strong>
                                    </dd>
                                    <?php if($order->order_type == 'pos' || $order->order_type == 'POS'): ?>
                                        <dt class="col-5"><strong><?php echo e(translate('paid_amount')); ?></strong></dt>
                                        <dd class="col-6 title-color">
                                            <strong> <?php echo e(setCurrencySymbol(amount: usdToDefaultCurrency(amount: $orderTotalPriceSummary['paidAmount']), currencyCode: getCurrencyCode())); ?></strong>
                                        </dd>
                                        <dt class="col-5"><strong><?php echo e(translate('change_amount')); ?></strong></dt>
                                        <dd class="col-6 title-color">
                                            <strong><?php echo e(setCurrencySymbol(amount: usdToDefaultCurrency(amount: $orderTotalPriceSummary['changeAmount']), currencyCode: getCurrencyCode())); ?></strong>
                                        </dd>
                                    <?php endif; ?>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-xl-3">
                <div class="card">

                    <?php if($order->customer): ?>
                        <div class="card-body">
                            <h4 class="mb-4 d-flex align-items-center gap-2">
                                <img src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/img/vendor-information.png')); ?>" alt="">
                                <?php echo e(translate('customer_information')); ?>

                            </h4>

                            <div class="media flex-wrap gap-3 align-items-center">
                                <div class="">
                                    <img class="avatar rounded-circle avatar-70"
                                         src="<?php echo e(getStorageImages(path: $order?->customer->image_full_url,type: 'backend-profile')); ?>"
                                         alt="<?php echo e(translate('image')); ?>">
                                </div>
                                <div class="media-body d-flex flex-column gap-1">
                                    <span class="title-color hover-c1 text-capitalize"><strong><?php echo e($order->customer['f_name'].' '.$order->customer['l_name']); ?></strong></span>
                                    <?php if($order->customer->id != 0): ?>
                                        <span
                                            class="title-color break-all"><strong><?php echo e($order->customer['phone']); ?></strong></span>
                                        <span class="title-color break-all"><?php echo e($order->customer['email']); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="card-body">
                            <div class="media align-items-center">
                                <span><?php echo e(translate('no_customer_found')); ?></span>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/js/vendor/order.js')); ?>"></script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.vendor.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\musas\Desktop\softwares\6valley\POSA-latest version\POSA\resources\views/vendor-views/pos/order/order-details.blade.php ENDPATH**/ ?>