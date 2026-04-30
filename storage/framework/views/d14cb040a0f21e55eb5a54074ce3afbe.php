<?php if($web_config['digital_product_setting'] && count($productPublishingHouses) > 0): ?>
    <div class="product-type-digital-section search-product-attribute-container">
        <h6 class="font-semibold fs-13 mb-2"><?php echo e(translate('Publishing_House')); ?></h6>
        <div class="pb-2">
            <div class="input-group-overlay input-group-sm">
                <input placeholder="<?php echo e(translate('search_by_name')); ?>"
                       class="__inline-38 cz-filter-search form-control form-control-sm appended-form-control search-product-attribute"
                       type="text">
                <div class="input-group-append-overlay">
                    <span class="input-group-text">
                        <i class="czi-search"></i>
                    </span>
                </div>
            </div>
        </div>

        <ul class="__brands-cate-wrap attribute-list" data-simplebar
            data-simplebar-auto-hide="false">
            <div class="no-data-found text-muted" style="display:none;"><?php echo e(translate('No_Data_Found')); ?></div>
            <?php $__currentLoopData = $productPublishingHouses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $publishingHouseItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    if (isset($dataFrom) && $dataFrom == 'shop-view' && isset($shopSlug)) {
                        $publishingHouseRoute = route('shopView', ['id' => $shopSlug, 'publishing_house_id' => $publishingHouseItem['id'], 'product_type'=> 'digital', 'offer_type' => ($data['offer_type'] ?? ''), 'page' => 1]);
                    } else if (isset($dataFrom) && $dataFrom == 'flash-deals') {
                        $publishingHouseRoute = route('flash-deals', ['id' => ($web_config['flash_deals']['id'] ?? 0), 'publishing_house_id' => $publishingHouseItem['id'], 'product_type'=> 'digital', 'offer_type' => ($data['offer_type'] ?? ''), 'page' => 1]);
                    } else {
                        $publishingHouseRoute = route('products', ['publishing_house_id' => $publishingHouseItem['id'], 'product_type' => 'digital', 'offer_type' => ($data['offer_type'] ?? ''), 'page' => 1]);
                    }
                ?>
                <ul class="brand mt-2 p-0 for-brand-hover <?php echo e(session('direction') === "rtl" ? 'mr-2' : ''); ?>" id="brand">
                    <li class="flex-between get-view-by-onclick cursor-pointer pe-2 <?php echo e(request('publishing_house_id') != '' && request('publishing_house_id') == $publishingHouseItem['id'] ? 'text-primary' : ''); ?>"
                        data-link="<?php echo e($publishingHouseRoute); ?>">
                        <div class="text-start">
                            <?php echo e($publishingHouseItem['name']); ?>

                        </div>
                        <div class="__brands-cate-badge">
                            <span>
                                <?php echo e($publishingHouseItem['publishing_house_products_count']); ?>

                            </span>
                        </div>
                    </li>
                </ul>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>
<?php /**PATH C:\Users\musas\Desktop\softwares\6valley\POSA-latest version\POSA\resources\themes\default/web-views/products/partials/_filter-publishing-houses.blade.php ENDPATH**/ ?>