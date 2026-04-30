<?php if(isset($product)): ?>
<?php ($overallRating = getOverallRating($product->reviews)); ?>
<div class="flash_deal_product rtl cursor-pointer mb-2 get-view-by-onclick"
    data-link="<?php echo e(route('product',$product->slug)); ?>">
    <?php if($product->discount > 0): ?>
    <div class="d-flex position-absolute z-2">
        <span class="for-discount-value p-1 pl-2 pr-2 font-bold fs-13">
            <span class="direction-ltr d-block">
                <?php if($product->discount_type == 'percent'): ?>
                    -<?php echo e(round($product->discount,(!empty($decimalPointSettings) ? $decimalPointSettings: 0))); ?>%
                <?php elseif($product->discount_type =='flat'): ?>
                    -<?php echo e(webCurrencyConverter(amount: $product->discount)); ?>

                <?php endif; ?>
            </span>
        </span>
    </div>
    <?php endif; ?>
    <div class="d-flex">
        <div class="d-flex align-items-center justify-content-center p-3">
            <div class="flash-deals-background-image image-default-bg-color">
                <img class="__img-125px" alt="" src="<?php echo e(getStorageImages(path: $product->thumbnail_full_url, type: 'product')); ?>">
            </div>
        </div>
        <div class=" flash_deal_product_details pl-3 pr-3 pr-1 d-flex align-items-center">
            <div>
                <div>
                    <h3 class="flash-product-title">
                        <?php echo e($product['name']); ?>

                    </h3>
                </div>
                <?php if($overallRating[0] != 0 ): ?>
                <div class="flash-product-review">
                    <?php for($inc=1;$inc<=5;$inc++): ?> <?php if($inc <=(int)$overallRating[0]): ?> <i class="tio-star text-warning">
                        </i>
                        <?php elseif($overallRating[0] != 0 && $inc <= (int)$overallRating[0] + 1.1 && $overallRating[0]>
                            ((int)$overallRating[0])): ?>
                            <i class="tio-star-half text-warning"></i>
                            <?php else: ?>
                            <i class="tio-star-outlined text-warning"></i>
                            <?php endif; ?>
                            <?php endfor; ?>
                            <label class="badge-style2">
                                ( <?php echo e(count($product->reviews)); ?> )
                            </label>
                </div>
                <?php endif; ?>
                <h4 class="d-flex flex-wrap gap-8 align-items-center row-gap-0 mb-0 fs-14 line-height-base">
                    <?php if($product->discount > 0): ?>
                    <del class="category-single-product-price">
                        <?php echo e(webCurrencyConverter(amount: $product->unit_price)); ?>

                    </del>
                    <?php endif; ?>
                    <span class="flash-product-price fw-semibold text-dark">
                        <?php echo e(webCurrencyConverter(amount: $product->unit_price-getProductDiscount(product: $product, price: $product->unit_price))); ?>

                    </span>
                </h4>

            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<?php /**PATH C:\Users\musas\Desktop\softwares\6valley\POSA-latest version\POSA\resources\themes\default/web-views/partials/_seller-products-product-details.blade.php ENDPATH**/ ?>