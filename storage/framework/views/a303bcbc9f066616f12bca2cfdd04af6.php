<?php $__env->startSection('title', translate($data['offer_type']).' '.translate('products')); ?>

<?php $__env->startPush('css_or_js'); ?>
    <meta property="og:image" content="<?php echo e($web_config['web_logo']['path']); ?>"/>
    <meta property="og:title" content="Products of <?php echo e($web_config['company_name']); ?> "/>
    <meta property="og:url" content="<?php echo e(env('APP_URL')); ?>">
    <meta property="og:description" content="<?php echo e($web_config['meta_description']); ?>">
    <meta property="twitter:card" content="<?php echo e($web_config['web_logo']['path']); ?>"/>
    <meta property="twitter:title" content="Products of <?php echo e($web_config['company_name']); ?>"/>
    <meta property="twitter:url" content="<?php echo e(env('APP_URL')); ?>">
    <meta property="twitter:description" content="<?php echo e($web_config['meta_description']); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container py-3" dir="<?php echo e(session('direction')); ?>">

        <form method="POST" action="<?php echo e(url()->current()); ?>" class="product-list-filter">
            <input hidden name="offer_type" value="<?php echo e($data['offer_type']); ?>">
            <input hidden name="data_from" value="<?php echo e(request('data_from')); ?>">
            <input hidden name="category_id" value="<?php echo e(request('category_id')); ?>">
            <input hidden name="brand_id" value="<?php echo e(request('brand_id')); ?>">

            <?php echo csrf_field(); ?>
            <?php echo $__env->make('web-views.products.partials._product-list-header', [
                    'pageTitleContent' => $pageTitleContent,
                    'pageProductsCount' => $products->total(),
                    'searchBarSection' => true,
                    'sortBySection' => true,
                    'showProductsFilter' => true,
            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <div class="py-3 mb-2 mb-md-4 rtl __inline-35" dir="<?php echo e(session('direction')); ?>">
                <div class="row">
                    <aside class="col-lg-3 hidden-xs col-md-3 col-sm-4 SearchParameters __search-sidebar" id="SearchParameters">
                        <div class="cz-sidebar __inline-35 p-4 overflow-hidden" id="shop-sidebar">
                            <div class="cz-sidebar-header p-0">
                                <button class="close ms-auto fs-18-mobile" type="button" data-dismiss="sidebar" aria-label="Close">
                                    <i class="tio-clear"></i>
                                </button>
                            </div>

                            <div class="pb-0 shop-sidebar-scroll">
                                <div class="d-flex gap-3 flex-column">
                                    <h5 class="fs-16 font-weight-bold m-0"><?php echo e(translate('Filter_By')); ?></h5>
                                    <hr>
                                    <?php echo $__env->make('web-views.products.partials._filter-product-type', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    <?php echo $__env->make('web-views.products.partials._filter-product-sort', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    <?php echo $__env->make('web-views.products.partials._filter-product-price', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    <?php echo $__env->make('web-views.products.partials._filter-product-categories', [
                                        'productCategories' => $categories,
                                        'dataFrom' => request('data_from'),
                                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    <?php echo $__env->make('web-views.products.partials._filter-product-brands', [
                                        'productBrands' => $activeBrands,
                                        'dataFrom' => request('data_from'),
                                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    <?php echo $__env->make('web-views.products.partials._filter-publishing-houses', [
                                        'productPublishingHouses' => $web_config['publishing_houses'],
                                        'dataFrom' => request('data_from'),
                                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    <?php echo $__env->make('web-views.products.partials._filter-product-authors', [
                                        'productAuthors' => $web_config['digital_product_authors'],
                                        'dataFrom' => request('data_from'),
                                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </div>
                            </div>

                        </div>
                        <div class="sidebar-overlay"></div>
                    </aside>

                    <section class="col-lg-9">
                        <div class="row" id="ajax-products-view">
                            <?php echo $__env->make('web-views.products._ajax-products', ['products' => $products], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    </section>
                </div>
            </div>

        </form>

    </div>

    <span id="products-search-data-backup"
          data-page="<?php echo e(request('page') ?? 1); ?>"
          data-url="<?php echo e(url()->current()); ?>"
          data-brand="<?php echo e($data['brand_id'] ?? ''); ?>"
          data-category="<?php echo e($data['category_id'] ?? ''); ?>"
          data-name="<?php echo e($data['name']); ?>"
          data-offer-type="<?php echo e($data['offer_type']); ?>"
          data-from="<?php echo e($data['data_from'] ?? $data['product_type']); ?>"
          data-sort="<?php echo e($data['sort_by']); ?>"
          data-product-type="<?php echo e($data['product_type']); ?>"
          data-min-price="<?php echo e($data['min_price']); ?>"
          data-max-price="<?php echo e($data['max_price']); ?>"
          data-message="<?php echo e(translate('items_found')); ?>"
          data-publishing-house-id="<?php echo e(request('publishing_house_id')); ?>"
          data-author-id="<?php echo e(request('author_id')); ?>"
          data-offer="<?php echo e(request('offer_type') ?? ''); ?>"
    ></span>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script src="<?php echo e(theme_asset(path: 'public/assets/front-end/js/product-list-filter.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.front-end.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\musas\Desktop\softwares\6valley\POSA-latest version\POSA\resources\themes\default/web-views/products/view.blade.php ENDPATH**/ ?>