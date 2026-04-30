<?php
    $overallRating = getOverallRating($product->reviews);
    $rating = getRating($product->reviews);
    $productReviews = \App\Utils\ProductManager::get_product_review($product->id);
?>

<div class="modal-header rtl">
    <div>
        <h4 class="modal-title product-title">
            <a class="product-title2" href="<?php echo e(route('product',$product->slug)); ?>" data-toggle="tooltip"
               data-placement="right"
               title="Go to product page"><?php echo e($product['name']); ?>

                <i class="czi-arrow-<?php echo e(Session::get('direction') === "rtl" ? 'left' : 'right'); ?> ms-2 font-size-lg mr-0"></i>
            </a>
        </h4>
    </div>
    <div>
        <button class="close close-quick-view-modal" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>

<div class="modal-body rtl">
    <div class="row ">
        <div class="col-lg-5 col-md-4 col-12">
            <div class="cz-product-gallery position-relative">
                <div class="cz-preview">
                    <div id="sync1" class="owl-carousel owl-theme product-thumbnail-slider">
                        <?php if($product->images!=null && count($product->images_full_url)>0): ?>
                            <?php if(json_decode($product->colors) && count($product->color_images_full_url)>0): ?>
                                <?php $__currentLoopData = $product->color_images_full_url; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($photo['color'] != null): ?>
                                        <div
                                            class="product-preview-item d-flex align-items-center justify-content-center">
                                            <img class="show-imag img-responsive max-height-500px"
                                                 src="<?php echo e(getStorageImages(path: $photo['image_name'], type: 'product')); ?>"
                                                 alt="<?php echo e(translate('product')); ?>" width="">
                                        </div>
                                    <?php else: ?>
                                        <div
                                            class="product-preview-item d-flex align-items-center justify-content-center">
                                            <img class="show-imag img-responsive max-height-500px"
                                                 src="<?php echo e(getStorageImages(path:$photo['image_name'], type: 'product')); ?>"
                                                 alt="<?php echo e(translate('product')); ?>" width="">
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <?php $__currentLoopData = $product->images_full_url; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="product-preview-item d-flex align-items-center justify-content-center">
                                        <img class="show-imag img-responsive max-height-500px"
                                             src="<?php echo e(getStorageImages(path: $photo, type: 'product')); ?>"
                                             alt="<?php echo e(translate('product')); ?>">
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="cz-product-gallery-icons">
                    <div class="d-flex flex-column">
                        <button type="button" data-product-id="<?php echo e($product['id']); ?>"
                                class="btn __text-18px border wishList-pos-btn d-sm-none product-action-add-wishlist">
                            <i class="fa <?php echo e(($wishlist_status == 1?'fa-heart':'fa-heart-o')); ?> wishlist_icon_<?php echo e($product['id']); ?> web-text-primary"
                               id="wishlist_icon_<?php echo e($product['id']); ?>" aria-hidden="true"></i>
                            <div class="wishlist-tooltip" x-placement="top">
                                <div class="arrow"></div>
                                <div class="inner">
                                    <span class="add"><?php echo e(translate('added_to_wishlist')); ?></span>
                                    <span class="remove"><?php echo e(translate('removed_from_wishlist')); ?></span>
                                </div>
                            </div>
                        </button>

                        <div class="sharethis-inline-share-buttons share--icons text-align-direction">
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <div class="d-flex">
                        <div id="sync2" class="owl-carousel owl-theme product-thumb-slider max-height-100px d--none">
                            <?php if($product->images!=null && count($product->images_full_url)>0): ?>
                                <?php if(json_decode($product->colors) && count($product->color_images_full_url)>0): ?>
                                    <?php $__currentLoopData = $product->color_images_full_url; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($photo['color'] != null): ?>
                                            <div class="">
                                                <a href="javascript:"
                                                   class="product-preview-thumb d-flex align-items-center justify-content-center">
                                                    <img class="click-img" id="preview-img<?php echo e($photo['color']); ?>"
                                                         src="<?php echo e(getStorageImages(path:$photo['image_name'], type: 'product')); ?>"
                                                         alt="<?php echo e(translate('product')); ?>">
                                                </a>
                                            </div>
                                        <?php else: ?>
                                            <div class="">
                                                <a href="javascript:"
                                                   class="product-preview-thumb d-flex align-items-center justify-content-center">
                                                    <img class="click-img" id="preview-img<?php echo e($key); ?>"
                                                         src="<?php echo e(getStorageImages(path: $photo['image_name'], type: 'product')); ?>"
                                                         alt="<?php echo e(translate('product')); ?>">
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <?php $__currentLoopData = $product->images_full_url; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="">
                                            <a href="javascript:"
                                               class="product-preview-thumb d-flex align-items-center justify-content-center">
                                                <img class="click-img" id="preview-img<?php echo e($key); ?>"
                                                     src="<?php echo e(getStorageImages(path: $photo, type: 'product')); ?>"
                                                     alt="<?php echo e(translate('product')); ?>">
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

        <div class="col-lg-7 col-md-8 col-12 mt-md-0 mt-sm-3 web-direction">
            <div class="details __h-100 product-cart-option-container">
                <a href="<?php echo e(route('product',$product->slug)); ?>" class="h3 mb-2 product-title"><?php echo e($product->name); ?></a>

                <div class="d-flex flex-wrap align-items-center mb-2 pro">
                    <div class="star-rating me-2">
                        <?php for($inc=0;$inc<5;$inc++): ?>
                            <?php if($inc<$overallRating[0]): ?>
                                <i class="sr-star czi-star-filled active"></i>
                            <?php else: ?>
                                <i class="sr-star czi-star"></i>
                            <?php endif; ?>
                        <?php endfor; ?>
                    </div>
                    <span
                        class="d-inline-block  align-middle mt-1 <?php echo e(Session::get('direction') === "rtl" ? 'ml-md-2 ml-sm-0' : 'mr-md-2 mr-sm-0'); ?> fs-14 text-muted">(<?php echo e($overallRating[0]); ?>)</span>
                    <span
                        class="font-regular font-for-tab d-inline-block font-size-sm text-body align-middle mt-1 <?php echo e(Session::get('direction') === "rtl" ? 'mr-1 ml-md-2 ml-1 pr-md-2 pr-sm-1 pl-md-2 pl-sm-1' : 'ml-1 mr-md-2 mr-1 pl-md-2 pl-sm-1 pr-md-2 pr-sm-1'); ?>"><span
                            class="web-text-primary"><?php echo e($overallRating[1]); ?></span> <?php echo e(translate('reviews')); ?></span>
                    <span class="__inline-25"></span>
                    <span
                        class="font-regular font-for-tab d-inline-block font-size-sm text-body align-middle mt-1 <?php echo e(Session::get('direction') === "rtl" ? 'mr-1 ml-md-2 ml-1 pr-md-2 pr-sm-1 pl-md-2 pl-sm-1' : 'ml-1 mr-md-2 mr-1 pl-md-2 pl-sm-1 pr-md-2 pr-sm-1'); ?>">
                        <span class="web-text-primary">
                            <?php echo e($countOrder); ?>

                        </span> <?php echo e(translate('orders')); ?>   </span>
                    <span class="__inline-25">    </span>
                    <span
                        class="font-regular font-for-tab d-inline-block font-size-sm text-body align-middle mt-1 <?php echo e(Session::get('direction') === "rtl" ? 'mr-1 ml-md-2 ml-0 pr-md-2 pr-sm-1 pl-md-2 pl-sm-1' : 'ml-1 mr-md-2 mr-0 pl-md-2 pl-sm-1 pr-md-2 pr-sm-1'); ?> text-capitalize">
                        <span class="web-text-primary countWishlist-<?php echo e($product->id); ?>"> <?php echo e($countWishlist); ?></span> <?php echo e(translate('wish_listed')); ?>

                    </span>

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
                                <span
                                    class="text-capitalize digital-product-author-title"><?php echo e(translate('Author')); ?> :</span>
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
                    <?php echo csrf_field(); ?>

                    <div class="mb-3">
                        <span class="font-weight-normal text-accent d-flex align-items-end gap-2">
                            <?php echo getPriceRangeWithDiscount(product: $product); ?>

                        </span>
                    </div>

                    <input type="hidden" name="id" value="<?php echo e($product->id); ?>">
                    <div class="position-relative <?php echo e(Session::get('direction') === "rtl" ? 'ml-n4' : 'mr-n4'); ?> mb-3">
                        <?php if(count(json_decode($product->colors)) > 0): ?>
                            <div class="flex-start">
                                <div class="product-description-label text-dark font-bold">
                                    <?php echo e(translate('color')); ?>:
                                </div>
                                <div class="__pl-15 mt-1">
                                    <ul class="flex-start checkbox-color mb-0 p-0 list-inline">
                                        <?php $__currentLoopData = json_decode($product->colors); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li>
                                                <input type="radio"
                                                       id="<?php echo e($product->id); ?>-color-<?php echo e(str_replace('#','',$color)); ?>"
                                                       name="color" value="<?php echo e($color); ?>"
                                                       <?php if($key == 0): ?> checked <?php endif; ?>>
                                                <label style="background: <?php echo e($color); ?>;"
                                                       class="quick-view-preview-image-by-color shadow-border"
                                                       for="<?php echo e($product->id); ?>-color-<?php echo e(str_replace('#','',$color)); ?>"
                                                       data-toggle="tooltip"
                                                       data-key="<?php echo e(str_replace('#','',$color)); ?>"
                                                       data-title="<?php echo e(getColorNameByCode(code: $color)); ?>">
                                                    <span class="outline"></span>
                                                </label>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php
                            $qty = 0;
                            foreach (json_decode($product->variation) as $key => $variation) {
                                $qty += $variation->qty;
                            }
                        ?>

                    </div>

                    <?php $__currentLoopData = json_decode($product->choice_options); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $choice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="flex-start">
                            <div class="product-description-label text-dark font-bold mt-1 text-capitalize">
                                <?php echo e($choice->title); ?>:
                            </div>
                            <div>
                                <ul class="checkbox-alphanumeric checkbox-alphanumeric--style-1 mt-1">
                                    <?php $__currentLoopData = $choice->options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <span>
                                            <input type="radio" id="<?php echo e($choice->name); ?>-<?php echo e($option); ?>"
                                                   name="<?php echo e($choice->name); ?>"
                                                   value="<?php echo e($option); ?>" <?php if($index==0): ?> checked <?php endif; ?>>
                                            <label class="user-select-none"
                                                   for="<?php echo e($choice->name); ?>-<?php echo e($option); ?>"><?php echo e($option); ?></label>
                                        </span>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <?php ($extensionIndex=0); ?>
                    <?php if($product['product_type'] == 'digital' && $product['digital_product_file_types'] && count($product['digital_product_file_types']) > 0 && $product['digital_product_extensions']): ?>
                        <?php $__currentLoopData = $product['digital_product_extensions']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $extensionKey => $extensionGroup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="row flex-start mx-0 align-items-center mb-1">
                                <div
                                    class="product-description-label text-dark font-bold <?php echo e(Session::get('direction') === "rtl" ? 'pl-2' : 'pr-2'); ?> text-capitalize mb-2">
                                    <?php echo e(translate($extensionKey)); ?> :
                                </div>
                                <div>
                                    <?php if(count($extensionGroup) > 0): ?>
                                        <div
                                            class="list-inline checkbox-alphanumeric checkbox-alphanumeric--style-1 mb-0 mx-1 flex-start row ps-0">
                                            <?php $__currentLoopData = $extensionGroup; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $extension): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div>
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

                    <div class="mb-3">
                        <div class="product-quantity d-flex flex-column __gap-15">
                            <div class="d-flex align-items-center gap-3">
                                <div class="product-description-label text-dark font-bold mt-0">
                                    <?php echo e(translate('quantity')); ?> :
                                </div>
                                <div
                                    class="d-flex justify-content-center align-items-center quantity-box border rounded border-base web-text-primary">
                                <span class="input-group-btn">
                                    <button class="btn btn-number __p-10 web-text-primary" type="button"
                                            data-type="minus"
                                            data-field="quantity"
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
                                <input type="hidden" class="product-generated-variation-code"
                                       name="product_variation_code" data-product-id="<?php echo e($product['id']); ?>">
                                <input type="hidden" value="" class="product-exist-in-cart-list form-control w-50"
                                       name="key">
                            </div>
                            <div class="product-details-chosen-price-section">
                                <div class="d-flex justify-content-start align-items-center me-2">
                                    <div class="product-description-label text-dark font-bold text-capitalize">
                                        <strong><?php echo e(translate('total_price')); ?></strong> :
                                    </div>
                                    &nbsp; <strong class="text-base product-details-chosen-price-amount"></strong>
                                    <small class="ms-2 font-regular">
                                        (<small><?php echo e(translate('tax')); ?> : </small>
                                        <small class="product-details-tax-amount"></small>)
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php ($guestCheckout = getWebConfig(name: 'guest_checkout')); ?>
                    <div
                        class="__btn-grp align-items-center mb-2 product-add-and-buy-section" <?php echo $firstVariationQuantity <= 0 ? 'style="display: none;"' : ''; ?>>
                        <?php if(($product->added_by == 'seller' && ($seller_temporary_close || (isset($product->seller->shop) &&
                        $product->seller->shop->vacation_status && $currentDate >= $seller_vacation_start_date && $currentDate
                        <= $seller_vacation_end_date))) || ($product->added_by == 'admin' && ($inhouse_temporary_close ||
                            ($inHouseVacationStatus && $currentDate >= $inhouse_vacation_start_date && $currentDate <=
                                $inhouse_vacation_end_date)))): ?>

                            <button class="btn btn-secondary" type="button" disabled>
                                <?php echo e(translate('buy_now')); ?>

                            </button>

                            <button class="btn btn--primary string-limit" type="button" disabled>
                                <?php echo e(translate('add_to_cart')); ?>

                            </button>
                        <?php else: ?>
                            <button class="btn btn-secondary product-buy-now-button"
                                    type="button"
                                    data-form=".add-to-cart-details-form"
                                    data-auth="<?php echo e(( getWebConfig(name: 'guest_checkout') == 1 || Auth::guard('customer')->check() ? 'true':'false')); ?>"
                                    data-route="<?php echo e(route('shop-cart')); ?>"
                            >
                                <?php echo e(translate('buy_now')); ?>

                            </button>
                            <button class="btn btn--primary string-limit product-add-to-cart-button"
                                    type="button"
                                    data-form=".add-to-cart-details-form"
                                    data-update="<?php echo e(translate('update_cart')); ?>"
                                    data-add="<?php echo e(translate('add_to_cart')); ?>"
                            >
                                <?php echo e(translate('add_to_cart')); ?>

                            </button>
                        <?php endif; ?>

                        <button type="button" data-product-id="<?php echo e($product['id']); ?>"
                                class="btn __text-18px border product-action-add-wishlist">
                            <i class="fa <?php echo e(($wishlist_status == 1?'fa-heart':'fa-heart-o')); ?> wishlist_icon_<?php echo e($product['id']); ?> web-text-primary"
                               id="wishlist_icon_<?php echo e($product['id']); ?>" aria-hidden="true"></i>
                            <span class="fs-14 text-muted align-bottom countWishlist-<?php echo e($product['id']); ?>">
                                <?php echo e($countWishlist); ?>

                            </span>
                            <div class="wishlist-tooltip" x-placement="top">
                                <div class="arrow"></div>
                                <div class="inner">
                                    <span class="add"><?php echo e(translate('added_to_wishlist')); ?></span>
                                    <span class="remove"><?php echo e(translate('removed_from_wishlist')); ?></span>
                                </div>
                            </div>
                        </button>

                        <?php if(($product->added_by == 'seller' && ($seller_temporary_close ||
                        (isset($product->seller->shop) && $product->seller->shop->vacation_status && $currentDate >=
                        $seller_vacation_start_date && $currentDate <= $seller_vacation_end_date))) || ($product->
                            added_by == 'admin' && ($inhouse_temporary_close || ($inHouseVacationStatus &&
                            $currentDate >= $inhouse_vacation_start_date && $currentDate <= $inhouse_vacation_end_date)))): ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo e(translate('this_shop_is_temporary_closed_or_on_vacation._You_cannot_add_product_to_cart_from_this_shop_for_now')); ?>

                            </div>
                        <?php endif; ?>
                    </div>

                    <?php if(($product['product_type'] == 'physical')): ?>
                        <div
                            class="product-restock-request-section collapse" <?php echo $firstVariationQuantity <= 0 ? 'style="display: block;"' : ''; ?>>
                            <button type="button"
                                    class="btn request-restock-btn btn-outline-primary fw-semibold product-restock-request-button me-2"
                                    data-auth="<?php echo e(auth('customer')->check()); ?>"
                                    data-form=".addToCartDynamicForm"
                                    data-default="<?php echo e(translate('Request_Restock')); ?>"
                                    data-requested="<?php echo e(translate('Request_Sent')); ?>"
                            >
                                <?php echo e(translate('Request_Restock')); ?>

                            </button>
                            <button type="button" data-product-id="<?php echo e($product['id']); ?>"
                                    class="btn __text-18px border product-action-add-wishlist">
                                <i class="fa <?php echo e(($wishlist_status == 1?'fa-heart':'fa-heart-o')); ?> wishlist_icon_<?php echo e($product['id']); ?> web-text-primary"
                                   id="wishlist_icon_<?php echo e($product['id']); ?>" aria-hidden="true"></i>
                                <span class="fs-14 text-muted align-bottom countWishlist-<?php echo e($product['id']); ?>">
                                <?php echo e($countWishlist); ?>

                            </span>
                                <div class="wishlist-tooltip" x-placement="top">
                                    <div class="arrow"></div>
                                    <div class="inner">
                                        <span class="add"><?php echo e(translate('added_to_wishlist')); ?></span>
                                        <span class="remove"><?php echo e(translate('removed_from_wishlist')); ?></span>
                                    </div>
                                </div>
                            </button>
                        </div>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    "use strict";
    productQuickViewFunctionalityInitialize();
</script>

<script type="text/javascript" async="async"
        src="https://platform-api.sharethis.com/js/sharethis.js#property=5f55f75bde227f0012147049&product=sticky-share-buttons"></script>

<?php /**PATH C:\Users\musas\Desktop\softwares\6valley\POSA-latest version\POSA\resources\themes\default/web-views/partials/_quick-view-data.blade.php ENDPATH**/ ?>