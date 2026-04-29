<?php
    use App\Utils\Helpers;
    use App\Enums\EmailTemplateKey;
    $eCommerceLogo = getWebConfig(name: 'company_web_logo');
?>

<aside class="js-aside aside d-none d-lg-block">
    <div class="aside-header d-flex align-items-center gap-2 justify-content-between">
        <a class="navbar-logo" href="<?php echo e(route('admin.dashboard.index')); ?>">
            <img height="24" src="<?php echo e(getStorageImages(path: $eCommerceLogo, type: 'backend-logo')); ?>"
                 alt="<?php echo e(translate('logo')); ?>">
        </a>
        <button type="button" class="js-aside-toggle navbar-aside-toggle btn-icon border-0">
            <i class="fi fi-rr-menu-burger"></i>
        </button>
    </div>
    <div class="aside-body search-aside-attribute-container py-4 pt-0">
        <div class="aside-search-form pt-lg-3 pb-3">
            <div class="input-group flex-nowrap">
                <input type="text" class="form-control search-aside-attribute"
                       placeholder="<?php echo e(translate('search_menu')); ?>">
                <span class="input-group-text"><i class="fi fi-rr-search"></i></span>
            </div>
        </div>

        <ul class="aside-nav navbar-nav gap-2">
            <li>
                <a class="nav-link <?php echo e(Request::is('admin/dashboard') ? 'active' : ''); ?>"
                   title="<?php echo e(translate('dashboard')); ?>" href="<?php echo e(route('admin.dashboard.index')); ?>">
                    <i class="fi fi-sr-home"></i>
                    <span class="aside-mini-hidden-element text-truncate">
                        <?php echo e(translate('dashboard')); ?>

                    </span>
                </a>
            </li>
            <?php if(Helpers::module_permission_check('pos_management')): ?>
                <li>
                    <a class="nav-link <?php echo e(Request::is('admin/pos*') ? 'active' : ''); ?>" title="<?php echo e(translate('POS')); ?>"
                       href="<?php echo e(route('admin.pos.index')); ?>">
                        <i class="fi fi-sr-point-of-sale-bill"></i>
                        <span class="aside-mini-hidden-element text-truncate"><?php echo e(translate('POS')); ?></span>
                    </a>
                </li>
            <?php endif; ?>
            <?php if(Helpers::module_permission_check('order_management')): ?>
                <li class="nav-item nav-item_title <?php echo e(Request::is('admin/orders*')?((Request::is('admin/orders/details/*') && request()->has('vendor-order-list')) ? '' : 'scroll-here'):''); ?>">
                    <small class="nav-subtitle" title=""><?php echo e(translate('order_management')); ?></small>
                </li>
                <li class="<?php echo e(Request::is('admin/orders*') ? 'sub-menu-opened' : ''); ?>">
                    <a class="nav-link nav-link-toggle <?php echo e(Request::is('admin/orders*')?((Request::is('admin/orders/details/*') && request()->has('vendor-order-list')) ? '' : 'active'):''); ?>"
                       href="javascript:" title="<?php echo e(translate('orders')); ?>">
                        <i class="fi fi-sr-shopping-cart"></i>
                        <span
                            class="aside-mini-hidden-element flex-grow-1 d-flex justify-content-between align-items-center">
                            <span class="text-truncate max-w-180"><?php echo e(translate('orders')); ?></span>
                            <i class="fi fi-sr-angle-down"></i>
                        </span>
                    </a>
                    <ul class="aside-submenu navbar-nav">
                        <li class="nav-item px-3 py-2 fw-semibold text-dark bg-section2 aside-mini-show-element"><?php echo e(translate('orders')); ?></li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(Request::is('admin/orders/list/all') ? 'active' : ''); ?>"
                               href="<?php echo e(route('admin.orders.list',['all'])); ?>" title="<?php echo e(translate('all')); ?>">
                                <span class="flex-grow-1 text-truncate">
                                    <?php echo e(translate('all')); ?>

                                </span>
                                <span class="badge fw-bold badge-info badge-sm text-bg-info">
                                    <?php echo e(\App\Models\Order::count()); ?>

                                </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(Request::is('admin/orders/list/pending') ? 'active' : ''); ?>"
                               href="<?php echo e(route('admin.orders.list',['pending'])); ?>" title="<?php echo e(translate('pending')); ?>">
                                <span class="flex-grow-1 text-truncate">
                                    <?php echo e(translate('pending')); ?>

                                </span>
                                <span class="badge fw-bold badge-info badge-sm text-bg-info">
                                    <?php echo e(\App\Models\Order::where(['order_status'=>'pending'])->count()); ?>

                                </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(Request::is('admin/orders/list/confirmed') ? 'active' : ''); ?>"
                               href="<?php echo e(route('admin.orders.list',['confirmed'])); ?>"
                               title="<?php echo e(translate('confirmed')); ?>">
                                <span class="flex-grow-1 text-truncate">
                                    <?php echo e(translate('confirmed')); ?>

                                </span>
                                <span class="badge fw-bold badge-success badge-sm text-bg-success">
                                    <?php echo e(\App\Models\Order::where(['order_status'=>'confirmed'])->count()); ?>

                                </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(Request::is('admin/orders/list/processing') ? 'active' : ''); ?>"
                               href="<?php echo e(route('admin.orders.list',['processing'])); ?>"
                               title="<?php echo e(translate('packaging')); ?>">
                                <span class="flex-grow-1 text-truncate">
                                    <?php echo e(translate('packaging')); ?>

                                </span>
                                <span class="badge fw-bold badge-warning badge-sm text-bg-warning">
                                    <?php echo e(\App\Models\Order::where(['order_status'=>'processing'])->count()); ?>

                                </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(Request::is('admin/orders/list/out_for_delivery') ? 'active' : ''); ?>"
                               href="<?php echo e(route('admin.orders.list',['out_for_delivery'])); ?>"
                               title="<?php echo e(translate('out_for_delivery')); ?>">
                                <span class="flex-grow-1 text-truncate">
                                    <?php echo e(translate('out_for_delivery')); ?>

                                </span>
                                <span class="badge fw-bold badge-warning badge-sm text-bg-warning">
                                    <?php echo e(\App\Models\Order::where(['order_status'=>'out_for_delivery'])->count()); ?>

                                </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(Request::is('admin/orders/list/delivered') ? 'active' : ''); ?>"
                               href="<?php echo e(route('admin.orders.list',['delivered'])); ?>"
                               title="<?php echo e(translate('delivered')); ?>">
                                <span class="flex-grow-1 text-truncate">
                                    <?php echo e(translate('delivered')); ?>

                                </span>
                                <span class="badge fw-bold badge-success badge-sm text-bg-success">
                                    <?php echo e(\App\Models\Order::where(['order_status'=>'delivered'])->count()); ?>

                                </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(Request::is('admin/orders/list/returned') ? 'active' : ''); ?>"
                               href="<?php echo e(route('admin.orders.list',['returned'])); ?>" title="<?php echo e(translate('returned')); ?>">
                                <span class="flex-grow-1 text-truncate">
                                    <?php echo e(translate('returned')); ?>

                                </span>
                                <span class="badge fw-bold badge-danger badge-sm text-bg-danger">
                                    <?php echo e(\App\Models\Order::where('order_status','returned')->count()); ?>

                                </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(Request::is('admin/orders/list/failed') ? 'active' : ''); ?>"
                               href="<?php echo e(route('admin.orders.list',['failed'])); ?>" title="<?php echo e(translate('failed')); ?>">
                                <span class="flex-grow-1 text-truncate">
                                    <?php echo e(translate('failed_to_Deliver')); ?>

                                </span>
                                <span class="badge fw-bold badge-danger badge-sm text-bg-danger">
                                    <?php echo e(\App\Models\Order::where(['order_status'=>'failed'])->count()); ?>

                                </span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link <?php echo e(Request::is('admin/orders/list/canceled') ? 'active' : ''); ?>"
                               href="<?php echo e(route('admin.orders.list',['canceled'])); ?>" title="<?php echo e(translate('canceled')); ?>">
                                <span class="flex-grow-1 text-truncate">
                                    <?php echo e(translate('canceled')); ?>

                                </span>
                                <span class="badge fw-bold badge-danger badge-sm text-bg-danger">
                                    <?php echo e(\App\Models\Order::where(['order_status'=>'canceled'])->count()); ?>

                                </span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="<?php echo e(Request::is('admin/refund-section/*') ? 'sub-menu-opened' : ''); ?>">
                    <a class="nav-link nav-link-toggle <?php echo e(Request::is('admin/refund-section/refund/*') ? 'active' : ''); ?>"
                       href="javascript:" title="<?php echo e(translate('refund_Requests')); ?>">
                        <i class="fi fi-sr-refund-alt"></i>
                        <span
                            class="aside-mini-hidden-element flex-grow-1 d-flex justify-content-between align-items-center">
                            <span class="text-truncate max-w-180">
                                <?php echo e(translate('refund_Requests')); ?>

                            </span>
                            <i class="fi fi-sr-angle-down"></i>
                        </span>
                    </a>
                    <ul class="aside-submenu navbar-nav">
                        <li class="nav-item px-3 py-2 fw-semibold text-dark bg-section2 aside-mini-show-element"><?php echo e(translate('refund_Requests')); ?></li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(Request::is('admin/refund-section/refund/list/pending') ? 'active' : ''); ?>"
                               href="<?php echo e(route('admin.refund-section.refund.list',['pending'])); ?>"
                               title="<?php echo e(translate('pending')); ?>">
                                <span class="flex-grow-1 text-truncate">
                                    <?php echo e(translate('pending')); ?>

                                </span>
                                <span class="badge fw-bold badge-danger badge-sm text-bg-danger">
                                    <?php echo e(\App\Models\RefundRequest::where('status','pending')->count()); ?>

                                </span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link <?php echo e(Request::is('admin/refund-section/refund/list/approved') ? 'active' : ''); ?>"
                               href="<?php echo e(route('admin.refund-section.refund.list',['approved'])); ?>"
                               title="<?php echo e(translate('approved')); ?>">
                                <span class="flex-grow-1 text-truncate">
                                    <?php echo e(translate('approved')); ?>

                                </span>
                                <span class="badge fw-bold badge-info badge-sm text-bg-info">
                                    <?php echo e(\App\Models\RefundRequest::where('status','approved')->count()); ?>

                                </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(Request::is('admin/refund-section/refund/list/refunded') ? 'active' : ''); ?>"
                               href="<?php echo e(route('admin.refund-section.refund.list',['refunded'])); ?>"
                               title="<?php echo e(translate('refunded')); ?>">
                                <span class="flex-grow-1 text-truncate">
                                    <?php echo e(translate('refunded')); ?>

                                </span>
                                <span class="badge fw-bold badge-success badge-sm text-bg-success">
                                    <?php echo e(\App\Models\RefundRequest::where('status','refunded')->count()); ?>

                                </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(Request::is('admin/refund-section/refund/list/rejected') ? 'active' : ''); ?>"
                               href="<?php echo e(route('admin.refund-section.refund.list',['rejected'])); ?>"
                               title="<?php echo e(translate('rejected')); ?>">
                                <span class="flex-grow-1 text-truncate">
                                    <?php echo e(translate('rejected')); ?>

                                </span>
                                <span class="badge fw-bold badge-danger badge-sm text-bg-danger">
                                    <?php echo e(\App\Models\RefundRequest::where('status','rejected')->count()); ?>

                                </span>
                            </a>
                        </li>
                    </ul>
                </li>
            <?php endif; ?>
            <?php if(Helpers::module_permission_check('product_management')): ?>
                <li class="nav-item nav-item_title <?php echo e((Request::is('admin/brand*') || Request::is('admin/category*') || Request::is('admin/sub*') || Request::is('admin/attribute*') || Request::is('admin/products*')) ? 'scroll-here' : ''); ?>">
                    <small class="nav-subtitle" title=""><?php echo e(translate('product_management')); ?></small>
                </li>
                <li class="<?php echo e((Request::is('admin/category*') || Request::is('admin/sub-category*') || Request::is('admin/sub-sub-category*'))  ? 'sub-menu-opened' : ''); ?>">
                    <a class="nav-link nav-link-toggle <?php echo e((Request::is('admin/category*') || Request::is('admin/sub-category*') || Request::is('admin/sub-sub-category*')) ? 'active' : ''); ?>"
                       href="javascript:" title="<?php echo e(translate('category_Setup')); ?>">
                        <i class="fi fi-sr-apps"></i>
                        <span
                            class="aside-mini-hidden-element flex-grow-1 d-flex justify-content-between align-items-center">
                            <span class="text-truncate max-w-180">
                                <?php echo e(translate('category_Setup')); ?>

                            </span>
                            <i class="fi fi-sr-angle-down"></i>
                        </span>
                    </a>
                    <ul class="aside-submenu navbar-nav">
                        <li class="nav-item px-3 py-2 fw-semibold text-dark bg-section2 aside-mini-show-element"><?php echo e(translate('category_Setup')); ?></li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(Request::is('admin/category/*') ? 'active' : ''); ?>"
                               href="<?php echo e(route('admin.category.view')); ?>" title="<?php echo e(translate('categories')); ?>">
                                <span class="text-truncate"><?php echo e(translate('categories')); ?></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(Request::is('admin/sub-category/*') ? 'active' : ''); ?>"
                               href="<?php echo e(route('admin.sub-category.view')); ?>" title="<?php echo e(translate('sub_Categories')); ?>">
                                <span class="text-truncate"><?php echo e(translate('sub_Categories')); ?></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(Request::is('admin/sub-sub-category/*') ? 'active' : ''); ?>"
                               href="<?php echo e(route('admin.sub-sub-category.view')); ?>"
                               title="<?php echo e(translate('sub_Sub_Categories')); ?>">
                                <span class="text-truncate"><?php echo e(translate('sub_Sub_Categories')); ?></span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="<?php echo e(Request::is('admin/brand*') ? 'sub-menu-opened' : ''); ?>">
                    <a class="nav-link nav-link-toggle  <?php echo e(Request::is('admin/brand*') ? 'active' : ''); ?>"
                       href="javascript:"
                       title="<?php echo e(translate('brands')); ?>">
                        <i class="fi fi-sr-brand"></i>
                        <span
                            class="aside-mini-hidden-element flex-grow-1 d-flex justify-content-between align-items-center">
                            <span class="text-truncate max-w-180">
                                <?php echo e(translate('brands')); ?>

                            </span>
                            <i class="fi fi-sr-angle-down"></i>
                        </span>
                    </a>
                    <ul class="aside-submenu navbar-nav">
                        <li class="nav-item px-3 py-2 fw-semibold text-dark bg-section2 aside-mini-show-element"><?php echo e(translate('brands')); ?></li>
                        <li class="nav-item" title="<?php echo e(translate('add_new')); ?>">
                            <a class="nav-link <?php echo e(Request::is('admin/brand/add-new') ? 'active' : ''); ?>"
                               href="<?php echo e(route('admin.brand.add-new')); ?>">
                                <span class="text-truncate"><?php echo e(translate('add_new')); ?></span>
                            </a>
                        </li>
                        <li class="nav-item" title="<?php echo e(translate('list')); ?>">
                            <a class="nav-link <?php echo e(Request::is('admin/brand/list') ? 'active' : ''); ?>"
                               href="<?php echo e(route('admin.brand.list')); ?>">
                                <span class="text-truncate"><?php echo e(translate('list')); ?></span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a class="nav-link <?php echo e(Request::is('admin/attribute*') ? 'active' : ''); ?>"
                       href="<?php echo e(route('admin.attribute.view')); ?>" title="<?php echo e(translate('product_Attribute_Setup')); ?>">
                        <i class="fi fi-sr-sitemap"></i>
                        <span
                            class="aside-mini-hidden-element flex-grow-1 d-flex justify-content-between align-items-center text-truncate max-w-180">
                            <?php echo e(translate('product_Attribute_Setup')); ?>

                        </span>
                    </a>
                </li>
                <li class="<?php echo e((Request::is('admin/products/list/in-house') || Request::is('admin/products/bulk-import') || Request::is('admin/products/request-restock-list')  || (Request::is('admin/products/add')) || (Request::is('admin/products/view/in-house/*')) || (Request::is('admin/products/barcode/*'))|| (Request::is('admin/products/update/*') && request()->has('product-gallery'))) ? 'sub-menu-opened' : ''); ?>">
                    <a class="nav-link nav-link-toggle <?php echo e((Request::is('admin/products/list/in-house') || Request::is('admin/products/bulk-import') || Request::is('admin/products/request-restock-list')  || (Request::is('admin/products/add')) || (Request::is('admin/products/view/in-house/*')) || (Request::is('admin/products/barcode/*'))|| (Request::is('admin/products/update/*') && request()->has('product-gallery'))) ? 'active' : ''); ?>"
                       href="javascript:" title="<?php echo e(translate('In_House_Products')); ?>">
                        <i class="fi fi-sr-box-open"></i>
                        <span
                            class="aside-mini-hidden-element flex-grow-1 d-flex justify-content-between align-items-center">
                            <span class="text-truncate max-w-180">
                                <?php echo e(translate('In_House_Products')); ?>

                            </span>
                            <i class="fi fi-sr-angle-down"></i>
                        </span>
                    </a>
                    <ul class="aside-submenu navbar-nav">
                        <li class="nav-item px-3 py-2 fw-semibold text-dark bg-section2 aside-mini-show-element"><?php echo e(translate('In_House_Products')); ?></li>
                        <li class="nav-item ">
                            <a class="nav-link <?php echo e((Request::is('admin/products/list/in-house') || (Request::is('admin/products/view/in-house/*')) || (Request::is('admin/products/stock-limit-list/in-house')) || (Request::is('admin/products/barcode/*'))) ? 'active' : ''); ?>"
                               href="<?php echo e(route('admin.products.list', ['in-house'])); ?>"
                               title="<?php echo e(translate('Product_List')); ?>">
                                <span class="flex-grow-1 text-truncate">
                                    <?php echo e(translate('Product_List')); ?>

                                </span>
                                <span class="badge fw-bold badge-success badge-sm text-bg-success">
                                    <?php echo e(getAdminProductsCount('all')); ?>

                                </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(Request::is('admin/products/add') || (Request::is('admin/products/update/*') && request()->has('product-gallery')) ? 'active' : ''); ?>"
                               href="<?php echo e(route('admin.products.add')); ?>" title="<?php echo e(translate('add_New_Product')); ?>">
                                <span class="text-truncate"><?php echo e(translate('add_New_Product')); ?></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(Request::is('admin/products/bulk-import') ? 'active' : ''); ?>"
                               href="<?php echo e(route('admin.products.bulk-import')); ?>" title="<?php echo e(translate('bulk_import')); ?>">
                                <span class="text-truncate"><?php echo e(translate('bulk_import')); ?></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(Request::is('admin/products/request-restock-list') ? 'active' : ''); ?>"
                               href="<?php echo e(route('admin.products.request-restock-list')); ?>"
                               title="<?php echo e(translate('Request_Restock_List')); ?>">
                                <span class="text-truncate"><?php echo e(translate('Request_Restock_List')); ?></span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="<?php echo e(Request::is('admin/products/list/vendor*')||(Request::is('admin/products/view/vendor/*'))||Request::is('admin/products/updated-product-list') ? 'sub-menu-opened' : ''); ?>">
                    <a class="nav-link nav-link-toggle <?php echo e(Request::is('admin/products/list/vendor*')||(Request::is('admin/products/view/vendor/*'))||Request::is('admin/products/updated-product-list') ? 'active' : ''); ?>"
                       href="javascript:" title="<?php echo e(translate('vendor_Products')); ?>">
                        <i class="fi fi-sr-seller"></i>
                        <span
                            class="aside-mini-hidden-element flex-grow-1 d-flex justify-content-between align-items-center">
                            <span class="text-truncate max-w-180">
                                <?php echo e(translate('vendor_Products')); ?>

                            </span>
                            <i class="fi fi-sr-angle-down"></i>
                        </span>
                    </a>
                    <ul class="aside-submenu navbar-nav">
                        <li class="nav-item px-3 py-2 fw-semibold text-dark bg-section2 aside-mini-show-element"><?php echo e(translate('vendor_Products')); ?></li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(str_contains(url()->current().'?request_status='.request()->get('request_status'),'admin/products/list/vendor?request_status=0') == 1 ? 'active' : ''); ?>"
                               title="<?php echo e(translate('new_Products_Requests')); ?>"
                               href="<?php echo e(route('admin.products.list',['vendor', 'request_status'=>'0'])); ?>">
                                <span class="flex-grow-1 text-truncate">
                                    <?php echo e(Str::limit(translate('new_Products_Requests'), 18, '...')); ?>

                                </span>
                                <span class="badge fw-bold badge-danger badge-sm text-bg-danger">
                                    <?php echo e(getVendorProductsCount('new-product')); ?>

                                </span>
                            </a>
                        </li>
                        <?php if(getWebConfig(name: 'product_wise_shipping_cost_approval')==1): ?>
                            <li class="nav-item">
                                <a class="nav-link text-capitalize <?php echo e(Request::is('admin/products/updated-product-list') ? 'active' : ''); ?>"
                                   title="<?php echo e(translate('product_update_requests')); ?>"
                                   href="<?php echo e(route('admin.products.updated-product-list')); ?>">
                                    <span class="flex-grow-1 text-truncate">
                                        <?php echo e(Str::limit(translate('product_update_requests'), 18, '...')); ?>

                                    </span>
                                    <span class="badge fw-bold badge-info badge-sm text-bg-info">
                                        <?php echo e(getVendorProductsCount('product-updated-request')); ?>

                                    </span>
                                </a>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(str_contains(url()->current().'?request_status='.request()->get('request_status'),'/admin/products/list/vendor?request_status=1')==1? 'active' : ''); ?>"
                               title="<?php echo e(translate('approved_Products')); ?>"
                               href="<?php echo e(route('admin.products.list',['vendor', 'request_status'=>'1'])); ?>">
                                <span class="flex-grow-1 text-truncate">
                                    <?php echo e(translate('approved_Products')); ?>

                                </span>
                                <span class="badge fw-bold badge-success badge-sm text-bg-success">
                                    <?php echo e(getVendorProductsCount('approved')); ?>

                                </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(str_contains(url()->current().'?request_status='.request()->get('request_status'),'/admin/products/list/vendor?request_status=2')==1? 'active' : ''); ?>"
                               title="<?php echo e(translate('denied_Products')); ?>"
                               href="<?php echo e(route('admin.products.list',['vendor', 'request_status'=>'2'])); ?>">
                                <span class="flex-grow-1 text-truncate">
                                    <?php echo e(translate('denied_Products')); ?>

                                </span>
                                <span class="badge fw-bold badge-danger badge-sm text-bg-danger">
                                    <?php echo e(getVendorProductsCount('denied')); ?>

                                </span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="nav-link <?php echo e(Request::is('admin/products/product-gallery') ? 'active' : ''); ?>"
                       href="<?php echo e(route('admin.products.product-gallery')); ?>" title="<?php echo e(translate('product_gallery')); ?>">
                        <i class="fi fi-sr-boxes"></i>
                        <span class="aside-mini-hidden-element text-truncate">
                            <?php echo e(translate('product_gallery')); ?>

                        </span>
                    </a>
                </li>
            <?php endif; ?>

            <?php if(Helpers::module_permission_check('promotion_management')): ?>
                <li class="nav-item nav-item_title <?php echo e((Request::is('admin/banner*') || (Request::is('admin/coupon*')) || (Request::is('admin/notification*')) || (Request::is('admin/deal*'))) ? 'scroll-here' : ''); ?>">
                    <small class="nav-subtitle" title=""><?php echo e(translate('promotion_management')); ?></small>
                </li>
                <li>
                    <a class="nav-link <?php echo e(Request::is('admin/banner*') ? 'active' : ''); ?>"
                       href="<?php echo e(route('admin.banner.list')); ?>" title="<?php echo e(translate('banner_Setup')); ?>">
                        <i class="fi fi-sr-pennant"></i>
                        <span class="aside-mini-hidden-element text-truncate flex-grow-1">
                            <?php echo e(translate('banner_Setup')); ?>

                        </span>
                    </a>
                </li>

                <li class="<?php echo e((Request::is('admin/coupon*') || Request::is('admin/deal*')) ? 'sub-menu-opened' : ''); ?>">
                    <a class="nav-link nav-link-toggle <?php echo e((Request::is('admin/coupon*') || Request::is('admin/deal*')) ? 'active' : ''); ?>"
                       href="javascript:" title="<?php echo e(translate('offers_&_Deals')); ?>">
                        <i class="fi fi-sr-badge-percent"></i>
                        <span
                            class="aside-mini-hidden-element flex-grow-1 d-flex justify-content-between align-items-center">
                            <span class="text-truncate max-w-180">
                                <?php echo e(translate('offers_&_Deals')); ?>

                            </span>
                            <i class="fi fi-sr-angle-down"></i>
                        </span>
                    </a>
                    <ul class="aside-submenu navbar-nav">
                        <li class="nav-item px-3 py-2 fw-semibold text-dark bg-section2 aside-mini-show-element"><?php echo e(translate('offers_&_Deals')); ?></li>
                        <li>
                            <a class="nav-link <?php echo e(Request::is('admin/coupon*') ? 'active' : ''); ?>"
                               href="<?php echo e(route('admin.coupon.add')); ?>" title="<?php echo e(translate('coupon')); ?>">
                                <span class="text-truncate"><?php echo e(translate('coupon')); ?></span>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link <?php echo e((Request::is('admin/deal/flash') || (Request::is('admin/deal/update*'))) ? 'active' : ''); ?>"
                               href="<?php echo e(route('admin.deal.flash')); ?>" title="<?php echo e(translate('flash_Deals')); ?>">
                                <span class="text-truncate"><?php echo e(translate('flash_Deals')); ?></span>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link <?php echo e((Request::is('admin/deal/day') || (Request::is('admin/deal/day-update*'))) ? 'active' : ''); ?>"
                               href="<?php echo e(route('admin.deal.day')); ?>" title="<?php echo e(translate('deal_of_the_day')); ?>">
                                <span class="text-truncate">
                                    <?php echo e(translate('deal_of_the_day')); ?>

                                </span>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link <?php echo e((Request::is('admin/deal/feature') || Request::is('admin/deal/feature-update*')) ? 'active' : ''); ?>"
                               href="<?php echo e(route('admin.deal.feature')); ?>" title="<?php echo e(translate('featured_Deal')); ?>">
                                <span class="text-truncate">
                                    <?php echo e(translate('featured_Deal')); ?>

                                </span>
                            </a>
                        </li>

                        <li>
                            <a class="nav-link <?php echo e(Request::is('admin/deal/clearance-sale') || Request::is('admin/deal/clearance-sale*') ? 'active' : ''); ?>"
                               href="<?php echo e(route('admin.deal.clearance-sale.index')); ?>"
                               title="<?php echo e(translate('Clearance_Sale')); ?>">
                                <span class="text-truncate">
                                    <?php echo e(translate('Clearance_Sale')); ?>

                                </span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="<?php echo e(Request::is('admin/notification*') || Request::is('admin/push-notification/index*') ? 'sub-menu-opened' : ''); ?>">
                    <a class="nav-link nav-link-toggle <?php echo e(Request::is('admin/notification*') || Request::is('admin/push-notification/index*') ? 'active' : ''); ?>"
                       href="javascript:" title="<?php echo e(translate('notifications')); ?>">
                        <i class="fi fi-sr-paper-plane"></i>
                        <span
                            class="aside-mini-hidden-element flex-grow-1 d-flex justify-content-between align-items-center">
                            <span class="text-truncate max-w-180">
                                <?php echo e(translate('notifications')); ?>

                            </span>
                            <i class="fi fi-sr-angle-down"></i>
                        </span>
                    </a>
                    <ul class="aside-submenu navbar-nav">
                        <li class="nav-item px-3 py-2 fw-semibold text-dark bg-section2 aside-mini-show-element"><?php echo e(translate('notifications')); ?></li>
                        <li>
                            <a class="nav-link <?php echo e(!Request::is('admin/notification/push') && Request::is('admin/notification/*') ? 'active' : ''); ?>"
                               href="<?php echo e(route('admin.notification.index')); ?>"
                               title="<?php echo e(translate('send_notification')); ?>">
                                <span class="text-truncate text-capitalize">
                                    <?php echo e(translate('send_notification')); ?>

                                </span>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link text-capitalize <?php echo e(Request::is('admin/push-notification/index*') ? 'active' : ''); ?>"
                               href="<?php echo e(route('admin.push-notification.index')); ?>"
                               title="<?php echo e(translate('push_notifications_setup')); ?>">
                                <span class="text-truncate text-capitalize">
                                    <?php echo e(translate('push_notifications_setup')); ?>

                                </span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="<?php echo e(Request::is('admin/business-settings/announcement*') ? 'sub-menu-opened' : ''); ?>">
                    <a class="nav-link nav-link-toggle <?php echo e(Request::is('admin/business-settings/announcement*') ? 'active' : ''); ?>"
                       href="<?php echo e(route('admin.business-settings.announcement')); ?>"
                       title="<?php echo e(translate('announcement')); ?>">
                        <i class="fi fi-sr-megaphone-sound-waves"></i>
                        <span class="aside-mini-hidden-element text-truncate max-w-180"> <?php echo e(translate('announcement')); ?> </span>
                    </a>
                </li>
            <?php endif; ?>

            <?php ($getEnabledThemeRoutes=0); ?>
            <?php if(count(config('get_theme_routes')) > 0): ?>
                <?php $__currentLoopData = config('get_theme_routes')['route_list']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $route): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(isset($route['module_permission']) && Helpers::module_permission_check($route['module_permission'])): ?>
                        <?php ($getEnabledThemeRoutes++); ?>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>

            <?php if($getEnabledThemeRoutes > 0): ?>
                <?php if(count(config('get_theme_routes')) > 0): ?>
                    <li class="nav-item nav-item_title <?php echo e((Request::is('admin/banner*') || (Request::is('admin/coupon*')) || (Request::is('admin/notification*')) || (Request::is('admin/deal*'))) ? 'scroll-here' : ''); ?>">
                        <small class="nav-subtitle" title="">
                            <?php echo e(config('get_theme_routes')['name']); ?> <?php echo e(translate('Menu')); ?>

                        </small>
                    </li>
                    <?php $__currentLoopData = config('get_theme_routes')['route_list']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $route): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(isset($route['module_permission']) && Helpers::module_permission_check($route['module_permission'])): ?>
                            <li class="<?php echo e((Request::is($route['path']) || Request::is($route['path'].'*')) ? 'active' : ''); ?> <?php $__currentLoopData = $route['route_list']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub_route): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php echo e((Request::is($sub_route['path']) || Request::is($sub_route['path'].'*')) ? 'active' : ''); ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>">
                                <a class="nav-link <?php echo e(count($route['route_list']) > 0 ? 'nav-link-toggle':''); ?>"
                                   href="<?php echo e(count($route['route_list']) > 0 ? 'javascript:':$route['url']); ?>"
                                   title="<?php echo e(translate($route['name'])); ?>">
                                    <?php echo $route['icon']; ?>

                                    <span
                                        class="aside-mini-hidden-element text-truncate"><?php echo e(translate($route['name'])); ?></span>
                                </a>

                                <?php if(count($route['route_list']) > 0): ?>
                                    <ul class="aside-submenu navbar-nav">
                                        <li class="nav-item px-3 py-2 fw-semibold text-dark bg-section2 aside-mini-show-element"><?php echo e(translate('system_settings')); ?></li>
                                        <?php $__currentLoopData = $route['route_list']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub_route): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li class="<?php echo e((Request::is($sub_route['path']) || Request::is($sub_route['path'].'*')) ? 'active' : ''); ?>">
                                                <a class="nav-link" href="<?php echo e($sub_route['url']); ?>"
                                                   title="<?php echo e(translate($sub_route['name'])); ?>">
                                                    <span
                                                        class="text-truncate"><?php echo e(translate($sub_route['name'])); ?></span>
                                                </a>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                <?php endif; ?>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            <?php endif; ?>

            <?php if(Helpers::module_permission_check('support_section')): ?>
                <li class="nav-item nav-item_title <?php echo e((Request::is('admin/support-ticket*') || Request::is('admin/contact*')) ? 'scroll-here' : ''); ?>">
                    <small class="nav-subtitle" title=""><?php echo e(translate('help_&_support')); ?></small>
                </li>
                <li>
                    <a class="nav-link <?php echo e(Request::is('admin/messages*') ? 'active' : ''); ?>"
                       title="<?php echo e(translate('inbox')); ?>"
                       href="<?php echo e(route('admin.messages.index', ['type' => 'customer'])); ?>">
                        <i class="fi fi-sr-envelope"></i>
                        <span class="aside-mini-hidden-element text-truncate">
                            <?php echo e(translate('inbox')); ?>

                        </span>
                    </a>
                </li>
                <li>
                    <a class="nav-link <?php echo e(Request::is('admin/contact*') ? 'active' : ''); ?>"
                       href="<?php echo e(route('admin.contact.list')); ?>" title="<?php echo e(translate('messages')); ?>">
                        <i class="fi fi-sr-comment-alt-dots"></i>
                        <span class="aside-mini-hidden-element text-truncate">
                            <span class="position-relative">
                                <?php echo e(translate('messages')); ?>

                                <?php ($message=\App\Models\Contact::where('seen',0)->count()); ?>
                                <?php if($message!=0): ?>
                                    <span
                                        class="btn-status btn-xs-status btn-status-danger position-absolute top-0 menu-status"></span>
                                <?php endif; ?>
                            </span>
                        </span>
                    </a>
                </li>
                <li>
                    <a class="nav-link <?php echo e(Request::is('admin/support-ticket*') ? 'active' : ''); ?>"
                       href="<?php echo e(route('admin.support-ticket.view')); ?>" title="<?php echo e(translate('support_Ticket')); ?>">
                        <i class="fi fi-sr-headphones"></i>
                        <span class="aside-mini-hidden-element text-truncate">
                            <span class="position-relative">
                                <?php echo e(translate('support_Ticket')); ?>

                                <?php if(\App\Models\SupportTicket::where('status','open')->count()>0): ?>
                                    <span
                                        class="btn-status btn-xs-status btn-status-danger position-absolute top-0 menu-status"></span>
                                <?php endif; ?>
                            </span>
                        </span>
                    </a>
                </li>
            <?php endif; ?>

            <?php if(Helpers::module_permission_check('report')): ?>
                <li class="nav-item nav-item_title <?php echo e((Request::is('admin/report/earning') || Request::is('admin/report/inhouse-product-sale') || Request::is('admin/report/vendor-report') || Request::is('admin/report/earning') || Request::is('admin/transaction/list') || Request::is('admin/refund-section/refund-list') || Request::is('admin/stock/product-in-wishlist') || Request::is('admin/reviews*') || Request::is('admin/stock/product-stock') || Request::is('admin/transaction/wallet-bonus') || Request::is('admin/report/order')) ? 'scroll-here' : ''); ?>">
                    <small class="nav-subtitle" title="">
                        <?php echo e(translate('reports_&_Analysis')); ?>

                    </small>
                </li>

                <li class="<?php echo e((Request::is('admin/report/admin-earning') || Request::is('admin/report/vendor-earning') || Request::is('admin/report/inhouse-product-sale') || Request::is('admin/report/vendor-report') || Request::is('admin/report/earning') || Request::is('admin/transaction/order-transaction-list') || Request::is('admin/transaction/expense-transaction-list') || Request::is('admin/report/transaction/'.App\Enums\ViewPaths\Admin\RefundTransaction::INDEX[URI]) || Request::is('admin/transaction/wallet-bonus')) ? 'sub-menu-opened' : ''); ?>">
                    <a class="nav-link nav-link-toggle <?php echo e((Request::is('admin/report/admin-earning') || Request::is('admin/report/vendor-earning') || Request::is('admin/report/inhouse-product-sale') || Request::is('admin/report/vendor-report') || Request::is('admin/report/earning') || Request::is('admin/transaction/order-transaction-list') || Request::is('admin/transaction/expense-transaction-list') || Request::is('admin/report/transaction/'.App\Enums\ViewPaths\Admin\RefundTransaction::INDEX[URI]) || Request::is('admin/transaction/wallet-bonus')) ? 'active' : ''); ?>"
                       href="javascript:" title="<?php echo e(translate('sales_&_Transaction_Report')); ?>">
                        <i class="fi fi-sr-stats"></i>
                        <span
                            class="aside-mini-hidden-element flex-grow-1 d-flex justify-content-between align-items-center">
                            <span class="text-truncate max-w-180">
                                <?php echo e(translate('sales_&_Transaction_Report')); ?>

                            </span>
                            <i class="fi fi-sr-angle-down"></i>
                        </span>
                    </a>
                    <ul class="aside-submenu navbar-nav">
                        <li class="nav-item px-3 py-2 fw-semibold text-dark bg-section2 aside-mini-show-element"><?php echo e(translate('sales_&_Transaction_Report')); ?></li>
                        <li>
                            <a class="nav-link <?php echo e((Request::is('admin/report/admin-earning') || Request::is('admin/report/vendor-earning')) ? 'active' : ''); ?>"
                               href="<?php echo e(route('admin.report.admin-earning')); ?>"
                               title="<?php echo e(translate('Earning_Reports')); ?>">
                                <span class="text-truncate">
                                    <?php echo e(translate('Earning_Reports')); ?>

                                </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(Request::is('admin/report/inhouse-product-sale') ? 'active' : ''); ?>"
                               href="<?php echo e(route('admin.report.inhouse-product-sale')); ?>"
                               title="<?php echo e(translate('inhouse_Sales')); ?>">
                                <span class="text-truncate">
                                    <?php echo e(translate('inhouse_Sales')); ?>

                                </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(Request::is('admin/report/vendor-report') ? 'active' : ''); ?>"
                               href="<?php echo e(route('admin.report.vendor-report')); ?>" title="<?php echo e(translate('vendor_Sales')); ?>">
                                <span class="text-truncate text-capitalize">
                                    <?php echo e(translate('vendor_Sales')); ?>

                                </span>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link <?php echo e((Request::is('admin/transaction/order-transaction-list') || Request::is('admin/transaction/expense-transaction-list') || Request::is('admin/transaction/refund-transaction-list') || Request::is('admin/report/transaction/'.App\Enums\ViewPaths\Admin\RefundTransaction::INDEX[URI]) || Request::is('admin/transaction/wallet-bonus')) ? 'active' : ''); ?>"
                               href="<?php echo e(route('admin.transaction.order-transaction-list')); ?>"
                               title="<?php echo e(translate('transaction_Report')); ?>">
                                <span class="text-truncate">
                                    <?php echo e(translate('transaction_Report')); ?>

                                </span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a class="nav-link <?php echo e((Request::is('admin/report/all-product') || Request::is('admin/stock/product-in-wishlist') || Request::is('admin/stock/product-stock')) ? 'active' : ''); ?>"
                       href="<?php echo e(route('admin.report.all-product')); ?>" title="<?php echo e(translate('product_Report')); ?>">
                        <i class="fi fi-sr-stats"></i>
                        <span class="aside-mini-hidden-element text-truncate">
                            <span class="position-relative">
                                <?php echo e(translate('product_Report')); ?>

                            </span>
                        </span>
                    </a>
                </li>

                <li>
                    <a class="nav-link <?php echo e(Request::is('admin/report/order') ? 'active' : ''); ?>"
                       href="<?php echo e(route('admin.report.order')); ?>" title="<?php echo e(translate('order_Report')); ?>">
                        <i class="fi fi-sr-rectangle-list"></i>
                        <span class="aside-mini-hidden-element text-truncate">
                            <?php echo e(translate('order_Report')); ?>

                        </span>
                    </a>
                </li>
            <?php endif; ?>

            <?php if(Helpers::module_permission_check('blog_management')): ?>
                <?php if(Route::has('admin.blog.view')): ?>
                    <li class="nav-item nav-item_title <?php echo e(Request::is('admin/blog*') ? 'scroll-here' : ''); ?>">
                        <small class="nav-subtitle" title="">
                            <?php echo e(translate('Blog_management')); ?>

                        </small>
                    </li>

                    <li class="<?php echo e(Request::is('admin/blog/*') ? 'sub-menu-opened' : ''); ?>">
                        <a class="nav-link nav-link-toggle <?php echo e(Request::is('admin/blog*') ? 'active' : ''); ?>"
                           href="javascript:" title="<?php echo e(translate('blog')); ?>">
                            <i class="fi fi-sr-layout-fluid"></i>
                            <span
                                class="aside-mini-hidden-element flex-grow-1 d-flex justify-content-between align-items-center">
                                <span class="text-truncate max-w-180">
                                    <?php echo e(translate('blog')); ?>

                                </span>
                                <i class="fi fi-sr-angle-down"></i>
                            </span>
                        </a>
                        <ul class="aside-submenu navbar-nav">
                            <li class="nav-item px-3 py-2 fw-semibold text-dark bg-section2 aside-mini-show-element"><?php echo e(translate('blog')); ?></li>
                            <li class="nav-item" title="<?php echo e(translate('add_new')); ?>">
                                <a class="nav-link <?php echo e(Request::is('admin/blog/add') ? 'active' : ''); ?>"
                                   href="<?php echo e(route('admin.blog.add')); ?>">
                                    <span class="text-truncate"><?php echo e(translate('add_new')); ?></span>
                                </a>
                            </li>
                            <li class="nav-item "
                                title="<?php echo e(translate('list')); ?>">
                                <a class="nav-link <?php echo e(Request::is('admin/blog/view') || Request::is('admin/blog/app-download-setup') || Request::is('admin/blog/priority-setup')  ? 'active' : ''); ?>"
                                   href="<?php echo e(route('admin.blog.view')); ?>">
                                    <span class="text-truncate"><?php echo e(translate('list')); ?></span>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>
            <?php endif; ?>

            <?php if(Helpers::module_permission_check('user_section')): ?>
                <li class="nav-item nav-item_title <?php echo e((Request::is('admin/customer/list') || Request::is('admin/customer/view*') || Request::is('admin/customer/subscriber-list')||Request::is('admin/vendors/add') || Request::is('admin/vendors/list') || Request::is('admin/delivery-man*')) ? 'scroll-here' : ''); ?>">
                    <small class="nav-subtitle" title=""><?php echo e(translate('user_management')); ?></small>
                </li>

                <li class="<?php echo e((Request::is('admin/customer/wallet*') || Request::is('admin/customer/list') || Request::is('admin/customer/view*') || Request::is('admin/reviews*') || Request::is('admin/customer/loyalty/report')) ? 'sub-menu-opened' : ''); ?>">
                    <a class="nav-link nav-link-toggle <?php echo e((Request::is('admin/customer/wallet*') || Request::is('admin/customer/list') || Request::is('admin/customer/view*') || Request::is('admin/reviews*') || Request::is('admin/customer/loyalty/report')) ? 'active' : ''); ?>"
                       href="javascript:" title="<?php echo e(translate('customers')); ?>">
                        <i class="fi fi-sr-user"></i>
                        <span
                            class="aside-mini-hidden-element flex-grow-1 d-flex justify-content-between align-items-center">
                            <span class="text-truncate max-w-180">
                               <?php echo e(translate('customers')); ?>

                            </span>
                            <i class="fi fi-sr-angle-down"></i>
                        </span>
                    </a>
                    <ul class="aside-submenu navbar-nav">
                        <li class="nav-item px-3 py-2 fw-semibold text-dark bg-section2 aside-mini-show-element"><?php echo e(translate('customers')); ?></li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(Request::is('admin/customer/list') || Request::is('admin/customer/view*') ? 'active' : ''); ?>"
                               href="<?php echo e(route('admin.customer.list')); ?>" title="<?php echo e(translate('Customer_List')); ?>">
                                <span class="text-truncate"><?php echo e(translate('customer_List')); ?> </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(Request::is('admin/reviews*') ? 'active' : ''); ?>"
                               href="<?php echo e(route('admin.reviews.list')); ?>" title="<?php echo e(translate('customer_Reviews')); ?>">
                                <span class="text-truncate">
                                    <?php echo e(translate('customer_Reviews')); ?>

                                </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(Request::is('admin/customer/wallet/report') ? 'active' : ''); ?>"
                               title="<?php echo e(translate('wallet')); ?>" href="<?php echo e(route('admin.customer.wallet.report')); ?>">
                                <span class="text-truncate">
                                    <?php echo e(translate('wallet')); ?>

                                </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(Request::is('admin/customer/wallet/bonus-setup') ? 'active' : ''); ?>"
                               title="<?php echo e(translate('wallet_Bonus_Setup')); ?>"
                               href="<?php echo e(route('admin.customer.wallet.bonus-setup')); ?>">
                                <span class="text-truncate">
                                    <?php echo e(translate('wallet_Bonus_Setup')); ?>

                                </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(Request::is('admin/customer/loyalty/report') ? 'active' : ''); ?>"
                               title="<?php echo e(translate('loyalty_Points')); ?>"
                               href="<?php echo e(route('admin.customer.loyalty.report')); ?>">
                                <span class="text-truncate">
                                    <?php echo e(translate('loyalty_Points')); ?>

                                </span>
                            </a>
                        </li>


                        <li class="navbar-vertical-aside-has-menu <?php echo e(Request::is('admin/vendors/subscription*') ? 'active' : ''); ?>">
                       <a class="nav-link" href="<?php echo e(route('admin.vendors.subscription.index')); ?>"
                          title="<?php echo e(translate('vendor_subscriptions')); ?>">
                           <i class="fi fi-sr-credit-card nav-icon"></i>
                           <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                               <?php echo e(translate('vendor_subscriptions')); ?>

                           </span>
                       </a>
                   </li>



                    </ul>
                </li>

                <li class="<?php echo e(Request::is('admin/vendors*') || Request::is('admin/vendors/withdraw-method/*') || (Request::is('admin/orders/details/*') && request()->has('vendor-order-list')) ? 'sub-menu-opened' : ''); ?>">
                    <a class="nav-link nav-link-toggle <?php echo e(Request::is('admin/vendors*') || Request::is('admin/vendors/withdraw-method/*') || (Request::is('admin/orders/details/*') && request()->has('vendor-order-list')) ? 'active' : ''); ?>"
                       href="javascript:" title="<?php echo e(translate('vendors')); ?>">
                        <i class="fi fi-sr-seller"></i>
                        <span
                            class="aside-mini-hidden-element flex-grow-1 d-flex justify-content-between align-items-center">
                            <span class="text-truncate max-w-180">
                                <?php echo e(translate('vendors')); ?>

                            </span>
                            <i class="fi fi-sr-angle-down"></i>
                        </span>
                    </a>
                    <ul class="aside-submenu navbar-nav">
                        <li class="nav-item px-3 py-2 fw-semibold text-dark bg-section2 aside-mini-show-element"><?php echo e(translate('vendors')); ?></li>
                        <li class="nav-item ">
                            <a class="nav-link <?php echo e(Request::is('admin/vendors/add') ? 'active' : ''); ?>"
                               title="<?php echo e(translate('add_New_Vendor')); ?>"
                               href="<?php echo e(route('admin.vendors.add')); ?>">
                                <span class="text-truncate">
                                    <?php echo e(translate('add_New_Vendor')); ?>

                                </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(Request::is('admin/vendors/list') ||Request::is('admin/vendors/view*') ? 'active' : ''); ?>"
                               title="<?php echo e(translate('vendor_List')); ?>" href="<?php echo e(route('admin.vendors.vendor-list')); ?>">
                                <span class="text-truncate">
                                    <?php echo e(translate('vendor_List')); ?>

                                </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(Request::is('admin/vendors/withdraw-list')|| Request::is('admin/vendors/withdraw-view/*') ? 'active' : ''); ?>"
                               href="<?php echo e(route('admin.vendors.withdraw_list')); ?>" title="<?php echo e(translate('withdraws')); ?>">
                                <span class="text-truncate"><?php echo e(translate('withdraws')); ?></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e((Request::is('admin/vendors/withdraw-method/*')) ? 'active' : ''); ?>"
                               href="<?php echo e(route('admin.vendors.withdraw-method.list')); ?>"
                               title="<?php echo e(translate('withdrawal_Methods')); ?>">
                                <span class="text-truncate"><?php echo e(translate('withdrawal_Methods')); ?></span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="<?php echo e(Request::is('admin/delivery-man*') ? 'sub-menu-opened' : ''); ?>">
                    <a class="nav-link nav-link-toggle text-capitalize <?php echo e(Request::is('admin/delivery-man*') ? 'active' : ''); ?>"
                       href="javascript:"
                       title="<?php echo e(translate('delivery_men')); ?>">
                        <i class="fi fi-sr-person-carry-box"></i>
                        <span
                            class="aside-mini-hidden-element flex-grow-1 d-flex justify-content-between align-items-center">
                            <span class="text-truncate max-w-180">
                                <?php echo e(translate('delivery_men')); ?>

                            </span>
                            <i class="fi fi-sr-angle-down"></i>
                        </span>
                    </a>
                    <ul class="aside-submenu navbar-nav">
                        <li class="nav-item px-3 py-2 fw-semibold text-dark bg-section2 aside-mini-show-element"><?php echo e(translate('delivery_men')); ?></li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(Request::is('admin/delivery-man/add') ? 'active' : ''); ?>"
                               href="<?php echo e(route('admin.delivery-man.add')); ?>" title="<?php echo e(translate('add_new')); ?>">
                                <span class="text-truncate"><?php echo e(translate('add_new')); ?></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(Request::is('admin/delivery-man/list') || Request::is('admin/delivery-man/update*')  || Request::is('admin/delivery-man/earning-statement-overview*') || Request::is('admin/delivery-man/order-history-log*') || Request::is('admin/delivery-man/order-wise-earning*') ? 'active' : ''); ?>"
                               href="<?php echo e(route('admin.delivery-man.list')); ?>"
                               title="<?php echo e(translate('list')); ?>">
                                <span class="text-truncate"><?php echo e(translate('list')); ?></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(Request::is('admin/delivery-man/withdraw-list') || Request::is('admin/delivery-man/withdraw-view*') ? 'active' : ''); ?>"
                               href="<?php echo e(route('admin.delivery-man.withdraw-list')); ?>"
                               title="<?php echo e(translate('withdraws')); ?>">
                                <span class="text-truncate"><?php echo e(translate('withdraws')); ?></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link  <?php echo e(Request::is('admin/delivery-man/emergency-contact') ? 'active' : ''); ?>"
                               href="<?php echo e(route('admin.delivery-man.emergency-contact.index')); ?>"
                               title="<?php echo e(translate('emergency_contact')); ?>">
                                <span class="text-truncate"><?php echo e(translate('Emergency_Contact')); ?></span>
                            </a>
                        </li>
                    </ul>
                </li>

                <?php if(auth('admin')->user()->admin_role_id==1): ?>
                    <li class=" <?php echo e((Request::is('admin/employee*') || Request::is('admin/custom-role*')) ? 'sub-menu-opened' : ''); ?>">
                        <a class="nav-link nav-link-toggle <?php echo e((Request::is('admin/employee*') || Request::is('admin/custom-role*')) ? 'active' : ''); ?>"
                           href="javascript:" title="<?php echo e(translate('employees')); ?>">
                            <i class="fi fi-sr-employee-man-alt"></i>
                            <span
                                class="aside-mini-hidden-element flex-grow-1 d-flex justify-content-between align-items-center">
                                <span class="text-truncate max-w-180">
                                    <?php echo e(translate('employees')); ?>

                                </span>
                                <i class="fi fi-sr-angle-down"></i>
                            </span>
                        </a>
                        <ul class="aside-submenu navbar-nav">
                            <li class="nav-item px-3 py-2 fw-semibold text-dark bg-section2 aside-mini-show-element"><?php echo e(translate('employees')); ?></li>
                            <li class="nav-item">
                                <a class="nav-link <?php echo e(Request::is('admin/custom-role*') ? 'active' : ''); ?>"
                                   href="<?php echo e(route('admin.custom-role.create')); ?>"
                                   title="<?php echo e(translate('employee_Role_Setup')); ?>">
                                    <span class="text-truncate"><?php echo e(translate('employee_Role_Setup')); ?></span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php echo e((Request::is('admin/employee/list') || Request::is('admin/employee/add') || Request::is('admin/employee/update*')) ? 'active' : ''); ?>"
                                   href="<?php echo e(route('admin.employee.list')); ?>" title="<?php echo e(translate('employees')); ?>">
                                    <span class="text-truncate"><?php echo e(translate('employees')); ?></span>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>

                <li>
                    <a class="nav-link <?php echo e(Request::is('admin/customer/subscriber-list') ? 'active' : ''); ?>"
                       href="<?php echo e(route('admin.customer.subscriber-list')); ?>" title="<?php echo e(translate('subscribers')); ?>">
                        <i class="fi fi-sr-user"></i>
                        <span class="aside-mini-hidden-element text-truncate flex-grow-1">
                            <?php echo e(translate('subscribers')); ?>

                        </span>
                    </a>
                </li>
            <?php endif; ?>

            <?php if(Helpers::module_permission_check('business_settings')): ?>
                <li class="nav-item nav-item_title">
                    <small class="nav-subtitle" title="">
                        <?php echo e(translate('Business_Settings')); ?>

                    </small>
                </li>

                <li>
                    <a class="nav-link <?php echo e((Request::is('admin/business-settings/web-config') ||
                                Request::is('admin/business-settings/web-config/refund-setup') ||
                                Request::is('admin/business-settings/website-setup') ||
                                Request::is('admin/product-settings')||
                                Request::is('admin/business-settings/payment-method/payment-option') ||
                                Request::is('admin/business-settings/vendor-settings') ||
                                Request::is('admin/customer/customer-settings') ||
                                Request::is('admin/business-settings/delivery-man-settings') ||
                                Request::is('admin/business-settings/shipping-method/update'.'*') ||
                                Request::is('admin/business-settings/shipping-method/index') ||
                                Request::is('admin/business-settings/order-settings/index') ||
                                Request::is('admin/business-settings/invoice-settings') ||
                                Request::is('admin/business-settings/delivery-restriction')) ? 'active' : ''); ?>"
                       href="<?php echo e(route('admin.business-settings.web-config.index')); ?>"
                       title="<?php echo e(translate('Business_Setup')); ?>">
                        <i class="fi fi-sr-settings"></i>
                        <span class="aside-mini-hidden-element text-truncate flex-grow-1">
                            <?php echo e(translate('Business_Setup')); ?>

                        </span>
                    </a>
                </li>

                <li>
                    <a class="nav-link <?php echo e(Request::is('admin/business-settings/inhouse-shop') ? 'active' : ''); ?>"
                       href="<?php echo e(route('admin.business-settings.inhouse-shop')); ?>"
                       title="<?php echo e(translate('Inhouse_Shop')); ?>">
                        <i class="fi fi-sr-shop"></i>
                        <span class="aside-mini-hidden-element text-truncate flex-grow-1">
                            <?php echo e(translate('Inhouse_Shop')); ?>

                        </span>
                    </a>
                </li>

                <li>
                    <a class="nav-link <?php echo e((Request::is('admin/seo-settings/web-master-tool') ||
                            Request::is('admin/seo-settings/robot-txt') ||
                            Request::is('admin/seo-settings/sitemap') ||
                            Request::is('admin/seo-settings/robots-meta-content*') ||
                            Request::is('admin/seo-settings/error-logs/index')) ? 'active' : ''); ?>"
                       href="<?php echo e(route('admin.seo-settings.web-master-tool')); ?>" title="<?php echo e(translate('SEO_Settings')); ?>">
                        <i class="fi fi-sr-analyse"></i>
                        <span class="aside-mini-hidden-element text-truncate flex-grow-1">
                            <?php echo e(translate('SEO_Settings')); ?>

                        </span>
                    </a>
                </li>

                <li>
                    <a class="nav-link <?php echo e(Request::is('admin/business-settings/priority-setup') ? 'active' : ''); ?>"
                       href="<?php echo e(route('admin.business-settings.priority-setup.index')); ?>"
                       title="<?php echo e(translate('Priority_Setup')); ?>">
                        <i class="fi fi-sr-list-timeline"></i>
                        <span class="aside-mini-hidden-element text-truncate flex-grow-1">
                            <?php echo e(translate('Priority_Setup')); ?>

                        </span>
                    </a>
                </li>

                <li class="<?php echo e(Request::is('admin/pages-and-media*') || Request::is('admin/pages-and-media/social-media') ? 'sub-menu-opened' : ''); ?>">
                    <a class="nav-link nav-link-toggle <?php echo e(Request::is('admin/pages-and-media*') || Request::is('admin/pages-and-media/social-media') || Request::is('admin/helpTopic/*') ? 'active' : ''); ?>"
                       href="javascript:" title="<?php echo e(translate('Pages_&_Media')); ?>">
                        <i class="fi fi-sr-document"></i>
                        <span
                            class="aside-mini-hidden-element flex-grow-1 d-flex justify-content-between align-items-center">
                            <span class="text-truncate max-w-180">
                                <?php echo e(translate('Pages_&_Media')); ?>

                            </span>
                            <i class="fi fi-sr-angle-down"></i>
                        </span>
                    </a>
                    <ul class="aside-submenu navbar-nav">
                        <li class="nav-item px-3 py-2 fw-semibold text-dark bg-section2 aside-mini-show-element"><?php echo e(translate('pages_&_Media')); ?></li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e((
                            Request::is('admin/pages-and-media/list') ||
                            Request::is('admin/pages-and-media/page*') ||
                            Request::is('admin/pages-and-media/privacy-policy') ||
                            Request::is('admin/pages-and-media/about-us') ||
                            Request::is('admin/helpTopic/index') ||
                            Request::is('admin/pages-and-media/features-section') ||
                            Request::is('admin/pages-and-media/company-reliability')) ? 'active' : ''); ?>"
                               href="<?php echo e(route('admin.pages-and-media.list')); ?>"
                               title="<?php echo e(translate('business_Pages')); ?>">
                                <span class="text-truncate">
                                    <?php echo e(translate('business_Pages')); ?>

                                </span>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link <?php echo e(Request::is('admin/pages-and-media/social-media') ? 'active' : ''); ?>"
                               href="<?php echo e(route('admin.pages-and-media.social-media')); ?>"
                               title="<?php echo e(translate('social_Media_Links')); ?>">
                                <span class="text-truncate">
                                    <?php echo e(translate('social_Media_Links')); ?>

                                </span>
                            </a>
                        </li>


                        <li>
                            <a class="nav-link <?php echo e(Request::is('admin/pages-and-media/vendor-registration-settings/*') ? 'active' : ''); ?>"
                               href="<?php echo e(route('admin.pages-and-media.vendor-registration-settings.index')); ?>"
                               title="<?php echo e(translate('vendor_Registration')); ?>">
                                <span class="text-truncate">
                                    <?php echo e(translate('vendor_Registration')); ?>

                                </span>
                            </a>
                        </li>
                    </ul>
                </li>
            <?php endif; ?>

            <?php if(Helpers::module_permission_check('system_settings')): ?>
                <li class="nav-item nav-item_title">
                    <small class="nav-subtitle" title="">
                        <?php echo e(translate('System_Settings')); ?>

                    </small>
                </li>

                <li>
                    <a class="nav-link
                <?php echo e((Request::is('admin/system-setup/environment-setup') ||
                    Request::is('admin/system-setup/app-settings') ||
                    Request::is('admin/system-setup/sitemap') ||
                    Request::is('admin/system-setup/currency/view') ||
                    Request::is('admin/system-setup/web-config/db-index') ||
                    Request::is('admin/system-setup/language*') ||
                    Request::is('admin/system-setup/software-update') ||
                    Request::is('admin/system-setup/cookie-settings') ||
                    Request::is('admin/system-setup/web-config/app-settings') ||
                    Request::is('admin/system-setup/invoice-settings/') ||
                    Request::is('admin/business-settings/delivery-restriction')) ||
                    Request::is('admin/system-setup/db-index') ? 'active' : ''); ?>"
                       href="<?php echo e(route('admin.system-setup.environment-setup')); ?>"
                       title="<?php echo e(translate('System_Setup')); ?>">
                        <i class="fi fi-sr-customize"></i>
                        <span class="aside-mini-hidden-element text-truncate flex-grow-1">
                            <?php echo e(translate('System_Setup')); ?>

                        </span>
                    </a>
                </li>

                <li>
                    <a class="nav-link
                <?php echo e(Request::is('admin/system-setup/login-settings/login-url-setup')  ||
                    Request::is('admin/system-setup/login-settings/customer-login-setup') ||
                    Request::is('admin/system-setup/login-settings/otp-setup') ? 'active' : ''); ?>"
                       href="<?php echo e(route('admin.system-setup.login-settings.customer-login-setup')); ?>"
                       title="<?php echo e(translate('Login_Settings')); ?>">
                        <i class="fi fi-sr-user-skill-gear"></i>
                        <span class="aside-mini-hidden-element text-truncate flex-grow-1">
                        <?php echo e(translate('Login_Settings')); ?>

                    </span>
                    </a>
                </li>

                <li>
                    <a class="nav-link <?php echo e(Request::is('admin/system-setup/email-templates/*') ? 'active' : ''); ?>"
                       href="<?php echo e(route('admin.system-setup.email-templates.view', ['admin', EmailTemplateKey::ADMIN_EMAIL_LIST[0]])); ?>"
                       title="<?php echo e(translate('Email_Template')); ?>">
                        <i class="fi fi-sr-template"></i>
                        <span class="aside-mini-hidden-element text-truncate flex-grow-1">
                            <?php echo e(translate('Email_Template')); ?>

                        </span>
                    </a>
                </li>

                <li>
                    <a class="nav-link <?php echo e(Request::is('admin/system-setup/file-manager*') ? 'active' : ''); ?>"
                       href="<?php echo e(route('admin.system-setup.file-manager.index')); ?>" title="<?php echo e(translate('Gallery')); ?>">
                        <i class="fi fi-sr-copy-image"></i>
                        <span class="aside-mini-hidden-element text-truncate flex-grow-1">
                            <?php echo e(translate('Gallery')); ?>

                        </span>
                    </a>
                </li>
            <?php endif; ?>

            <?php if(Helpers::module_permission_check('3rd_party_setup')): ?>
                <li class="nav-item nav-item_title">
                    <small class="nav-subtitle" title="">
                        <?php echo e(translate('3rd_Party_Setup')); ?>

                    </small>
                </li>

                <li>
                    <a class="nav-link
                <?php echo e(Request::is('admin/third-party/payment-method') ||
                Request::is('admin/third-party/offline-payment-method/index')||
                Request::is('admin/third-party/offline-payment-method*') ? 'active' : ''); ?>"
                       href="<?php echo e(route('admin.third-party.payment-method.index')); ?>"
                       title="<?php echo e(translate('Payment_Methods')); ?>">
                        <i class="fi fi-sr-credit-card"></i>
                        <span class="aside-mini-hidden-element text-truncate flex-grow-1">
                            <?php echo e(translate('Payment_Methods')); ?>

                        </span>
                    </a>
                </li>

                <li>
                    <a class="nav-link
                <?php echo e(Request::is('admin/third-party/firebase-configuration/setup') ||
                    Request::is('admin/third-party/firebase-configuration/authentication') ? 'active' : ''); ?>"
                       href="<?php echo e(route('admin.third-party.firebase-configuration.setup')); ?>"
                       title="<?php echo e(translate('Firebase')); ?>">
                        <i class="fi fi-sr-database"></i>
                        <span class="aside-mini-hidden-element text-truncate flex-grow-1">
                            <?php echo e(translate('Firebase')); ?>

                        </span>
                    </a>
                </li>

                <li>
                    <a class="nav-link <?php echo e(Request::is('admin/third-party/analytics-index') ? 'active' : ''); ?>"
                       href="<?php echo e(route('admin.third-party.analytics-index')); ?>"
                       title="<?php echo e(translate('Marketing_Tools')); ?>">
                        <i class="fi fi-sr-tools"></i>
                        <span class="aside-mini-hidden-element text-truncate flex-grow-1">
                            <?php echo e(translate('Marketing_Tools')); ?>

                        </span>
                    </a>
                </li>

                <li>
                    <a class="nav-link <?php echo e(Request::is('admin/third-party/mail') ||
                            Request::is('admin/third-party/sms-module') ||
                            Request::is('admin/third-party/recaptcha') ||
                            Request::is('admin/third-party/social-login/view') ||
                            Request::is('admin/third-party/social-media-chat/view') ||
                            Request::is('admin/third-party/storage-connection-settings/index') ||
                            Request::is('admin/third-party/map-api') ? 'active'  :''); ?>"
                       href="<?php echo e(route('admin.third-party.social-login.view')); ?>"
                       title="<?php echo e(translate('Other_Configuration')); ?>">
                        <i class="fi fi-sr-workflow-setting-alt"></i>
                        <span class="aside-mini-hidden-element text-truncate flex-grow-1">
                            <?php echo e(translate('Other_Configuration')); ?>

                        </span>
                    </a>
                </li>
            <?php endif; ?>

            <?php if(Helpers::module_permission_check('themes_and_addons')): ?>
                <li class="nav-item nav-item_title">
                    <small class="nav-subtitle" title="">
                        <?php echo e(translate('Themes_&_Addons')); ?>

                    </small>
                </li>

                <li>
                    <a class="nav-link <?php echo e(Request::is('admin/system-setup/theme/setup') ? 'active' : ''); ?>"
                       href="<?php echo e(route('admin.system-setup.theme.setup')); ?>" title="<?php echo e(translate('Theme_Setup')); ?>">
                        <i class="fi fi-sr-palette"></i>
                        <span class="aside-mini-hidden-element text-truncate flex-grow-1">
                            <?php echo e(translate('Theme_Setup')); ?>

                        </span>
                    </a>
                </li>

                <li>
                    <a class="nav-link <?php echo e(Request::is('admin/system-setup/addon') ? 'active' : ''); ?>"
                       href="<?php echo e(route('admin.system-setup.addon.index')); ?>" title="<?php echo e(translate('System_Addons')); ?>">
                        <i class="fi fi-sr-book-plus"></i>
                        <span class="aside-mini-hidden-element text-truncate flex-grow-1">
                            <?php echo e(translate('System_Addons')); ?>

                        </span>
                    </a>
                </li>
            <?php endif; ?>

            <?php if(count(config('addon_admin_routes'))>0): ?>
                <li>
                    <a class="nav-link nav-link-toggle <?php $__currentLoopData = config('addon_admin_routes'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $routes): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $__currentLoopData = $routes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $route): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo e(strstr(Request::url(), $route['path']) ? 'active' : ''); ?>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>" href="javascript:" title="<?php echo e(translate('addon_Menus')); ?>">
                        <i class="fi fi-rr-home"></i>
                        <span
                            class="aside-mini-hidden-element flex-grow-1 d-flex justify-content-between align-items-center">
                            <span class="text-truncate max-w-180">
                                <?php echo e(translate('addon_Menus')); ?>

                            </span>
                            <i class="fi fi-sr-angle-down"></i>
                        </span>
                    </a>
                    <ul class="aside-submenu navbar-nav">
                        <li class="nav-item px-3 py-2 fw-semibold text-dark bg-section2 aside-mini-show-element">
                            <?php echo e(translate('addon_Menus')); ?>

                        </li>

                        <?php $__currentLoopData = config('addon_admin_routes'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $routes): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $__currentLoopData = $routes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $route): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <a class="nav-link <?php echo e(strstr(Request::url(), $route['path']) ? 'active' : ''); ?>"
                                       href="<?php echo e($route['url']); ?>" title="<?php echo e(translate($route['name'])); ?>">
                                            <span class="text-truncate">
                                                <?php echo e(translate($route['name'])); ?>

                                            </span>
                                    </a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </li>
            <?php endif; ?>

            <?php $checkSetupGuideRequirements = checkSetupGuideRequirements(panel: 'admin'); ?>

            <li class="nav-item <?php echo e($checkSetupGuideRequirements['completePercent'] < 100 ? 'pt-5 mt-5 d-none d-lg-block' : ''); ?>">
                <div class="pt-4"></div>
            </li>
        </ul>
    </div>
</aside>

<?php echo $__env->make("layouts.admin.partials._setup-guide", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="offcanvas offcanvas-start bg-panel d-lg-none w-280" tabindex="-1" id="offcanvasAside"
     aria-labelledby="offcanvasAsideLabel">
    <div class="offcanvas-header d-flex align-items-center gap-2 justify-content-between">
        <a class="navbar-logo" href="<?php echo e(route('admin.dashboard.index')); ?>">
            <img height="24" src="<?php echo e(getStorageImages(path: $eCommerceLogo, type: 'backend-logo')); ?>"
                 alt="<?php echo e(translate('logo')); ?>">
        </a>

        <button type="button" class="bg-transparent p-0 text-white border-0" data-bs-dismiss="offcanvas"
                aria-label="Close">
            <i class="fi fi-rr-cross"></i>
        </button>
    </div>

    <div class="offcanvas-body js-offcanvas-body pt-0">

    </div>
</div>
<?php /**PATH C:\Users\musas\Desktop\softwares\6valley\POSA-latest version\POSA\resources\views/layouts/admin/partials/_side-bar.blade.php ENDPATH**/ ?>