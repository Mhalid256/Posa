<?php if($web_config['brand_setting']): ?>
    <div class="product-type-physical-section search-product-attribute-container">
        <h6 class="font-semibold fs-13 mb-2"><?php echo e(translate('brands')); ?></h6>
        <div class="pb-2">
            <div class="input-group-overlay input-group-sm">
                <input placeholder="<?php echo e(translate('search_by_brands')); ?>"
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
            <?php $__currentLoopData = $productBrands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    if (isset($dataFrom) && $dataFrom == 'shop-view' && isset($shopSlug)) {
                        $brandRoute = route('shopView', ['id' => $shopSlug, 'brand_id' => $brand['id'],'data_from' => 'brand', 'offer_type' => ($data['offer_type'] ?? ''), 'page' => 1]);
                    } else if (isset($dataFrom) && $dataFrom == 'flash-deals') {
                        $brandRoute = route('flash-deals', ['id' => ($web_config['flash_deals']['id'] ?? 0), 'brand_id' => $brand['id'],'data_from'=>'brand', 'offer_type' => ($data['offer_type'] ?? ''), 'page' => 1]);
                    } else {
                        $brandRoute = route('products', ['brand_id' => $brand['id'], 'data_from'=>'brand', 'offer_type' => ($data['offer_type'] ?? ''), 'page' => 1]);
                    }
                ?>
                <ul class="brand mt-2 p-0 for-brand-hover <?php echo e(session('direction') === "rtl" ? 'mr-2' : ''); ?>" id="brand">
                    <li class="flex-between get-view-by-onclick cursor-pointer <?php echo e(request('brand_id') == $brand['id'] ? 'text-primary' : ''); ?>"
                        data-link="<?php echo e($brandRoute); ?>">
                        <div class="text-start">
                            <?php echo e($brand['name']); ?>

                        </div>
                        <div class="__brands-cate-badge">
                            <span>
                                <?php echo e($brand['brand_products_count']); ?>

                            </span>
                        </div>
                    </li>
                </ul>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>
<?php /**PATH C:\Users\musas\Desktop\softwares\6valley\POSA-latest version\POSA\resources\themes\default/web-views/products/partials/_filter-product-brands.blade.php ENDPATH**/ ?>