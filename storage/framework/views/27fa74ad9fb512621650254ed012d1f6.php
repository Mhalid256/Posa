<?php $__env->startSection('title', $product['name']); ?>

<?php $__env->startPush('css_or_js'); ?>
    <?php echo $__env->make(VIEW_FILE_NAMES['product_seo_meta_content_partials'], ['metaContentData' => $product?->seoInfo, 'productDetails' => $product], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <link rel="stylesheet" href="<?php echo e(theme_asset(path: 'public/assets/front-end/css/product-details.css')); ?>"/>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="__inline-23">
        <div class="container mt-4 rtl text-align-direction">
            <div class="row <?php echo e(Session::get('direction') === "rtl" ? '__dir-rtl' : ''); ?>">
                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-lg-5 col-md-4">
                            <div class="cz-product-gallery">
                                <div class="cz-preview">
                                    <div id="sync1" class="owl-carousel owl-theme product-thumbnail-slider">
                                        <?php if($product->images!=null && json_decode($product->images)>0): ?>
                                            <?php if(json_decode($product->colors) && count($product->color_images_full_url)>0): ?>
                                                <?php $__currentLoopData = $product->color_images_full_url; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if($photo['color'] != null): ?>
                                                        <div
                                                            class="product-preview-item d-flex align-items-center justify-content-center <?php echo e($key==0?'active':''); ?>"
                                                            id="image<?php echo e($photo['color']); ?>">
                                                            <img class="cz-image-zoom img-responsive w-100"
                                                                 src="<?php echo e(getStorageImages(path: $photo['image_name'], type: 'product')); ?>"
                                                                 data-zoom="<?php echo e(getStorageImages(path: $photo['image_name'], type: 'product')); ?>"
                                                                 alt="<?php echo e(translate('product')); ?>" width="">
                                                            <div class="cz-image-zoom-pane"></div>
                                                        </div>
                                                    <?php else: ?>
                                                        <div
                                                            class="product-preview-item d-flex align-items-center justify-content-center <?php echo e($key==0?'active':''); ?>"
                                                            id="image<?php echo e($key); ?>">
                                                            <img class="cz-image-zoom img-responsive w-100"
                                                                 src="<?php echo e(getStorageImages(path: $photo['image_name'], type: 'product')); ?>"
                                                                 data-zoom="<?php echo e(getStorageImages(path: $photo['image_name'], type: 'product')); ?>"
                                                                 alt="<?php echo e(translate('product')); ?>" width="">
                                                            <div class="cz-image-zoom-pane"></div>
                                                        </div>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php else: ?>
                                                <?php $__currentLoopData = $product->images_full_url; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div
                                                        class="product-preview-item d-flex align-items-center justify-content-center <?php echo e($key==0?'active':''); ?>"
                                                        id="image<?php echo e($key); ?>">
                                                        <img class="cz-image-zoom img-responsive w-100"
                                                             src="<?php echo e(getStorageImages($photo, type: 'product')); ?>"
                                                             data-zoom="<?php echo e(getStorageImages(path: $photo, type: 'product')); ?>"
                                                             alt="<?php echo e(translate('product')); ?>" width="">
                                                        <div class="cz-image-zoom-pane"></div>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>

                                    <?php if($product?->preview_file_full_url['path']): ?>
                                        <div>
                                            <div class="product-preview-modal-text"
                                                 data-toggle="modal"
                                                 data-target="#product-preview-modal">
                                                <span class="text-primary fw-bold py-2 user-select-none fs-14">
                                                    <?php echo e(translate('See_Preview')); ?>

                                                </span>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="d-flex flex-column gap-3">
                                    <button type="button" data-product-id="<?php echo e($product['id']); ?>"
                                            class="btn __text-18px border wishList-pos-btn d-sm-none product-action-add-wishlist">
                                        <i class="fa <?php echo e(($wishlistStatus == 1?'fa-heart':'fa-heart-o')); ?> wishlist_icon_<?php echo e($product['id']); ?> web-text-primary"
                                           aria-hidden="true"></i>
                                        <div class="wishlist-tooltip" x-placement="top">
                                            <div class="arrow"></div><div class="inner">
                                                <span class="add"><?php echo e(translate('added_to_wishlist')); ?></span>
                                                <span class="remove"><?php echo e(translate('removed_from_wishlist')); ?></span>
                                            </div>
                                        </div>
                                    </button>

                                    <div class="sharethis-inline-share-buttons share--icons text-align-direction">
                                    </div>
                                </div>

                                <div class="cz">
                                    <div class="table-responsive __max-h-515px" data-simplebar>
                                        <div class="d-flex">
                                            <div id="sync2" class="owl-carousel owl-theme product-thumb-slider">
                                                <?php if($product->images!=null && json_decode($product->images)>0): ?>
                                                    <?php if(json_decode($product->colors) && count($product->color_images_full_url)>0): ?>
                                                        <?php $__currentLoopData = $product->color_images_full_url; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if($photo['color'] != null): ?>
                                                                <div class="">
                                                                    <a class="product-preview-thumb color-variants-preview-box-<?php echo e($photo['color']); ?> <?php echo e($key==0?'active':''); ?> d-flex align-items-center justify-content-center"
                                                                       id="preview-img<?php echo e($photo['color']); ?>"
                                                                       href="#image<?php echo e($photo['color']); ?>">
                                                                        <img alt="<?php echo e(translate('product')); ?>"
                                                                             src="<?php echo e(getStorageImages(path: $photo['image_name'], type: 'product')); ?>">
                                                                    </a>
                                                                </div>
                                                            <?php else: ?>
                                                                <div class="">
                                                                    <a class="product-preview-thumb <?php echo e($key==0?'active':''); ?> d-flex align-items-center justify-content-center"
                                                                       id="preview-img<?php echo e($key); ?>" href="#image<?php echo e($key); ?>">
                                                                        <img alt="<?php echo e(translate('product')); ?>"
                                                                             src="<?php echo e(getStorageImages(path: $photo['image_name'], type: 'product')); ?>">
                                                                    </a>
                                                                </div>
                                                            <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php else: ?>
                                                        <?php $__currentLoopData = $product->images_full_url; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <div class="">
                                                                <a class="product-preview-thumb <?php echo e($key==0?'active':''); ?> d-flex align-items-center justify-content-center"
                                                                   id="preview-img<?php echo e($key); ?>" href="#image<?php echo e($key); ?>">
                                                                    <img alt="<?php echo e(translate('product')); ?>"
                                                                         src="<?php echo e(getStorageImages(path: $photo, type: 'product')); ?>">
                                                                </a>
                                                            </div>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-7 col-md-8 mt-md-0 mt-sm-3 web-direction">
                            <div class="details __h-100 product-cart-option-container">
                                <h2 class="mb-2 __inline-24"><?php echo e($product->name); ?></h2>
                                <div class="d-flex flex-wrap align-items-center mb-2 pro">
                                    <div class="star-rating me-2">
                                        <?php for($inc=1;$inc<=5;$inc++): ?>
                                            <?php if($inc <= (int)$overallRating[0]): ?>
                                                <i class="tio-star text-warning"></i>
                                            <?php elseif($overallRating[0] != 0 && $inc <= (int)$overallRating[0] + 1.1 && $overallRating[0] > ((int)$overallRating[0])): ?>
                                                <i class="tio-star-half text-warning"></i>
                                            <?php else: ?>
                                                <i class="tio-star-outlined text-warning"></i>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                    </div>
                                    <span
                                        class="d-inline-block  align-middle mt-1 <?php echo e(Session::get('direction') === "rtl" ? 'ml-md-2 ml-sm-0' : 'mr-md-2 mr-sm-0'); ?> fs-14 text-muted">(<?php echo e($overallRating[0]); ?>)</span>
                                    <span
                                        class="font-regular font-for-tab d-inline-block font-size-sm text-body align-middle mt-1 <?php echo e(Session::get('direction') === "rtl" ? 'mr-1 ml-md-2 ml-1 pr-md-2 pr-sm-1 pl-md-2 pl-sm-1' : 'ml-1 mr-md-2 mr-1 pl-md-2 pl-sm-1 pr-md-2 pr-sm-1'); ?>"><span class="web-text-primary"><?php echo e($overallRating[1]); ?></span> <?php echo e(translate('reviews')); ?></span>
                                    <span class="__inline-25"></span>
                                    <span
                                        class="font-regular font-for-tab d-inline-block font-size-sm text-body align-middle mt-1 <?php echo e(Session::get('direction') === "rtl" ? 'mr-1 ml-md-2 ml-1 pr-md-2 pr-sm-1 pl-md-2 pl-sm-1' : 'ml-1 mr-md-2 mr-1 pl-md-2 pl-sm-1 pr-md-2 pr-sm-1'); ?>"><span class="web-text-primary"><?php echo e($countOrder); ?></span> <?php echo e(translate('orders')); ?>   </span>
                                    <span class="__inline-25">    </span>
                                    <span
                                        class="font-regular font-for-tab d-inline-block font-size-sm text-body align-middle mt-1 <?php echo e(Session::get('direction') === "rtl" ? 'mr-1 ml-md-2 ml-0 pr-md-2 pr-sm-1 pl-md-2 pl-sm-1' : 'ml-1 mr-md-2 mr-0 pl-md-2 pl-sm-1 pr-md-2 pr-sm-1'); ?> text-capitalize"> <span class="web-text-primary countWishlist-<?php echo e($product->id); ?>"> <?php echo e($countWishlist); ?></span> <?php echo e(translate('wish_listed')); ?> </span>
                                </div>

                                <?php if($product['product_type'] == 'digital'): ?>
                                    <div class="digital-product-authors mb-2">
                                        <?php if(count($productPublishingHouseInfo['data']) > 0): ?>
                                            <div class="d-flex align-items-center g-2 me-2">
                                                <span class="text-capitalize digital-product-author-title"><?php echo e(translate('Publishing_House')); ?> :</span>
                                                <div class="item-list">
                                                    <?php $__currentLoopData = $productPublishingHouseInfo['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $publishingHouseName): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <a href="<?php echo e(route('products', ['publishing_house_id' => $publishingHouseName['id'], 'product_type' => 'digital', 'page'=>1])); ?>"
                                                           class="text-base">
                                                            <?php echo e($publishingHouseName['name']); ?>

                                                        </a>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <?php if(count($productAuthorsInfo['data']) > 0): ?>
                                            <div class="d-flex align-items-center g-2 me-2">
                                                <span class="text-capitalize digital-product-author-title"><?php echo e(translate('Author')); ?> :</span>
                                                <div class="item-list">
                                                    <?php $__currentLoopData = $productAuthorsInfo['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $productAuthor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <a href="<?php echo e(route('products',['author_id' => $productAuthor['id'], 'product_type' => 'digital', 'page' => 1])); ?>"
                                                           class="text-base">
                                                            <?php echo e($productAuthor['name']); ?>

                                                        </a>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>

                                <form class="mb-2 addToCartDynamicForm add-to-cart-details-form">

                                    <div class="mb-3">
                                        <h3 class="font-weight-normal text-accent d-flex align-items-end gap-2 pt-1">
                                            <span class="discounted-unit-price fs-24 font-bold">
                                                <?php echo e(getProductPriceByType(product: $product, type: 'discounted_unit_price', result: 'string')); ?>

                                            </span>
                                            <?php if(getProductPriceByType(product: $product, type: 'discount', result: 'value') > 0): ?>
                                                <del class="product-total-unit-price align-middle text-muted fs-18 font-semibold">
                                                    <?php echo e(webCurrencyConverter(amount: $product->unit_price)); ?>

                                                </del>
                                            <?php endif; ?>
                                        </h3>
                                    </div>

                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="id" value="<?php echo e($product->id); ?>">
                                    <div
                                        class="position-relative <?php echo e(Session::get('direction') === "rtl" ? 'ml-n4' : 'mr-n4'); ?> mb-2">
                                        <?php if(count(json_decode($product->colors)) > 0): ?>
                                            <div class="flex-start align-items-center mb-2 gap-2">
                                                <div class="product-description-label m-0 text-dark font-bold">
                                                    <?php echo e(translate('color')); ?>:
                                                </div>
                                                <div>
                                                    <ul class="list-inline checkbox-color mb-0 flex-start ms-2 ps-0">
                                                        <?php $__currentLoopData = json_decode($product->colors); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <li>
                                                                <input type="radio"
                                                                       id="<?php echo e(str_replace(' ', '', ($product->id. '-color-'. str_replace('#','',$color)))); ?>"
                                                                       name="color" value="<?php echo e($color); ?>"
                                                                       <?php if($key == 0): ?> checked <?php endif; ?>>
                                                                <label style="background: <?php echo e($color); ?>;"
                                                                    class="focus-preview-image-by-color shadow-border"
                                                                    for="<?php echo e(str_replace(' ', '', ($product->id. '-color-'. str_replace('#','',$color)))); ?>"
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
                                        <?php
                                            $qty = 0;
                                            if(!empty($product->variation)){
                                            foreach (json_decode($product->variation) as $key => $variation) {
                                                    $qty += $variation->qty;
                                                }
                                            }
                                        ?>
                                    </div>

                                    <?php ($extensionIndex=0); ?>
                                    <?php if($product['product_type'] == 'digital' && $product['digital_product_file_types'] && count($product['digital_product_file_types']) > 0 && $product['digital_product_extensions']): ?>
                                        <?php $__currentLoopData = $product['digital_product_extensions']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $extensionKey => $extensionGroup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="row flex-start mx-0 align-items-center mb-1">
                                            <div class="product-description-label text-dark font-bold <?php echo e(Session::get('direction') === "rtl" ? 'pl-2' : 'pr-2'); ?> text-capitalize mb-2">
                                                <?php echo e(translate($extensionKey)); ?> :
                                            </div>
                                            <div>
                                                <?php if(count($extensionGroup) > 0): ?>
                                                <div class="list-inline checkbox-alphanumeric checkbox-alphanumeric--style-1 mb-0 mx-1 flex-start ps-0">
                                                    <?php $__currentLoopData = $extensionGroup; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $extension): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="user-select-none">
                                                        <div class="for-mobile-capacity">
                                                            <input type="radio" hidden
                                                                   id="extension_<?php echo e(str_replace(' ', '-', $extension)); ?>"
                                                                   name="variant_key"
                                                                   value="<?php echo e($extensionKey.'-'.preg_replace('/\s+/', '-', $extension)); ?>"
                                                                <?php echo e($extensionIndex == 0 ? 'checked' : ''); ?>>
                                                            <label for="extension_<?php echo e(str_replace(' ', '-', $extension)); ?>"
                                                                   class="__text-12px">
                                                                <?php echo e($extension); ?>

                                                            </label>
                                                        </div>
                                                    </div>
                                                    <?php ($extensionIndex++); ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>

                                    <?php $__currentLoopData = json_decode($product->choice_options); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $choice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="row flex-start mx-0 align-items-center">
                                            <div
                                                class="product-description-label text-dark font-bold <?php echo e(Session::get('direction') === "rtl" ? 'pl-2' : 'pr-2'); ?> text-capitalize mb-2"><?php echo e($choice->title); ?>

                                                :
                                            </div>
                                            <div>
                                                <div class="list-inline checkbox-alphanumeric checkbox-alphanumeric--style-1 mb-0 mx-1 flex-start row ps-0">
                                                    <?php $__currentLoopData = $choice->options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div class="user-select-none">
                                                            <div class="for-mobile-capacity">
                                                                <input type="radio"
                                                                       id="<?php echo e(str_replace(' ', '', ($choice->name. '-'. $option))); ?>"
                                                                       name="<?php echo e($choice->name); ?>" value="<?php echo e($option); ?>"
                                                                       <?php if($index == 0): ?> checked <?php endif; ?> >
                                                                <label class="__text-12px"
                                                                       for="<?php echo e(str_replace(' ', '', ($choice->name. '-'. $option))); ?>"><?php echo e($option); ?></label>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    <div class="mt-3">
                                        <div class="product-quantity d-flex flex-column __gap-15">
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="product-description-label text-dark font-bold mt-0">
                                                    <?php echo e(translate('quantity')); ?> :
                                                </div>
                                                <div class="d-flex justify-content-center align-items-center quantity-box border rounded border-base web-text-primary">
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-number __p-10 web-text-primary" type="button"
                                                                data-type="minus" data-field="quantity"
                                                                disabled="disabled">
                                                            -
                                                        </button>
                                                    </span>
                                                    <input type="text" name="quantity"
                                                           class="form-control input-number text-center product-details-cart-qty __inline-29 border-0 "
                                                           placeholder="<?php echo e(translate('1')); ?>"
                                                           value="<?php echo e($product->minimum_order_qty ?? 1); ?>"
                                                           data-producttype="<?php echo e($product->product_type); ?>"
                                                           min="<?php echo e($product->minimum_order_qty ?? 1); ?>"
                                                           max="<?php echo e($product['product_type'] == 'physical' ? $product->current_stock : 100); ?>">
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-number __p-10 web-text-primary" type="button"
                                                                data-producttype="<?php echo e($product->product_type); ?>"
                                                                data-type="plus" data-field="quantity">
                                                                +
                                                        </button>
                                                    </span>
                                                </div>
                                                <input type="hidden" class="product-generated-variation-code" name="product_variation_code" data-product-id="<?php echo e($product['id']); ?>">
                                                <input type="hidden" value="" class="product-exist-in-cart-list form-control w-50" name="key">
                                            </div>
                                            <div class="product-details-chosen-price-section">
                                                <div
                                                    class="d-none d-sm-flex justify-content-start align-items-center me-2">
                                                    <div
                                                        class="product-description-label text-dark font-bold text-capitalize">
                                                        <strong><?php echo e(translate('total_price')); ?></strong> :
                                                    </div>
                                                    &nbsp; <strong class="text-base product-details-chosen-price-amount"></strong>
                                                    <small class="ms-2 font-regular product-details-tax-amount-container">
                                                        (<small><?php echo e(translate('tax')); ?> : </small>
                                                        <small class="product-details-tax-amount"></small>)
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="__btn-grp mt-2 mb-3 product-add-and-buy-section-parent">
                                        <div class="product-add-and-buy-section gap-2 <?php echo $firstVariationQuantity <= 0 ? '' : 'd-flex'; ?>" <?php echo $firstVariationQuantity <= 0 ? 'style="display: none;"' : ''; ?>>
                                            <?php if(($product->added_by == 'seller' && ($sellerTemporaryClose || (isset($product->seller->shop) && $product->seller->shop->vacation_status && $currentDate >= $sellerVacationStartDate && $currentDate <= $sellerVacationEndDate))) ||
                                             ($product->added_by == 'admin' && ($inHouseTemporaryClose || ($inHouseVacationStatus && $currentDate >= $inHouseVacationStartDate && $currentDate <= $inHouseVacationEndDate)))): ?>
                                                    <button class="btn btn-secondary" type="button" disabled>
                                                        <?php echo e(translate('buy_now')); ?>

                                                    </button>
                                                    <button class="btn btn--primary string-limit" type="button" disabled>
                                                        <?php echo e(translate('add_to_cart')); ?>

                                                    </button>
                                                <?php else: ?>
                                                    <button type="button"
                                                            class="btn btn-secondary element-center btn-gap-<?php echo e(Session::get('direction') === "rtl" ? 'left' : 'right'); ?> product-buy-now-button"
                                                            data-form=".add-to-cart-details-form"
                                                            data-auth="<?php echo e(( getWebConfig(name: 'guest_checkout') == 1 || Auth::guard('customer')->check() ? 'true':'false')); ?>"
                                                            data-route="<?php echo e(route('shop-cart')); ?>"
                                                    >
                                                        <span class="string-limit"><?php echo e(translate('buy_now')); ?></span>
                                                    </button>
                                                    <button class="btn btn--primary element-center product-add-to-cart-button"
                                                            type="button"
                                                            data-form=".add-to-cart-details-form"
                                                            data-update="<?php echo e(translate('update_cart')); ?>"
                                                            data-add="<?php echo e(translate('add_to_cart')); ?>"
                                                    >
                                                        <span class="string-limit"><?php echo e(translate('add_to_cart')); ?></span>
                                                    </button>
                                                <?php endif; ?>
                                        </div>
                                        <?php if(($product['product_type'] == 'physical')): ?>
                                            <div class="product-restock-request-section collapse" <?php echo $firstVariationQuantity <= 0 ? 'style="display: block;"' : ''; ?>>
                                                <button type="button"
                                                        class="btn request-restock-btn btn-outline-primary fw-semibold product-restock-request-button"
                                                        data-auth="<?php echo e(auth('customer')->check()); ?>"
                                                        data-form=".addToCartDynamicForm"
                                                        data-default="<?php echo e(translate('Request_Restock')); ?>"
                                                        data-requested="<?php echo e(translate('Request_Sent')); ?>"
                                                >
                                                    <?php echo e(translate('Request_Restock')); ?>

                                                </button>
                                            </div>
                                        <?php endif; ?>
                                        <button type="button" data-product-id="<?php echo e($product['id']); ?>" class="btn __text-18px border product-action-add-wishlist">
                                            <i class="fa <?php echo e(($wishlistStatus == 1?'fa-heart':'fa-heart-o')); ?> wishlist_icon_<?php echo e($product['id']); ?> web-text-primary"
                                               aria-hidden="true"></i>
                                            <span class="fs-14 text-muted align-bottom countWishlist-<?php echo e($product['id']); ?>"><?php echo e($countWishlist); ?></span>
                                            <div class="wishlist-tooltip" x-placement="top">
                                                <div class="arrow"></div><div class="inner">
                                                    <span class="add"><?php echo e(translate('added_to_wishlist')); ?></span>
                                                    <span class="remove"><?php echo e(translate('removed_from_wishlist')); ?></span>
                                                </div>
                                            </div>
                                        </button>
                                        <?php if(($product->added_by == 'seller' && ($sellerTemporaryClose || (isset($product->seller->shop) && $product->seller->shop->vacation_status && $currentDate >= $sellerVacationStartDate && $currentDate <= $sellerVacationEndDate))) ||
                                         ($product->added_by == 'admin' && ($inHouseTemporaryClose || ($inHouseVacationStatus && $currentDate >= $inHouseVacationStartDate && $currentDate <= $inHouseVacationEndDate)))): ?>
                                            <div class="alert alert-danger mt-2" role="alert">
                                                <?php echo e(translate('this_shop_is_temporary_closed_or_on_vacation._You_cannot_add_product_to_cart_from_this_shop_for_now')); ?>

                                            </div>
                                        <?php endif; ?>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 rtl text-align-direction">
                        <div class="px-4 pb-3 mb-3 mr-0 mr-md-2 bg-white __review-overview __rounded-10 pt-3">
                            <ul class="nav nav-tabs nav--tabs d-flex justify-content-center mt-3"
                                role="tablist">
                                <li class="nav-item">
                                    <h2 class="nav-link __inline-27 tab_link active" href="#overview"
                                        data-toggle="tab" role="tab">
                                        <?php echo e(translate('overview')); ?>

                                    </h2>
                                </li>
                                <li class="nav-item">
                                    <h2 class="nav-link __inline-27 tab_link" href="#reviews" data-toggle="tab"
                                        role="tab">
                                        <?php echo e(translate('reviews')); ?>

                                    </h2>
                                </li>
                            </ul>
                            <div class="tab-content px-lg-3">
                                <div class="tab-pane fade show active text-justify" id="overview"
                                        role="tabpanel">
                                    <div class="row pt-2 specification">

                                        <?php if($product->video_url != null && (($product->video_provider == 'youtube' && str_contains($product->video_url, "youtube.com/embed/")) || ($product->video_provider == 'tiktok' && str_contains($product->video_url, "tiktok.com/embed/")))): ?>
                                            <div class="col-12 mb-4">
                                                <?php if($product->video_provider == 'tiktok'): ?>
                                                    <iframe width="375" height="667"
                                                            src="<?php echo e($product->video_url); ?>">
                                                    </iframe>
                                                <?php else: ?>
                                                    <iframe width="420" height="315"
                                                            src="<?php echo e($product->video_url); ?>">
                                                    </iframe>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                        <?php if($product['details']): ?>
                                            <div class="text-body col-lg-12 col-md-12 overflow-scroll fs-13 text-justify details-text-justify rich-editor-html-content">
                                                <?php echo $product['details']; ?>

                                            </div>
                                        <?php endif; ?>

                                    </div>
                                    <?php if(!$product['details'] && ($product->video_url == null || !(($product->video_provider == 'youtube' && str_contains($product->video_url, "youtube.com/embed/")) || ($product->video_provider == 'tiktok' && str_contains($product->video_url, "tiktok.com/embed/"))))): ?>
                                        <div>
                                            <div class="text-center text-capitalize py-5">
                                                <img class="mw-90"
                                                        src="<?php echo e(theme_asset(path: 'public/assets/front-end/img/icons/nodata.svg')); ?>"
                                                        alt="">
                                                <p class="text-capitalize mt-2">
                                                    <small><?php echo e(translate('product_details_not_found')); ?>

                                                        !</small>
                                                </p>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="tab-pane fade" id="reviews" role="tabpanel">
                                    <?php if(count($product->reviews)==0 && $productReviews->total() == 0): ?>
                                        <div>
                                            <div class="text-center text-capitalize">
                                                <img class="mw-100"
                                                        src="<?php echo e(theme_asset(path: 'public/assets/front-end/img/icons/empty-review.svg')); ?>"
                                                        alt="">
                                                <p class="text-capitalize">
                                                    <small><?php echo e(translate('No_review_given_yet')); ?>!</small>
                                                </p>
                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <div class="row pt-2 pb-3">
                                            <div class="col-lg-4 col-md-5 ">
                                                <div
                                                    class=" row d-flex justify-content-center align-items-center">
                                                    <div
                                                        class="col-12 d-flex justify-content-center align-items-center">
                                                        <h2 class="overall_review mb-2 __inline-28">
                                                            <?php echo e($overallRating[0]); ?>

                                                        </h2>
                                                    </div>
                                                    <div
                                                        class="d-flex justify-content-center align-items-center star-rating ">
                                                        <?php for($inc=1;$inc<=5;$inc++): ?>
                                                            <?php if($inc <= (int)$overallRating[0]): ?>
                                                                <i class="tio-star text-warning"></i>
                                                            <?php elseif($overallRating[0] != 0 && $inc <= (int)$overallRating[0] + 1.1 && $overallRating[0] > ((int)$overallRating[0])): ?>
                                                                <i class="tio-star-half text-warning"></i>
                                                            <?php else: ?>
                                                                <i class="tio-star-outlined text-warning"></i>
                                                            <?php endif; ?>
                                                        <?php endfor; ?>
                                                    </div>
                                                    <div
                                                        class="col-12 d-flex justify-content-center align-items-center mt-2">
                                                        <span class="text-center">
                                                            <?php echo e($productReviews->total()); ?> <?php echo e(translate('ratings')); ?>

                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-8 col-md-7 pt-sm-3 pt-md-0">
                                                <div
                                                    class="d-flex align-items-center mb-2 font-size-sm">
                                                    <div
                                                        class="__rev-txt"><span
                                                            class="d-inline-block align-middle text-body"><?php echo e(translate('excellent')); ?></span>
                                                    </div>
                                                    <div class="w-0 flex-grow">
                                                        <div class="progress text-body __h-5px">
                                                            <div class="progress-bar web--bg-primary"
                                                                    role="progressbar"
                                                                    style="width: <?php echo $widthRating = ($rating[0] != 0) ? ($rating[0] / $overallRating[1]) * 100 : (0); ?>%;"
                                                                    aria-valuenow="60" aria-valuemin="0"
                                                                    aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-1 text-body">
                                                        <span
                                                            class=" <?php echo e(Session::get('direction') === "rtl" ? 'me-3 float-left' : 'ml-3 float-right'); ?> ">
                                                            <?php echo e($rating[0]); ?>

                                                        </span>
                                                    </div>
                                                </div>

                                                <div
                                                    class="d-flex align-items-center mb-2 text-body font-size-sm">
                                                    <div
                                                        class="__rev-txt"><span
                                                            class="d-inline-block align-middle "><?php echo e(translate('good')); ?></span>
                                                    </div>
                                                    <div class="w-0 flex-grow">
                                                        <div class="progress __h-5px">
                                                            <div class="progress-bar web--bg-primary" role="progressbar"
                                                                    style="width: <?php echo $widthRating = ($rating[1] != 0) ? ($rating[1] / $overallRating[1]) * 100 : (0); ?>%; background-color: #a7e453;"
                                                                    aria-valuenow="27" aria-valuemin="0"
                                                                    aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-1">
                                                        <span
                                                            class="<?php echo e(Session::get('direction') === "rtl" ? 'me-3 float-left' : 'ml-3 float-right'); ?>">
                                                                <?php echo e($rating[1]); ?>

                                                        </span>
                                                    </div>
                                                </div>

                                                <div
                                                    class="d-flex align-items-center mb-2 text-body font-size-sm">
                                                    <div
                                                        class="__rev-txt"><span
                                                            class="d-inline-block align-middle "><?php echo e(translate('average')); ?></span>
                                                    </div>
                                                    <div class="w-0 flex-grow">
                                                        <div class="progress __h-5px">
                                                            <div class="progress-bar web--bg-primary" role="progressbar"
                                                                    style="width: <?php echo $widthRating = ($rating[2] != 0) ? ($rating[2] / $overallRating[1]) * 100 : (0); ?>%; background-color: #ffda75;"
                                                                    aria-valuenow="17" aria-valuemin="0"
                                                                    aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-1">
                                                        <span
                                                            class="<?php echo e(Session::get('direction') === "rtl" ? 'me-3 float-left' : 'ml-3 float-right'); ?>">
                                                            <?php echo e($rating[2]); ?>

                                                        </span>
                                                    </div>
                                                </div>

                                                <div
                                                    class="d-flex align-items-center mb-2 text-body font-size-sm">
                                                    <div
                                                        class="__rev-txt "><span
                                                            class="d-inline-block align-middle"><?php echo e(translate('below_Average')); ?></span>
                                                    </div>
                                                    <div class="w-0 flex-grow">
                                                        <div class="progress __h-5px">
                                                            <div class="progress-bar web--bg-primary" role="progressbar"
                                                                    style="width: <?php echo $widthRating = ($rating[3] != 0) ? ($rating[3] / $overallRating[1]) * 100 : (0); ?>%; background-color: #fea569;"
                                                                    aria-valuenow="9" aria-valuemin="0"
                                                                    aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-1">
                                                        <span
                                                            class="<?php echo e(Session::get('direction') === "rtl" ? 'me-3 float-left' : 'ml-3 float-right'); ?>">
                                                            <?php echo e($rating[3]); ?>

                                                        </span>
                                                    </div>
                                                </div>

                                                <div
                                                    class="d-flex align-items-center text-body font-size-sm">
                                                    <div
                                                        class="__rev-txt"><span
                                                            class="d-inline-block align-middle "><?php echo e(translate('poor')); ?></span>
                                                    </div>
                                                    <div class="w-0 flex-grow">
                                                        <div class="progress __h-5px">
                                                            <div class="progress-bar web--bg-primary" role="progressbar"
                                                                    style="width: <?php echo $widthRating = ($rating[4] != 0) ? ($rating[4] / $overallRating[1]) * 100 : (0); ?>%;"
                                                                    aria-valuenow="4" aria-valuemin="0"
                                                                    aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-1">
                                                        <span
                                                            class="<?php echo e(Session::get('direction') === "rtl" ? 'me-3 float-left' : 'ml-3 float-right'); ?>">
                                                                <?php echo e($rating[4]); ?>

                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row pb-4 mb-3">
                                            <div class="__inline-30">
                                                <span
                                                    class="text-capitalize"><?php echo e(translate('Product_review')); ?></span>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <div class="row pb-4">
                                        <div class="col-12" id="product-review-list">
                                            <?php echo $__env->make('web-views.partials._product-reviews', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        </div>

                                        <?php if(count($product->reviews) > 2): ?>
                                            <div class="col-12">
                                                <div
                                                    class="card-footer d-flex justify-content-center align-items-center">
                                                    <button class="btn text-white view_more_button web--bg-primary">
                                                        <?php echo e(translate('view_more')); ?>

                                                    </button>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <?php ($companyReliability = getWebConfig('company_reliability')); ?>
                    <?php if($companyReliability != null): ?>
                        <div class="product-details-shipping-details">
                            <?php $__currentLoopData = $companyReliability; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($value['status'] == 1 && !empty($value['title'])): ?>
                                    <div class="shipping-details-bottom-border">
                                        <div class="px-3 py-3">
                                            <img class="<?php echo e(Session::get('direction') === "rtl" ? 'float-right ml-2' : 'mr-2'); ?> __img-20"
                                                 src="<?php echo e(getStorageImages(path: imagePathProcessing(imageData: $value['image'],path: 'company-reliability'), type: 'source', source: 'public/assets/front-end/img'.'/'.$value['item'].'.png')); ?>"
                                                alt="">
                                            <span><?php echo e(translate($value['title'])); ?></span>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endif; ?>

                    <?php if(getWebConfig(name: 'business_mode')=='multi'): ?>
                    <div class="__inline-31">

                        <?php if($product->added_by=='seller'): ?>
                            <?php if(isset($product->seller->shop)): ?>
                                <div class="row position-relative">
                                    <div class="col-12 position-relative">
                                        <a href="<?php echo e(route('shopView',['id'=> $product?->seller?->shop->id])); ?>" class="d-block">
                                            <div class="d-flex __seller-author align-items-center">
                                                <div>
                                                    <img class="__img-60 img-circle" alt=""
                                                         src="<?php echo e(getStorageImages(path: $product?->seller?->shop->image_full_url, type: 'shop')); ?>">
                                                </div>
                                                <div
                                                    class="ms-2 w-0 flex-grow">
                                                    <h2 class="fs-15 mb-1">
                                                        <?php echo e($product->seller->shop->name); ?>

                                                    </h2>
                                                    <h3 class="text-capitalize fs-12"><?php echo e(translate('vendor_info')); ?></h3>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center">

                                                <?php if($sellerTemporaryClose || ($product->seller->shop->vacation_status && $currentDate >= $sellerVacationStartDate && $currentDate <= $sellerVacationEndDate)): ?>
                                                    <span class="chat-seller-info product-details-seller-info"
                                                          data-toggle="tooltip"
                                                          title="<?php echo e(translate('this_shop_is_temporary_closed_or_on_vacation').' '.translate('You_cannot_add_product_to_cart_from_this_shop_for_now')); ?>">
                                                        <img src="<?php echo e(theme_asset(path: 'public/assets/front-end/img/info.png')); ?>" alt="i">
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <div class="row d-flex justify-content-between">
                                            <div class="col-6 ">
                                                <div
                                                    class="d-flex justify-content-center align-items-center rounded __h-79px hr-right-before">
                                                    <div class="text-center">
                                                        <img src="<?php echo e(theme_asset(path: 'public/assets/front-end/img/rating.svg')); ?>"
                                                             class="mb-2" alt="">
                                                        <div class="__text-12px text-base">
                                                            <strong><?php echo e($totalReviews); ?></strong> <?php echo e(translate('reviews')); ?>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div
                                                    class="d-flex justify-content-center align-items-center rounded __h-79px">
                                                    <div class="text-center">
                                                        <img
                                                            src="<?php echo e(theme_asset(path: 'public/assets/front-end/img/products.svg')); ?>"
                                                            class="mb-2" alt="">
                                                        <div class="__text-12px text-base">
                                                            <strong><?php echo e($productsForReview->total()); ?></strong> <?php echo e(translate('products')); ?>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 position-static mt-3">
                                        <div class="chat_with_seller-buttons">
                                            <?php if(auth('customer')->id()): ?>
                                                <button class="btn w-100 d-block text-center web--bg-primary text-white"
                                                        data-toggle="modal"
                                                        data-target="#chatting_modal" <?php echo e(($product->seller->shop->temporary_close || ($product->seller->shop->vacation_status && date('Y-m-d') >= date('Y-m-d', strtotime($product->seller->shop->vacation_start_date)) && date('Y-m-d') <= date('Y-m-d', strtotime($product->seller->shop->vacation_end_date)))) ? 'disabled' : ''); ?>>
                                                    <img class="mb-1" alt=""
                                                        src="<?php echo e(theme_asset(path: 'public/assets/front-end/img/chat-16-filled-icon.png')); ?>">
                                                    <span class="d-none d-sm-inline-block text-capitalize">
                                                        <?php echo e(translate('chat_with_vendor')); ?>

                                                    </span>
                                                </button>
                                            <?php else: ?>
                                                <a href="<?php echo e(route('customer.auth.login')); ?>"
                                                   class="btn w-100 d-block text-center web--bg-primary text-white">
                                                    <img src="<?php echo e(theme_asset(path: 'public/assets/front-end/img/chat-16-filled-icon.png')); ?>"
                                                        class="mb-1" alt="">
                                                    <span class="d-none d-sm-inline-block text-capitalize"><?php echo e(translate('chat_with_vendor')); ?></span>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php else: ?>
                            <div class="row position-relative d-flex justify-content-between">
                                <div class="col-9">
                                    <a href="<?php echo e(route('shopView',[0])); ?>" class="row d-flex ">
                                        <div>
                                            <img class="__inline-32" alt=""
                                                 src="<?php echo e(getStorageImages(path:$web_config['fav_icon'], type: 'logo')); ?>">
                                        </div>
                                        <div class="<?php echo e(Session::get('direction') === "rtl" ? 'right' : 'mt-3 ml-2'); ?> get-view-by-onclick"
                                             data-link="<?php echo e(route('shopView',[0])); ?>">
                                            <h2 class="font-bold __text-16px mb-0">
                                                <?php echo e($web_config['company_name']); ?>

                                            </h2><br>
                                        </div>

                                        <?php if($product->added_by == 'admin' && ($inHouseTemporaryClose || ($inHouseVacationStatus && $currentDate >= $inHouseVacationStartDate && $currentDate <= $inHouseVacationEndDate))): ?>
                                            <div class="<?php echo e(Session::get('direction') === "rtl" ? 'right' : 'ml-3'); ?>">
                                                <span class="chat-seller-info" data-toggle="tooltip"
                                                      title="<?php echo e(translate('this_shop_is_temporary_closed_or_on_vacation._You_cannot_add_product_to_cart_from_this_shop_for_now')); ?>">
                                                    <img src="<?php echo e(theme_asset(path: 'public/assets/front-end/img/info.png')); ?>"
                                                         alt="i">
                                                </span>
                                            </div>
                                        <?php endif; ?>
                                    </a>
                                </div>

                                <div class="col-12 mt-2">
                                    <div class="row d-flex justify-content-between">
                                        <div class="col-6 ">
                                            <div
                                                class="d-flex justify-content-center align-items-center rounded __h-79px hr-right-before">
                                                <div class="text-center">
                                                    <img src="<?php echo e(theme_asset(path: 'public/assets/front-end/img/rating.svg')); ?>"
                                                         class="mb-2" alt="">
                                                    <div class="__text-12px text-base">
                                                        <strong><?php echo e($totalReviews); ?></strong> <?php echo e(translate('reviews')); ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div
                                                class="d-flex justify-content-center align-items-center rounded __h-79px">
                                                <div class="text-center">
                                                    <img src="<?php echo e(theme_asset(path: 'public/assets/front-end/img/products.svg')); ?>"
                                                         class="mb-2" alt="">
                                                    <div class="__text-12px text-base">
                                                        <strong><?php echo e($productsForReview->total()); ?></strong> <?php echo e(translate('products')); ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 position-static mt-3">
                                    <div class="chat_with_seller-buttons">
                                        <?php if(auth('customer')->id()): ?>
                                            <button class="btn w-100 d-block text-center web--bg-primary text-white"
                                                    data-toggle="modal"
                                                    data-target="#chatting_modal" <?php echo e(($inHouseTemporaryClose || ($inHouseVacationStatus && $currentDate >= $inHouseVacationStartDate && $currentDate <= $inHouseVacationEndDate)) ? 'disabled' : ''); ?>>
                                                <img class="mb-1" alt=""
                                                     src="<?php echo e(theme_asset(path: 'public/assets/front-end/img/chat-16-filled-icon.png')); ?>">
                                                <span class="d-none d-sm-inline-block text-capitalize">
                                                        <?php echo e(translate('chat_with_vendor')); ?>

                                                </span>
                                            </button>
                                        <?php else: ?>
                                            <a href="<?php echo e(route('shopView',[0])); ?>" class="btn w-100 d-block text-center web--bg-primary text-white">
                                                <img class="mb-1" alt=""
                                                     src="<?php echo e(theme_asset(path: 'public/assets/front-end/img/chat-16-filled-icon.png')); ?>">
                                                <span class="d-none d-sm-inline-block text-capitalize">
                                                        <?php echo e(translate('chat_with_vendor')); ?>

                                                </span>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>

                    <div class="pt-4 pb-3">
                        <h2 class=" __text-16px font-bold text-capitalize">
                            <?php if(getWebConfig(name: 'business_mode')=='multi'): ?>
                                <?php echo e(translate('more_from_the_store')); ?>

                            <?php else: ?>
                                <?php echo e(translate('you_may_also_like')); ?>

                            <?php endif; ?>
                        </h2>
                    </div>
                    <div>
                        <?php $__currentLoopData = $moreProductFromSeller; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo $__env->make('web-views.partials._seller-products-product-details',['product'=>$item,'decimal_point_settings'=>$decimalPointSettings], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>

        <?php if(count($relatedProducts)>0): ?>
            <div class="container rtl text-align-direction">
                <div class="card __card border-0 mb-4">
                    <div class="card-body">
                        <div class="row flex-between align-items-center mb-2">
                            <div class="ms-1">
                                <h2 class="text-capitalize font-bold fs-16 mb-0"><?php echo e(translate('similar_products')); ?></h2>
                            </div>
                            <div class="view_all d-flex justify-content-center align-items-center">
                                <div>
                                    <?php ($category=json_decode($product['category_ids'])); ?>
                                    <?php if($category): ?>
                                        <a class="text-capitalize view-all-text web-text-primary me-1"
                                           href="<?php echo e(route('products',['category_id'=> $category[0]->id,'data_from'=>'category','page'=>1])); ?>"><?php echo e(translate('view_all')); ?>

                                            <i class="czi-arrow-<?php echo e(Session::get('direction') === "rtl" ? 'left mr-1 ml-n1 mt-1 ' : 'right ml-1 mr-n1'); ?>"></i>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div class="row g-3 mt-1">
                            <?php $__currentLoopData = $relatedProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $relatedProduct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-xl-2 col-sm-3 col-6">
                                    <?php echo $__env->make('web-views.partials._inline-single-product-without-eye',['product'=>$relatedProduct,'decimal_point_settings'=>$decimalPointSettings], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="modal fade rtl text-align-direction" id="show-modal-view" tabindex="-1" role="dialog" aria-labelledby="show-modal-image"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body flex justify-content-center">
                        <button class="btn btn-default __inline-33 dir-end-minus-7px"
                                data-dismiss="modal">
                            <i class="fa fa-close"></i>
                        </button>
                        <img class="element-center" id="attachment-view" src="" alt="">
                    </div>
                </div>
            </div>
        </div>

    </div>

    <?php echo $__env->make("web-views.products._product-details-sticky", ['productDetails' => $product], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php if($product?->preview_file_full_url['path']): ?>
        <?php echo $__env->make('web-views.partials._product-preview-modal', ['previewFileInfo' => $previewFileInfo], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

    <?php echo $__env->make('layouts.front-end.partials.modal._chatting',['seller'=>$product->seller, 'user_type'=>$product->added_by], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <span id="route-review-list-product" data-url="<?php echo e(route('review-list-product')); ?>"></span>
    <span id="products-details-page-data" data-id="<?php echo e($product['id']); ?>"></span>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script src="<?php echo e(theme_asset(path: 'public/assets/front-end/js/product-details.js')); ?>"></script>
    <script type="text/javascript" async="async"
            src="https://platform-api.sharethis.com/js/sharethis.js#property=5f55f75bde227f0012147049&product=sticky-share-buttons"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.front-end.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\musas\Desktop\softwares\6valley\POSA-latest version\POSA\resources\themes\default/web-views/products/details.blade.php ENDPATH**/ ?>