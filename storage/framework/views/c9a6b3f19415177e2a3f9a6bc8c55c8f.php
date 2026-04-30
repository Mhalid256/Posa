<?php $__env->startSection('title', translate('stock_limit_products')); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <div class="mb-3 d-flex flex-column gap-1">
            <h2 class="h1 text-capitalize d-flex gap-2">
                <img src="<?php echo e(asset('public/assets/back-end/img/inhouse-product-list.png')); ?>" class="mb-1 mr-1" alt="">
                <?php echo e(translate('limited_Stocked_Products_List')); ?>

                <span class="badge badge-soft-dark radius-50 fz-14 ml-1">
                    <?php echo e($products->total()); ?>

                </span>
            </h2>
            <p class="d-flex">
                <?php echo e(translate('the_products_are_shown_in_this_list,_which_quantity_is_below')); ?> <?php echo e($stockLimit); ?>

            </p>
        </div>
        <div class="row mt-30">
            <div class="col-md-12">
                <div class="card">
                    <div class="px-3 py-4">
                        <div class="row justify-content-between align-items-center gy-2">
                            <div class="col-auto">
                                <form action="<?php echo e(url()->current()); ?>" method="GET">
                                    <div class="input-group input-group-custom input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="tio-search"></i>
                                            </div>
                                        </div>
                                        <input id="datatableSearch_" type="search" name="searchValue"
                                               class="form-control"
                                               placeholder="<?php echo e(translate('search_by_Product_Name')); ?>"
                                               aria-label="Search orders"
                                               value="<?php echo e($searchValue); ?>" required>
                                        <button type="submit" class="btn btn--primary">
                                            <?php echo e(translate('search')); ?>

                                        </button>
                                    </div>
                                </form>
                            </div>

                            <div class="col-12 mt-1 col-md-6 col-lg-3">
                                <select name="qty_order_sort" class="form-control action-select-onchange-get-view"
                                        data-url-prefix="<?php echo e(route('vendor.products.stock-limit-list')); ?>/?sortOrderQty=">
                                    <option value="default" <?php echo e($sortOrderQty== "default"?'selected':''); ?>>
                                        <?php echo e(translate('default')); ?>

                                    </option>
                                    <option value="quantity_asc" <?php echo e($sortOrderQty== "quantity_asc"?'selected':''); ?>>
                                        <?php echo e(translate('inventory_quantity(low_to_high)')); ?>

                                    </option>
                                    <option value="quantity_desc" <?php echo e($sortOrderQty== "quantity_desc"?'selected':''); ?>>
                                        <?php echo e(translate('inventory_quantity(high_to_low)')); ?>

                                    </option>
                                    <option value="order_asc" <?php echo e($sortOrderQty== "order_asc"?'selected':''); ?>>
                                        <?php echo e(translate('order_volume(low_to_high)')); ?>

                                    </option>
                                    <option value="order_desc" <?php echo e($sortOrderQty== "order_desc"?'selected':''); ?>>
                                        <?php echo e(translate('order_volume(high_to_low)')); ?>

                                    </option>
                                </select>
                            </div>

                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="datatable"
                               class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table w-100 text-start">
                            <thead class="thead-light thead-50 text-capitalize">
                                <tr>
                                    <th><?php echo e(translate('SL')); ?></th>
                                    <th><?php echo e(translate('product_Name')); ?></th>
                                    <th><?php echo e(translate('unit_price')); ?></th>
                                    <th><?php echo e(translate('verify_status')); ?></th>
                                    <th class="text-center"><?php echo e(translate('quantity')); ?></th>
                                    <th class="text-center"><?php echo e(translate('orders')); ?></th>
                                    <th class="text-center"><?php echo e(translate('active_Status')); ?></th>
                                    <th class="text-center"><?php echo e(translate('action')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <th scope="row"><?php echo e($products->firstItem()+$key); ?></th>
                                    <td>
                                        <a href="<?php echo e(route('vendor.products.view',[$product['id']])); ?>"
                                           class="media align-items-center gap-2">
                                            <img src="<?php echo e(getStorageImages(path:$product->thumbnail_full_url,type: 'backend-product')); ?>"
                                                data-onerror="<?php echo e(dynamicAsset(path: '/public/assets/back-end/img/brand-logo.png')); ?>"
                                                class="avatar border object-fit-cover" alt="">
                                            <span class="media-body title-color hover-c1">
                                                <?php echo e(Str::limit($product['name'], 20)); ?>

                                            </span>
                                        </a>
                                    </td>
                                    <td>
                                        <?php echo e(setCurrencySymbol(amount: usdToDefaultCurrency(amount: $product['unit_price']), currencyCode: getCurrencyCode())); ?>

                                    </td>
                                    <td>
                                        <?php if($product->request_status == 0): ?>
                                            <label class="badge badge-soft-warning">
                                                <?php echo e(translate('new_Request')); ?>

                                            </label>
                                        <?php elseif($product->request_status == 1): ?>
                                            <label class="badge badge-soft-success">
                                                <?php echo e(translate('approved')); ?>

                                            </label>
                                        <?php elseif($product->request_status == 2): ?>
                                            <label class="badge badge-soft-danger">
                                                <?php echo e(translate('denied')); ?>

                                            </label>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-center">
                                            <?php echo e($product['current_stock']); ?>

                                            <button class="btn py-0 px-2 fz-18 action-update-product-quantity"
                                                    id="<?php echo e($product['id']); ?>"
                                                    data-url="<?php echo e(route('vendor.products.get-variations').'?id='.$product['id']); ?>"
                                                    type="button" data-target="#update-quantity"
                                                    title="<?php echo e(translate('update_quantity')); ?>"
                                            >
                                                <i class="tio-add-circle c1"></i>
                                            </button>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <?php echo e($product['order_details_count']); ?>

                                    </td>
                                    <td class="text-center">
                                        <form action="<?php echo e(route('vendor.products.status-update')); ?>" method="post"
                                              id="product-status<?php echo e($product['id']); ?>-form"
                                              class="admin-product-status-form">
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" name="id" value="<?php echo e($product['id']); ?>">
                                            <label class="switcher mx-auto">
                                                <input type="checkbox" class="switcher_input toggle-switch-message"
                                                       name="status"
                                                       id="product-status<?php echo e($product['id']); ?>" value="1"
                                                       <?php echo e($product['status'] == 1 ? 'checked' : ''); ?>

                                                       data-modal-id="toggle-status-modal"
                                                       data-toggle-id="product-status<?php echo e($product['id']); ?>"
                                                       data-on-image="product-status-on.png"
                                                       data-off-image="product-status-off.png"
                                                       data-on-title="<?php echo e(translate('Want_to_Turn_ON').' '.$product['name'].' '.translate('status')); ?>"
                                                       data-off-title="<?php echo e(translate('Want_to_Turn_OFF').' '.$product['name'].' '.translate('status')); ?>"
                                                       data-on-message="<p><?php echo e(translate('if_enabled_this_product_will_be_available_on_the_website_and_customer_app')); ?></p>"
                                                       data-off-message="<p><?php echo e(translate('if_disabled_this_product_will_be_hidden_from_the_website_and_customer_app')); ?></p>">
                                                <span class="switcher_control"></span>
                                            </label>
                                        </form>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <a class="btn btn-outline-info btn-sm square-btn"
                                               title="<?php echo e(translate('barcode')); ?>"
                                               href="<?php echo e(route('vendor.products.barcode', [$product['id']])); ?>">
                                                <i class="tio-barcode"></i>
                                            </a>
                                            <a class="btn btn-outline--primary btn-sm square-btn"
                                               title="<?php echo e(translate('edit')); ?>"
                                               href="<?php echo e(route('vendor.products.update',[$product['id']])); ?>">
                                                <i class="tio-edit"></i>
                                            </a>
                                            <span class="btn btn-outline-danger btn-sm square-btn delete-data"
                                                  title="<?php echo e(translate('delete')); ?>"
                                                  data-id="product-<?php echo e($product['id']); ?>">
                                                <i class="tio-delete"></i>
                                            </span>
                                        </div>
                                        <form action="<?php echo e(route('vendor.products.delete', [$product['id']])); ?>"
                                              method="post" id="product-<?php echo e($product['id']); ?>">
                                            <?php echo csrf_field(); ?> <?php echo method_field('delete'); ?>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="table-responsive mt-4">
                        <div class="px-4 d-flex justify-content-lg-end">
                            <?php echo e($products->links()); ?>

                        </div>
                    </div>

                    <?php if(count($products)==0): ?>
                        <?php echo $__env->make('layouts.vendor.partials._empty-state',['text'=>'no_product_found'],['image'=>'default'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade update-stock-modal" id="update-quantity" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <form action="<?php echo e(route('vendor.products.update-quantity')); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <div class="rest-part-content"></div>
                        <div class="d-flex justify-content-end gap-10 flex-wrap align-items-center">
                            <button type="button" class="btn btn-danger px-4" data-dismiss="modal" aria-label="Close">
                                <?php echo e(translate('close')); ?>

                            </button>
                            <button class="btn btn--primary" class="btn btn--primary px-4" type="submit">
                                <?php echo e(translate('submit')); ?>

                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.vendor.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\musas\Desktop\softwares\6valley\POSA-latest version\POSA\resources\views/vendor-views/product/stock-limit-list.blade.php ENDPATH**/ ?>