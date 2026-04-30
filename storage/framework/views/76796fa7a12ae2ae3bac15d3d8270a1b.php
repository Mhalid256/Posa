<div class="bg-white product-details-sticky product-details-sticky-section pt-4 pt-md-3 pb-3 <?php echo e($productDetails->variation && count(json_decode($productDetails->variation)) > 0 ? 'multi-variation-product' : ''); ?>">
    <div class="btn-circle product-details-sticky-collapse-btn d-md-none transition cursor-pointer shadow-sm position-absolute translate-middle top-0 left-50 justify-content-center align-items-center <?php echo e($productDetails->variation && count(json_decode($productDetails->variation)) > 0 ? 'd-flex' : 'd-none'); ?>" style="--size: 34px">
        <i class="czi-arrow-up"></i>
    </div>

    <div class="container product-cart-option-container">
        <form class="add-to-cart-sticky-form addToCartDynamicForm">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="id" value="<?php echo e($productDetails->id); ?>">
            <input type="hidden" name="position" value="bottom">
            <div class="product-details-sticky-top">
                <div class="border-bottom d-flex flex-column gap-3 mb-3 pb-3">
                    <?php if(count(json_decode($productDetails->colors)) > 0): ?>
                    <div class="position-relative ps-1">
                        <h6 class="fs-14 mb-2">
                            <?php echo e(translate('color')); ?>

                            <span class="text-muted font-weight-light product-details-sticky-color-name"></span>
                        </h6>
                        <div>
                            <ul class="list-inline checkbox-color mb-0 flex-start ps-0">
                                <?php $__currentLoopData = json_decode($productDetails->colors); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="user-select-none">
                                        <input type="radio"
                                               id="sticky-<?php echo e(str_replace(' ', '', ($productDetails->id. '-color-'. str_replace('#','',$color)))); ?>"
                                               name="color" value="<?php echo e($color); ?>"
                                               <?php if($key == 0): ?> checked <?php endif; ?>>
                                        <label style="background: <?php echo e($color); ?>;"
                                               class="focus-preview-image-by-color shadow-border m-0"
                                               for="sticky-<?php echo e(str_replace(' ', '', ($productDetails->id. '-color-'. str_replace('#','',$color)))); ?>"
                                               data-toggle="tooltip"
                                               data-key="<?php echo e(str_replace('#','',$color)); ?>"
                                               data-colorid="preview-box-<?php echo e(str_replace('#','',$color)); ?>" data-title="<?php echo e(getColorNameByCode(code: $color)); ?>">
                                            <span class="outline"></span></label>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php ($extensionIndex=0); ?>
                    <?php if($productDetails['product_type'] == 'digital' && $productDetails['digital_product_file_types'] && count($productDetails['digital_product_file_types']) > 0 && $productDetails['digital_product_extensions']): ?>
                        <?php $__currentLoopData = $productDetails['digital_product_extensions']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $extensionKey => $extensionGroup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div>
                            <h6 class="fs-14 mb-2 text-capitalize">
                                <?php echo e(translate($extensionKey)); ?>

                            </h6>

                            <?php if(count($extensionGroup) > 0): ?>
                            <div class="list-inline checkbox-alphanumeric checkbox-alphanumeric--style-1 mb-0 flex-start row ps-0 overflow-x-auto flex-nowrap overflow-y-hidden scrollbar-none">
                                <?php $__currentLoopData = $extensionGroup; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $extension): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="user-select-none">
                                        <div class="for-mobile-capacity">
                                            <input type="radio" hidden
                                                   id="sticky-extension_<?php echo e(str_replace(' ', '-', $extension)); ?>"
                                                   name="variant_key"
                                                   value="<?php echo e($extensionKey.'-'.preg_replace('/\s+/', '-', $extension)); ?>"
                                                <?php echo e($extensionIndex == 0 ? 'checked' : ''); ?>>
                                            <label for="sticky-extension_<?php echo e(str_replace(' ', '-', $extension)); ?>"
                                                   class="__text-12px max-content">
                                                <?php echo e($extension); ?>

                                            </label>
                                        </div>
                                    </div>
                                    <?php ($extensionIndex++); ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <?php endif; ?>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>

                    <?php $__currentLoopData = json_decode($productDetails->choice_options); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $choice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div>
                        <h6 class="fs-14 mb-2 text-capitalize">
                            <?php echo e($choice->title); ?>

                        </h6>
                        <div class="list-inline checkbox-alphanumeric checkbox-alphanumeric--style-1 mb-0 flex-start ps-0 overflow-x-auto flex-nowrap overflow-y-hidden scrollbar-none">
                            <?php $__currentLoopData = $choice->options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="user-select-none">
                                    <div class="for-mobile-capacity">
                                        <input type="radio"
                                               id="sticky-<?php echo e(str_replace(' ', '', ($choice->name. '-'. $option))); ?>"
                                               name="<?php echo e($choice->name); ?>" value="<?php echo e($option); ?>"
                                               <?php if($index == 0): ?> checked <?php endif; ?> >
                                        <label class="__text-12px max-content"
                                               for="sticky-<?php echo e(str_replace(' ', '', ($choice->name. '-'. $option))); ?>"><?php echo e($option); ?></label>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

            <div class="d-flex flex-column flex-lg-row justify-content-between gap-3 product-details-sticky-bottom">
                <div class="media gap-sm-3 d-flex flex-column flex-sm-row">
                    <img width="48" class="rounded d-none d-sm-block aspect-1 object-cover"
                         src="<?php echo e(getStorageImages(path: $productDetails->thumbnail_full_url, type: 'product')); ?>"
                         alt=""
                    >
                    <div class="media-body">
                        <h6 class="mb-1 fs-14 line--limit-1">
                            <?php echo e($productDetails->name); ?>

                        </h6>
                        <div>
                            <input type="hidden" class="product-generated-variation-code" name="product_variation_code" data-product-id="<?php echo e($productDetails['id']); ?>">
                            <input type="hidden" value="" class="product-exist-in-cart-list form-control w-50" name="key">
                        </div>
                        <div class="d-flex flex-wrap align-items-center mb-2 pro">
                            <span class="fs-12 text-muted line--limit-1 text-capitalize product-generated-variation-text"></span>
                            <div class="d-none d-sm-flex flex-wrap align-items-center">
                                <span class="<?php echo e(count(json_decode($productDetails->variation, true)) > 0 ? '__inline-25' : ''); ?> <?php echo e(count(json_decode($productDetails->variation, true)) > 0 ? 'mx-2' : ''); ?> mt-0"></span>

                                <span class="fs-12">
                                    <span class="d-flex flex-wrap gap-8 align-items-center row-gap-0">
                                        <?php echo getPriceRangeWithDiscount(product: $productDetails); ?>

                                    </span>
                                </span>
                                <span class="for-discount-value position-static p-1 px-2 font-bold fs-13 mx-2 discounted-badge-element">
                                    <span class="direction-ltr d-block discounted_badge">
                                        <?php echo e(webCurrencyConverter(amount: 0)); ?>

                                    </span>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="d-sm-none d-flex gap-1 fs-12">
                        <?php echo getPriceRangeWithDiscount(product: $productDetails); ?>

                    </div>
                </div>

                <div class="d-flex align-items-center gap-2 gap-sm-3 gap-xl-4">
                    <div class="d-flex justify-content-between align-items-center quantity-box quantity-box-120 border rounded border-base web-text-primary">
                        <button class="flex-grow-1 btn btn-number __p-10 web-text-primary product-quantity-minus bg-count-light border-0 shadow-none px-3" type="button" data-type="minus" data-field="quantity" disabled="disabled">-</button>
                        <input type="number" name="quantity"
                               class="flex-grow-1 form-control input-number text-center product-details-cart-qty __inline-29 border-0 "
                               placeholder="<?php echo e(translate('1')); ?>"
                               value="<?php echo e($productDetails->minimum_order_qty ?? 1); ?>"
                               data-producttype="<?php echo e($productDetails->product_type); ?>"
                               min="<?php echo e($productDetails->minimum_order_qty ?? 1); ?>"
                               max="<?php echo e($productDetails['product_type'] == 'physical' ? $productDetails->current_stock : 100); ?>">

                        <button class="flex-grow-1 btn btn-number __p-10 web-text-primary product-quantity-plus bg-count-light border-0 shadow-none px-3" type="button" data-producttype="physical" data-type="plus" data-field="quantity">+</button>
                    </div>

                    <div class="font-weight-normal text-accent align-items-end gap-2 d-none d-lg-flex">
                        <span class="product-bottom-section-price fs-24 font-bold user-select-none text-nowrap"></span>
                    </div>


                    <?php if(($product->added_by == 'seller' && ($sellerTemporaryClose || (isset($product->seller->shop) && $product->seller->shop->vacation_status && $currentDate >= $sellerVacationStartDate && $currentDate <= $sellerVacationEndDate))) ||
                                         ($product->added_by == 'admin' && ($inHouseTemporaryClose || ($inHouseVacationStatus && $currentDate >= $inHouseVacationStartDate && $currentDate <= $inHouseVacationEndDate)))): ?>
                        <div class="alert alert-danger m-0 font-semi-bold fs-12 ms-2" role="alert">
                            <?php echo e(translate('you_cannot_add_product_to_cart_from_this_shop_for_now')); ?>

                        </div>
                    <?php else: ?>
                        <div class="product-add-and-buy-section d-flex gap-2">
                            <button type="button" class="btn btn-secondary element-center btn-gap-right product-buy-now-button"
                                    data-form=".add-to-cart-sticky-form"
                                    data-auth="<?php echo e(( getWebConfig(name: 'guest_checkout') == 1 || Auth::guard('customer')->check() ? 'true':'false')); ?>"
                                    data-route="<?php echo e(route('shop-cart')); ?>"
                            >
                                <span class="string-limit"><?php echo e(translate('buy_now')); ?></span>
                            </button>

                            <button class="btn btn--primary element-center product-add-to-cart-button"
                                    type="button"
                                    data-form=".add-to-cart-sticky-form"
                                    data-update="<?php echo e(translate('update_cart')); ?>"
                                    data-add="<?php echo e(translate('add_to_cart')); ?>"
                            >
                                <?php echo e(translate('add_to_cart')); ?>

                            </button>
                        </div>

                        <?php if(($productDetails['product_type'] == 'physical')): ?>
                            <div class="product-restock-request-section collapse" <?php echo $firstVariationQuantity <= 0 ? 'style="display: block;"' : ''; ?>>
                                <button type="button"
                                        class="btn request-restock-btn btn-outline-primary fw-semibold product-restock-request-button"
                                        data-auth="<?php echo e(auth('customer')->check()); ?>"
                                        data-form=".add-to-cart-sticky-form"
                                        data-default="<?php echo e(translate('Request_Restock')); ?>"
                                        data-requested="<?php echo e(translate('Request_Sent')); ?>"
                                >
                                    <?php echo e(translate('Request_Restock')); ?>

                                </button>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </form>
    </div>
</div>
<?php /**PATH C:\Users\musas\Desktop\softwares\6valley\POSA-latest version\POSA\resources\themes\default/web-views/products/_product-details-sticky.blade.php ENDPATH**/ ?>