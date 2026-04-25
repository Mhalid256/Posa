
<div class="card remove-card-shadow h-100">
    <div class="card-body p-3 p-sm-4">
        <div class="row g-2 align-items-center">
            <div class="col-md-6">
                <h4 class="d-flex align-items-center text-capitalize gap-10 mb-0">
                    <img src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/img/order-statistics.png')); ?>"
                         alt="">
                    <?php echo e(translate('order_statistics')); ?>

                </h4>
            </div>
            <div class="col-md-6 d-flex justify-content-center justify-content-md-end order-stat mb-3">
                <ul class="option-select-btn order-statistics-option">
                    <li>
                        <label class="shadow">
                            <input type="radio" name="statistics4" hidden="" value="yearEarn" <?php echo e($dateType == 'yearEarn' ? 'checked' : ''); ?>>
                            <span data-date-type="yearEarn" class="order-statistics"><?php echo e(translate('this_Year')); ?></span>
                        </label>
                    </li>
                    <li>
                        <label class="shadow">
                            <input type="radio" name="statistics4"  value="MonthEarn" hidden="" <?php echo e($dateType == 'MonthEarn' ? 'checked' : ''); ?>>
                            <span data-date-type="MonthEarn" class="order-statistics"><?php echo e(translate('this_Month')); ?></span>
                        </label>
                    </li>
                    <li>
                        <label class="shadow">
                            <input type="radio" name="statistics4" value="WeekEarn" hidden="" <?php echo e($dateType == 'WeekEarn' ? 'checked' : ''); ?>>
                            <span data-date-type="WeekEarn" class="order-statistics"><?php echo e(translate('this_Week')); ?></span>
                        </label>
                    </li>
                </ul>
            </div>
        </div>
        <div id="apex-line-chart"></div>
    </div>
</div>
<span id="order-statistics" data-action="<?php echo e(route('admin.dashboard.order-statistics')); ?>"></span>
<span id="order-statistics-data" data-inhouse-text = "<?php echo e(translate('inhouse')); ?>" data-vendor-text = "<?php echo e(translate('vendor')); ?>" data-inhouse-order-earn="<?php echo e(json_encode($inHouseOrderEarningArray)); ?>" data-vendor-order-earn="<?php echo e(json_encode($vendorOrderEarningArray)); ?>" data-label="<?php echo e(json_encode($label)); ?>"></span>
<input name="order_statistics_label_count" value="<?php echo e(count($label)); ?>" hidden>
<?php /**PATH C:\Users\musas\Desktop\softwares\6valley\POSA-latest\POSA\resources\views/admin-views/system/partials/order-statistics.blade.php ENDPATH**/ ?>