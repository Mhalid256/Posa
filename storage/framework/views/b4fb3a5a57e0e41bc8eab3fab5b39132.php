<div class="modal-body">
    <button class="radius-50 border-0 font-weight-bold text-black-50 position-absolute right-3 top-3 z-index-99" type="button" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <div class="row gy-3">
        <div class="col-md-5">
            <div class="d-flex align-items-center justify-content-center active">
                <img class="img-responsive w-100 rounded aspect-1"
                     src="<?php echo e(getStorageImages(path: $product->thumbnail_full_url, type: 'backend-product')); ?>"
                     data-zoom="<?php echo e(getStorageImages(path: $product->thumbnail_full_url, type: 'backend-product')); ?>"
                     alt="<?php echo e(translate('product_image')); ?>">
                <div class="cz-image-zoom-pane"></div>
            </div>

            <div class="d-flex flex-column gap-10 fz-14 mt-3">

                <div class="d-flex align-items-center gap-2">
                    <div class="font-weight-bold text-dark"><?php echo e(translate('SKU')); ?>:</div>
                    <div><?php echo e($product->code); ?></div>
                </div>

                <div class="d-flex align-items-center gap-2">
                    <div class="font-weight-bold text-dark"><?php echo e(translate('categories')); ?>: </div>
                    <div><?php echo e($product->category->name ?? translate('not_found')); ?></div>
                </div>

                <div class="d-flex align-items-center gap-2">
                    <div class="font-weight-bold text-dark"><?php echo e(translate('brand')); ?>:</div>
                    <div><?php echo e($product->brand->name ?? translate('not_found')); ?></div>
                </div>

                <?php if(count($product->tags) > 0): ?>
                    <div class="d-flex align-items-center gap-2 flex-wrap">
                        <div class="font-weight-bold text-dark"><?php echo e(translate('tag')); ?>:</div>
                        <?php $__currentLoopData = $product->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div><?php echo e($tag->tag); ?>,</div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-md-7">
            <div class="mt-3">
                <form id="add-to-cart-form" class="add-to-cart-details-form">
                    <?php echo csrf_field(); ?>

                    <div class="details">
                        <div class="d-flex flex-wrap gap-3 mb-3">
                            <div class="d-flex gap-2 align-items-center text-success rounded-pill bg-success-light px-2 py-1 stock-status-in-quick-view">
                                <i class="tio-checkmark-circle-outlined"></i>
                                <?php echo e(translate('in_stock')); ?>

                            </div>
                        </div>
                        <h2 class="mb-3 product-title"><?php echo e($product->name); ?></h2>

                        <?php if($product->reviews_count > 0): ?>
                            <div class="d-flex align-items-center gap-2 mb-3">
                                <i class="tio-star text-warning"></i>
                                <span class="text-muted text-capitalize">(<?php echo e($product->reviews_count.' '.translate('customer_review')); ?>)</span>
                            </div>
                        <?php endif; ?>

                        <div class="d-flex flex-wrap align-items-center gap-3 mb-2 text-dark">
                            <h2 class="c1 text-accent price-range-with-discount d-flex gap-2 align-items-center">
                                <span class="discounted-unit-price fs-24 font-bold">
                                    <?php echo e(getProductPriceByType(product: $product, type: 'discounted_unit_price', result: 'string')); ?>

                                </span>
                                <?php if(getProductPriceByType(product: $product, type: 'discount', result: 'value') > 0): ?>
                                    <del class="product-total-unit-price align-middle text-muted fs-18 font-semibold">
                                        <?php echo e(webCurrencyConverter(amount: $product->unit_price)); ?>

                                    </del>
                                <?php endif; ?>
                            </h2>
                        </div>
                    </div>

                    <?php
                    $cart = false;
                    if (session()->has('cart')) {
                        foreach (session()->get('cart') as $key => $cartItem) {
                            if (is_array($cartItem) && $cartItem['id'] == $product['id']) {
                                $cart = $cartItem;
                            }
                        }
                    }
                    ?>


                    <input type="hidden" name="id" value="<?php echo e($product->id); ?>">
                    <div class="variant-change">
                        <div class="position-relative mb-4">
                            <?php if(count(json_decode($product->colors)) > 0): ?>
                                <div class="d-flex flex-wrap gap-3 align-items-center">
                                    <strong class="text-dark"><?php echo e(translate('color')); ?></strong>

                                    <div class="color-select d-flex gap-2 flex-wrap" id="option1">
                                        <?php $__currentLoopData = json_decode($product->colors); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <input class="btn-check action-color-change" type="radio"
                                                   id="<?php echo e($product->id); ?>-color-<?php echo e($key); ?>"
                                                   name="color" value="<?php echo e($color); ?>"
                                                   <?php if($key == 0): ?> checked <?php endif; ?> autocomplete="off">
                                            <label id="label-<?php echo e($product->id); ?>-color-<?php echo e($key); ?>" class="color-ball mb-0 <?php echo e($key== 0 ?'border-add':""); ?>"
                                                   style="background: <?php echo e($color); ?>;" for="<?php echo e($product->id); ?>-color-<?php echo e($key); ?>"
                                                   data-toggle="tooltip">
                                                <i class="tio-done"></i>
                                            </label>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                        <?php $__currentLoopData = json_decode($product->choice_options); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $choice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="d-flex gap-3 flex-wrap align-items-center mb-3">
                                <div class="my-2 w-43px">
                                    <strong class="text-dark"><?php echo e(ucfirst($choice->title)); ?></strong>
                                </div>
                                <div class="d-flex gap-2 flex-wrap">
                                    <?php $__currentLoopData = $choice->options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <input class="btn-check" type="radio"
                                               id="<?php echo e($choice->name); ?>-<?php echo e($option); ?>"
                                               name="<?php echo e($choice->name); ?>" value="<?php echo e($option); ?>"
                                               <?php if($index == 0): ?> checked <?php endif; ?> autocomplete="off">
                                        <label class="btn btn-sm check-label border-0 mb-0 w-auto pos-check-label"
                                               for="<?php echo e($choice->name); ?>-<?php echo e($option); ?>"><?php echo e($option); ?></label>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <?php ($extensionIndex=0); ?>
                        <?php if($product['product_type'] == 'digital' && $product['digital_product_file_types'] && count($product['digital_product_file_types']) > 0 && $product['digital_product_extensions']): ?>
                            <?php $__currentLoopData = $product['digital_product_extensions']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $extensionKey => $extensionGroup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="d-flex gap-3 flex-wrap align-items-center mb-3">
                                    <div class="my-2">
                                        <strong class="text-dark"><?php echo e(translate($extensionKey)); ?> :</strong>
                                    </div>

                                    <?php if(count($extensionGroup) > 0): ?>
                                        <div class="d-flex gap-2 flex-wrap">
                                            <?php $__currentLoopData = $extensionGroup; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $extension): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <input class="btn-check" type="radio"
                                                       id="extension_<?php echo e(str_replace(' ', '-', $extension)); ?>"
                                                       name="variant_key" value="<?php echo e($extensionKey.'-'.preg_replace('/\s+/', '-', $extension)); ?>"
                                                       <?php echo e($extensionIndex == 0 ? 'checked' : ''); ?> autocomplete="off">
                                                <label class="btn btn-sm check-label border-0 mb-0 w-auto pos-check-label"
                                                       for="extension_<?php echo e(str_replace(' ', '-', $extension)); ?>">
                                                    <?php echo e($extension); ?>

                                                </label>
                                                <?php ($extensionIndex++); ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </div>
                    <div class="d-flex flex-wrap gap-2 position-relative price-section">
                        <div class="alert alert--message flex-row alert-dismissible fade show pos-alert-message gap-2 d-none" role="alert">
                            <img class="mb-1" src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/img/warning-icon.png')); ?>" alt="<?php echo e(translate('warning')); ?>">
                            <div class="w-0">
                                <h6><?php echo e(translate('warning')); ?></h6>
                                <div class="product-stock-message"></div>
                            </div>
                            <a href="javascript:" class="align-items-center close-alert-message" >
                                <i class="tio-clear"></i>
                            </a>
                        </div>
                        <div class="default-quantity-system d-none">
                            <div class="d-flex gap-2 align-items-center mt-3">
                                <strong class="text-dark"><?php echo e(translate('qty')); ?>:</strong>
                                <div class="product-quantity d-flex align-items-center">
                                    <div class="d-flex align-items-center">
                                    <span class="product-quantity-group">
                                        <button type="button" class="btn-number bg-transparent"
                                                data-type="minus" data-field="quantity"
                                                disabled="disabled">
                                                <i class="tio-remove"></i>
                                        </button>
                                        <input type="text" name="quantity"
                                               class="form-control input-number text-center cart-qty-field"
                                               placeholder="1" value="1" min="1" max="100">
                                        <button type="button" class="btn-number bg-transparent cart-qty-field-plus" data-type="plus"
                                                data-field="quantity">
                                                <i class="tio-add"></i>
                                        </button>
                                    </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="in-cart-quantity-system d--none">
                            <div class="d-flex gap-2 align-items-center mt-3">
                                <strong class="text-dark"><?php echo e(translate('qty')); ?>:</strong>
                                <div class="product-quantity d-flex align-items-center">
                                    <div class="d-flex align-items-center">
                                    <span class="product-quantity-group">
                                        <button type="button" class="btn-number bg-transparent in-cart-quantity-minus action-get-variant-for-already-in-cart" data-action="minus">
                                                <i class="tio-remove"></i>
                                        </button>
                                        <input type="text" name="quantity_in_cart"
                                               class="form-control text-center in-cart-quantity-field"
                                               placeholder="1" value="1" min="1" max="100">
                                        <button type="button" class="btn-number bg-transparent in-cart-quantity-plus action-get-variant-for-already-in-cart" data-action="plus">
                                                <i class="tio-add"></i>
                                        </button>
                                    </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex flex-column gap-1 mt-3 title-color">
                            <div class="product-description-label text-dark font-weight-bold"><?php echo e(translate('total_Price')); ?>:</div>
                            <div class="product-price c1">
                                <strong class="product-details-chosen-price-amount"></strong>
                                <span class="text-muted fs-10">
                                    ( <?php echo e(($product->tax_model == 'include' ? '':'+').' '.translate('tax')); ?> <span class="set-product-tax"></span>)</span>
                            </div>
                        </div>
                        <div class="align-self-center">
                            <?php if($product->discount > 0): ?>
                                <div class="d-flex gap-1 align-items-center text-primary rounded-pill bg-primary-light px-2 py-1">
                                    <?php if($product->discount_type === "percent"): ?>
                                        <?php echo e($product->discount.' % '.translate('OFF')); ?>

                                    <?php else: ?>
                                        <?php echo e(translate('save').' '.getCurrencySymbol()); ?><span class="set-discount-amount"></span>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center mt-3">
                        <button class="btn btn--primary btn-block quick-view-modal-add-cart-button action-add-to-cart" type="button">
                            <?php echo e(translate('add_to_cart')); ?>

                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\Users\musas\Desktop\softwares\6valley\POSA-latest version\POSA\resources\views/vendor-views/pos/partials/_quick-view.blade.php ENDPATH**/ ?>