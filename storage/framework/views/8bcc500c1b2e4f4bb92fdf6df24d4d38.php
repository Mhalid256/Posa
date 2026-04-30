<?php
    use Carbon\Carbon;
?>
<div class="card remove-card-shadow h-100">
    <div class="card-body p-3 p-sm-4">
        <div class="row g-2 d-flex align-items-center justify-content-between">
            <h3 class="text-capitalize">
                <?php echo e(translate($title)); ?>

            </h3>
            <?php if(isset($average)): ?>
                <h5>
                    <span><?php echo e(translate('average_Earning_Value')); ?> :</span>
                    <span><?php echo e(setCurrencySymbol(amount: usdToDefaultCurrency(amount: array_sum($chartEarningStatistics)/count($chartEarningStatistics)), currencyCode: getCurrencyCode())); ?></span>
                </h5>
            <?php endif; ?>
        </div>
        <div id="apex-line-chart"></div>
    </div>
</div>
<span id="statistics-data" data-statistics-title="<?php echo e(translate($statisticsTitle)); ?>"
      data-statistics-value="<?php echo e(json_encode($statisticsValue)); ?>" data-label="<?php echo e(json_encode($label)); ?>"></span>
<input name="dateType" value="<?php echo e(request('date_type')); ?>" data-count="<?php echo e(count($label)); ?>"
       data-start="<?php echo e(Carbon::parse(request('from'))->format('d')); ?>"
       data-end="<?php echo e(Carbon::parse(request('to'))->format('d')); ?>"
       data-from="<?php echo e(Carbon::parse(request('from'))->format('m')); ?>"
       data-to="<?php echo e(Carbon::parse(request('to'))->format('m')); ?>" hidden>
<input name="currency_symbol_show_status" id="get-currency-status" value="<?php echo e(!(isset($getCurrency)&& !$getCurrency)); ?>" hidden>
<?php /**PATH C:\Users\musas\Desktop\softwares\6valley\POSA-latest version\POSA\resources\views/layouts/vendor/partials/_apexcharts.blade.php ENDPATH**/ ?>