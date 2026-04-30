<link rel="stylesheet" href="<?php echo e(dynamicAsset(path: 'public/assets/back-end/css/pos-invoice.css')); ?>">
<?php
$orderTotalPriceSummary = \App\Utils\OrderManager::getOrderTotalPriceSummary(order: $order);
?>
<div class="width-363px">
    <div class="text-center pt-4 mb-3">
        <h2 class="line-height-1"><?php echo e(getWebConfig('company_name')); ?></h2>
        <h5 class="line-height-1 font-size-16px">
            <?php echo e(translate('phone')); ?> : <?php echo e(getWebConfig('company_phone')); ?>

        </h5>
    </div>

    <span class="dashed-hr"></span>
    <div class="row mt-3">
        <div class="col-6">
            <h5><?php echo e(translate('order_ID')); ?> : <?php echo e($order['id']); ?></h5>
        </div>
        <div class="col-6">
            <h5 class="">
                <?php echo e(date('d/M/Y h:i a', strtotime($order['created_at']))); ?>

            </h5>
        </div>
        <?php if($order->customer): ?>
            <div class="col-12">
                <h5 class="text-capitalize"><?php echo e(translate('customer_name')); ?> : <?php echo e($order->customer['f_name'].' '.$order->customer['l_name']); ?></h5>
                <?php if($order->customer->id !=0): ?>
                    <h5><?php echo e(translate('phone')); ?> : <?php echo e($order->customer['phone']); ?></h5>
                <?php endif; ?>

            </div>
        <?php endif; ?>
    </div>
    <h5 class="text-uppercase"></h5>
    <span class="dashed-hr"></span>
    <table class="table table-bordered mt-3 text-left width-99">
        <thead>
        <tr>
            <th class="text-center text-uppercase"><?php echo e(translate('qty')); ?></th>
            <th class="text-left text-uppercase"><?php echo e(translate('desc')); ?></th>
            <th class="text-center"><?php echo e(translate('price')); ?></th>
        </tr>
        </thead>

        <tbody>
        <?php ($sub_total=0); ?>
        <?php ($total_tax=0); ?>
        <?php ($total_dis_on_pro=0); ?>
        <?php ($product_price=0); ?>
        <?php ($total_product_price=0); ?>
        <?php ($ext_discount=0); ?>
        <?php ($coupon_discount=0); ?>
        <?php $__currentLoopData = $order->details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($detail->product): ?>
                <tr>
                    <td class="text-left">
                        <?php echo e($detail['qty']); ?>

                    </td>
                    <td class="text-left">
                        <span> <?php echo e(Str::limit($detail->product['name'], 200)); ?></span><br>
                        <?php if($detail->product->product_type == 'physical' && count(json_decode($detail['variation'],true))>0): ?>
                            <strong><u><?php echo e(translate('variation')); ?> : </u></strong>
                            <?php $__currentLoopData = json_decode($detail['variation'],true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key1 =>$variation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="font-size-sm text-body color-black">
                                    <span><?php echo e(translate($key1)); ?> :  </span>
                                    <span
                                        class="font-weight-bold"><?php echo e($variation); ?> </span>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>

                        <?php echo e(translate('discount')); ?>

                        : <?php echo e(setCurrencySymbol(amount: usdToDefaultCurrency(amount: $detail['discount']), currencyCode: getCurrencyCode())); ?>

                    </td>
                    <td class="text-right">
                        <?php ($amount=($detail['price']*$detail['qty'])-$detail['discount']); ?>
                        <?php ($product_price = $detail['price']*$detail['qty']); ?>
                        <?php echo e(setCurrencySymbol(amount: usdToDefaultCurrency(amount: $amount), currencyCode: getCurrencyCode())); ?>

                    </td>
                </tr>
                <?php ($sub_total+=$amount); ?>
                <?php ($total_product_price+=$product_price); ?>
                <?php ($total_tax+=$detail['tax']); ?>

            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    <span class="dashed-hr"></span>

    <table class="w-100 color-black">
        <tr>
            <td colspan="2"></td>
            <td class="text-right"><?php echo e(translate('items_Price')); ?>:</td>
            <td class="text-right"><?php echo e(setCurrencySymbol(amount: usdToDefaultCurrency(amount: $orderTotalPriceSummary['itemPrice']), currencyCode: getCurrencyCode())); ?></td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td class="text-right"><?php echo e(translate('item_discount')); ?>:</td>
            <td class="text-right"><?php echo e(setCurrencySymbol(amount: usdToDefaultCurrency(amount: $orderTotalPriceSummary['itemDiscount']), currencyCode: getCurrencyCode())); ?></td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td class="text-right"><?php echo e(translate('extra_discount')); ?>:</td>
            <td class="text-right"><?php echo e(setCurrencySymbol(amount: usdToDefaultCurrency(amount: $orderTotalPriceSummary['extraDiscount']), currencyCode: getCurrencyCode())); ?></td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td class="text-right"><?php echo e(translate('subtotal')); ?>:</td>
            <td class="text-right"><?php echo e(setCurrencySymbol(amount: usdToDefaultCurrency(amount: $orderTotalPriceSummary['subTotal']), currencyCode: getCurrencyCode())); ?></td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td class="text-right"><?php echo e(translate('tax')); ?> / <?php echo e(translate('VAT')); ?>:</td>
            <td class="text-right"><?php echo e(setCurrencySymbol(amount: usdToDefaultCurrency(amount: $orderTotalPriceSummary['taxTotal']), currencyCode: getCurrencyCode())); ?></td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td class="text-right"><?php echo e(translate('coupon_discount')); ?>:</td>
            <td class="text-right"><?php echo e(setCurrencySymbol(amount: usdToDefaultCurrency(amount: $orderTotalPriceSummary['couponDiscount']), currencyCode: getCurrencyCode())); ?></td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td class="text-right font-size-20px">
                <?php echo e(translate('total')); ?>:
            </td>
            <td class="text-right font-size-20px">
                <?php echo e(setCurrencySymbol(amount: usdToDefaultCurrency(amount: $orderTotalPriceSummary['totalAmount']), currencyCode: getCurrencyCode())); ?>

            </td>
        </tr>
        <?php if($order->order_type == 'pos' || $order->order_type == 'POS'): ?>
            <tr>
                <td colspan="4">
                    <span class="dashed-hr"></span>
                </td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td class="text-right">
                    <?php echo e(translate('Paid_Amount')); ?>:
                </td>
                <td class="text-right">
                    <?php echo e(setCurrencySymbol(amount: usdToDefaultCurrency(amount: $orderTotalPriceSummary['paidAmount']), currencyCode: getCurrencyCode())); ?>

                </td>
            </tr>

            <tr>
                <td colspan="2"></td>
                <td class="text-right">
                    <?php echo e(translate('Change_Amount')); ?>:
                </td>
                <td class="text-right">
                    <?php echo e(setCurrencySymbol(amount: usdToDefaultCurrency(amount: $orderTotalPriceSummary['changeAmount']), currencyCode: getCurrencyCode())); ?>

                </td>
            </tr>
        <?php endif; ?>
    </table>


    <div class="d-flex flex-row justify-content-between border-top">
        <span><?php echo e(translate('paid_by')); ?>: <?php echo e(translate($order->payment_method)); ?></span>
    </div>
    <span class="dashed-hr"></span>
    <h5 class="text-center pt-3 text-uppercase">
        """<?php echo e(translate('thank_you')); ?>"""
    </h5>
    <span class="dashed-hr"></span>
</div>
<?php /**PATH C:\Users\musas\Desktop\softwares\6valley\POSA-latest version\POSA\resources\views/vendor-views/pos/order/invoice.blade.php ENDPATH**/ ?>