<div class="search-page-header flex-wrap gap-3">
    <?php if(isset($shopViewPageHeader) && $shopViewPageHeader): ?>
        <div>
            <nav>
                <div class="nav nav-tabs mb-0" id="nav-tab" role="tablist">
                    <a class="nav-link <?php echo e(request('offer_type') != 'clearance_sale' ? 'active' : ''); ?>"
                       href="<?php echo e(route('shopView',['id' => ($shopInfoArray['id'] != 0 ? $shopInfoArray['id'] : 0)])); ?>">
                        <h3 class="widget-title align-self-center font-bold fs-16 text-capitalize my-0"><?php echo e(translate('all_product')); ?></h3>
                    </a>
                    <?php if($stockClearanceSetup && $stockClearanceProducts > 0): ?>
                        <a class="nav-link <?php echo e(request('offer_type') == 'clearance_sale' ? 'active' : ''); ?>"
                           href="<?php echo e(route('shopView',['id' => ($shopInfoArray['id'] != 0 ? $shopInfoArray['id'] : 0), 'offer_type' => 'clearance_sale'])); ?>">
                            <h3 class="widget-title align-self-center font-bold fs-16 text-capitalize my-0"><?php echo e(translate('clearance_sale')); ?></h3>
                        </a>
                    <?php endif; ?>
                </div>
            </nav>
        </div>
    <?php else: ?>
        <div>
            <?php if(isset($pageTitleContent) && $pageTitleContent): ?>
                <h5 class="font-semibold mb-1 text-capitalize">
                    <?php echo e($pageTitleContent); ?>

                </h5>
            <?php endif; ?>

            <div>
                <span class="view-page-item-count clearance-sale-count"><?php echo e($pageProductsCount); ?></span>
                <?php echo e(translate('items_found')); ?>

            </div>
        </div>
    <?php endif; ?>



    <div class="d-flex flex-wrap gap-3">
        <?php if(isset($searchBarSection) && $searchBarSection): ?>
            <?php if(!request()->has('global_search_input')): ?>
                <div class="d-flex align-items-center gap-2 position-relative">
                    <input class="form-control appended-form-control pe-5rem search-page-button-input" type="search" autocomplete="off"
                           placeholder="<?php echo e(translate('Search_for_items...')); ?>" name="product_name" value="<?php echo e(request('product_name')); ?>">
                    <button class="input-group-append-overlay search_button d-md-block search-page-button" data-name="name">
                    <span class="input-group-text">
                        <i class="czi-search text-white"></i>
                    </span>
                    </button>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <?php if(isset($sortBySection) && $sortBySection): ?>
        <div id="search-form" class="d-none d-lg-block">
            <div class="sorting-item">
                <?php echo $__env->make('web-views.partials._svg-icon-container', ['iconType' => 'sorting'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <label class="for-sorting" for="sorting"><?php echo e(translate('sort_by')); ?></label>

                <select class="product-list-filter-input" name="sort_by">
                    <option value="latest" <?php echo e(request('sort_by') == 'latest' ? 'selected':''); ?>>
                        <?php echo e(translate('Default')); ?>

                    </option>
                    <option value="low-high" <?php echo e(request('sort_by') == 'low-high' ? 'selected':''); ?>>
                        <?php echo e(translate('Price')); ?> (<?php echo e(translate('Low_to_High')); ?>)
                    </option>
                    <option value="high-low" <?php echo e(request('sort_by') == 'high-low' ? 'selected':''); ?>>
                        <?php echo e(translate('Price')); ?> (<?php echo e(translate('High_to_Low')); ?>)
                    </option>
                    <option value="rating-low-high" <?php echo e(request('sort_by') == 'rating-low-high' ? 'selected':''); ?>>
                        <?php echo e(translate('Rating')); ?> (<?php echo e(translate('Low_to_High')); ?>)
                    </option>
                    <option value="rating-high-low" <?php echo e(request('sort_by') == 'rating-high-low' ? 'selected':''); ?>>
                        <?php echo e(translate('Rating')); ?> (<?php echo e(translate('High_to_Low')); ?>)
                    </option>
                    <option value="a-z" <?php echo e(request('sort_by') == 'a-z' ? 'selected':''); ?>>
                        <?php echo e(translate('Alphabetical')); ?> (<?php echo e('A '.translate('to').' Z'); ?>)
                    </option>
                    <option value="z-a" <?php echo e(request('sort_by') == 'z-a' ? 'selected':''); ?>>
                        <?php echo e(translate('Alphabetical')); ?> (<?php echo e('Z '.translate('to').' A'); ?>)
                    </option>
                </select>
            </div>
        </div>
        <?php endif; ?>

        <?php if(isset($showProductsFilter) && $showProductsFilter): ?>
        <div class="d-none d-lg-block">
            <div class="sorting-item">
                <?php echo $__env->make('web-views.partials._svg-icon-container', ['iconType' => 'sorting'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <label class="for-sorting" for="sorting">
                    <span><?php echo e(translate('Filter_By')); ?></span>
                </label>
                <select class="product-list-filter-input" name="data_from">
                    <option value="default" <?php echo e($data['data_from'] == '' ? 'selected':''); ?>>
                        <?php echo e(translate('Default')); ?>

                    </option>
                    <option value="best-selling" <?php echo e($data['data_from']=='best-selling'?'selected':''); ?>>
                        <?php echo e(translate('Best_Selling')); ?>

                    </option>
                    <option value="top-rated" <?php echo e($data['data_from']=='top-rated'?'selected':''); ?>>
                        <?php echo e(translate('Top_Rated')); ?>

                    </option>
                    <option value="most-favorite" <?php echo e($data['data_from']=='most-favorite'?'selected':''); ?>>
                        <?php echo e(translate('Most_Favorite')); ?>

                    </option>
                </select>
            </div>
        </div>
        <?php endif; ?>

    </div>
    <div class="d-lg-none">
        <div class="filter-show-btn btn btn--primary py-1 px-2 m-0">
            <i class="tio-filter"></i>
        </div>
    </div>
</div>
<?php /**PATH C:\Users\musas\Desktop\softwares\6valley\POSA-latest version\POSA\resources\themes\default/web-views/products/partials/_product-list-header.blade.php ENDPATH**/ ?>