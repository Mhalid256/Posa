<div>
    <h6 class="font-semibold fs-13 mb-3"><?php echo e(translate('categories')); ?></h6>
    <div class="accordion mt-n1 product-categories-list" id="shop-categories">
        <?php $__currentLoopData = $productCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $dropdownActive = false;
                if (in_array(request('sub_category_id'), $category?->childes?->pluck('id')?->toArray() ?? [])) {
                    $dropdownActive = true;
                }

                foreach($category->childes as $child) {
                    if (in_array(request('sub_sub_category_id'), $child?->childes?->pluck('id')?->toArray() ?? [])) {
                        $dropdownActive = true;
                    }
                }
            ?>

            <div class="menu--caret-accordion <?php echo e($dropdownActive ? 'open' : ''); ?>">
                <div class="card-header flex-between">
                    <?php
                        if (isset($dataFrom) && $dataFrom == 'shop-view' && isset($shopSlug)) {
                            $categoryRoute = route('shopView', ['id' => $shopSlug, 'category_id' => $category['id'],'data_from'=>'category', 'offer_type' => ($data['offer_type'] ?? ''), 'page' => 1]);
                        } else if (isset($dataFrom) && $dataFrom == 'flash-deals') {
                            $categoryRoute = route('flash-deals', ['id' => ($web_config['flash_deals']['id'] ?? 0), 'category_id' => $category['id'],'data_from'=>'category', 'offer_type' => ($data['offer_type'] ?? ''), 'page' => 1]);
                        } else {
                            $categoryRoute = route('products', ['category_id' => $category['id'],'data_from'=>'category', 'offer_type' => ($data['offer_type'] ?? ''), 'page' => 1]);
                        }
                    ?>
                    <div>
                        <label class="for-hover-label cursor-pointer get-view-by-onclick d-flex gap-10px align-items-center <?php echo e(request('category_id') == $category['id'] ? 'text-primary' : ''); ?>"
                               data-link="<?php echo e($categoryRoute); ?>">
                            <img width="20" class="aspect-1 rounded-circle object-cover" src="<?php echo e(getStorageImages(path: $category->icon_full_url, type: 'category')); ?>" alt="<?php echo e($category['name']); ?>">
                            <span class="line--limit-2">
                                <?php echo e($category['name']); ?>

                            </span>
                        </label>
                    </div>
                    <div class="px-2 cursor-pointer menu--caret">
                        <strong class="pull-right for-brand-hover">
                            <?php if($category->childes->count()>0): ?>
                                <i class="tio-next-ui fs-13"></i>
                            <?php endif; ?>
                        </strong>
                    </div>
                </div>
                <div class="card-body p-0 ms-2 <?php echo e($dropdownActive ? '' : 'd--none'); ?>"
                    id="collapse-<?php echo e($category['id']); ?>">
                    <?php $__currentLoopData = $category->childes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $dropdownActive = false;
                            if (in_array(request('sub_sub_category_id'), $child?->childes?->pluck('id')?->toArray() ?? [])) {
                                $dropdownActive = true;
                            }
                        ?>
                        <div class="menu--caret-accordion <?php echo e($dropdownActive ? 'open' : ''); ?>">
                            <div class="for-hover-label card-header flex-between">
                                <?php
                                    if (isset($dataFrom) && $dataFrom == 'shop-view' && isset($shopSlug)) {
                                        $subCategoryRoute = route('shopView', ['id' => $shopSlug, 'sub_category_id' => $child['id'],'data_from'=>'category', 'offer_type' => ($data['offer_type'] ?? ''), 'page' => 1]);
                                    } else if (isset($dataFrom) && $dataFrom == 'flash-deals') {
                                        $subCategoryRoute = route('flash-deals', ['id' => ($web_config['flash_deals']['id'] ?? 0), 'sub_category_id' => $child['id'],'data_from'=>'category', 'offer_type' => ($data['offer_type'] ?? ''), 'page' => 1]);
                                    } else {
                                        $subCategoryRoute = route('products', ['sub_category_id' => $child['id'],'data_from'=>'category', 'offer_type' => ($data['offer_type'] ?? ''), 'page' => 1]);
                                    }
                                ?>

                                <div>
                                    <label class="cursor-pointer get-view-by-onclick <?php echo e(request('sub_category_id') == $child['id'] ? 'text-primary' : ''); ?>"
                                           data-link="<?php echo e($subCategoryRoute); ?>">
                                        <?php echo e($child['name']); ?>

                                    </label>
                                </div>
                                <div class="px-2 cursor-pointer menu--caret">
                                    <strong class="pull-right">
                                        <?php if($child->childes->count()>0): ?>
                                            <i class="tio-next-ui fs-13"></i>
                                        <?php endif; ?>
                                    </strong>
                                </div>
                            </div>
                            <div
                                class="card-body p-0 ms-2 <?php echo e($dropdownActive ? '' : 'd--none'); ?>"
                                id="collapse-<?php echo e($child['id']); ?>">
                                <?php $__currentLoopData = $child->childes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subSubCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <?php
                                        if (isset($dataFrom) && $dataFrom == 'shop-view' && isset($shopSlug)) {
                                            $subSubCategoryRoute = route('shopView', ['id' => $shopSlug, 'sub_sub_category_id' => $subSubCategory['id'], 'data_from' => 'category', 'offer_type' => ($data['offer_type'] ?? ''), 'page' => 1]);
                                        } else if (isset($dataFrom) && $dataFrom == 'flash-deals') {
                                            $subSubCategoryRoute = route('flash-deals', ['id' => ($web_config['flash_deals']['id'] ?? 0), 'sub_sub_category_id' => $subSubCategory['id'], 'data_from' => 'category', 'offer_type' => ($data['offer_type'] ?? ''), 'page' => 1]);
                                        } else {
                                            $subSubCategoryRoute = route('products', ['sub_sub_category_id' => $subSubCategory['id'], 'data_from' => 'category', 'offer_type' => ($data['offer_type'] ?? ''), 'page' => 1]);
                                        }
                                    ?>

                                    <div class="card-header">
                                        <label
                                            class="for-hover-label d-block cursor-pointer text-left get-view-by-onclick <?php echo e(request('sub_sub_category_id') == $subSubCategory['id'] ? 'text-primary' : ''); ?>"
                                            data-link="<?php echo e($subSubCategoryRoute); ?>">
                                            <?php echo e($subSubCategory['name']); ?>

                                        </label>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php /**PATH C:\Users\musas\Desktop\softwares\6valley\POSA-latest version\POSA\resources\themes\default/web-views/products/partials/_filter-product-categories.blade.php ENDPATH**/ ?>