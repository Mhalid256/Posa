<?php $__env->startSection('title', translate('restock_product_List')); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">

        <div class="mb-3">
            <h2 class="h1 mb-0 text-capitalize d-flex gap-2">
                <img src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/img/inhouse-product-list.png')); ?>" alt="">
                <?php echo e(translate('Request_Restock_List')); ?>

                <span class="badge badge-soft-dark radius-50 fz-14 ml-1"><?php echo e($totalRestockProducts); ?></span>
            </h2>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="<?php echo e(url()->current()); ?>" method="GET">
                    <input type="hidden" value="<?php echo e(request('status')); ?>" name="status">
                    <div class="row gx-2">
                        <div class="col-12">
                            <h4 class="mb-3"><?php echo e(translate('filter_Products')); ?></h4>
                        </div>
                        <?php if(request('type') == 'seller'): ?>
                            <div class="col-sm-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label class="title-color" for="store"><?php echo e(translate('store')); ?></label>
                                    <select name="seller_id" class="form-control text-capitalize">
                                        <option value="" selected><?php echo e(translate('all_store')); ?></option>
                                        <?php $__currentLoopData = $sellers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $seller): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($seller->id); ?>"<?php echo e(request('seller_id')==$seller->id ? 'selected' :''); ?>>
                                                <?php echo e($seller->shop->name); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="col-sm-6 col-lg-4 col-xl-3">
                            <div class="form-group">
                                <label class="title-color" for="store"><?php echo e(translate('Request_Restock_Date')); ?></label>
                                <div class="position-relative">
                                    <span class="tio-calendar icon-absolute-on-right"></span>
                                    <input type="text" name="restock_date" class="js-daterangepicker-with-range form-control" placeholder="<?php echo e(translate('Select_Date')); ?>" value="<?php echo e(request('restock_date')); ?>" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-4 col-xl-3">
                            <div class="form-group">
                                <label for="name" class="title-color"><?php echo e(translate('category')); ?></label>
                                <select class="js-select2-custom form-control action-get-request-onchange" name="category_id"
                                        data-url-prefix="<?php echo e(url('/admin/products/get-categories?parent_id=')); ?>"
                                        data-element-id="sub-category-select"
                                        data-element-type="select">
                                    <option value="<?php echo e(old('category_id')); ?>" selected
                                            disabled><?php echo e(translate('select_category')); ?></option>
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($category['id']); ?>"
                                            <?php echo e(request('category_id') == $category['id'] ? 'selected' : ''); ?>>
                                            <?php echo e($category['defaultName']); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-4 col-xl-3">
                            <div class="form-group">
                                <label for="name" class="title-color"><?php echo e(translate('sub_Category')); ?></label>
                                <select class="js-select2-custom form-control action-get-request-onchange" name="sub_category_id"
                                        id="sub-category-select"
                                        data-url-prefix="<?php echo e(url('/admin/products/get-categories?parent_id=')); ?>"
                                        data-element-id="sub-sub-category-select"
                                        data-element-type="select">
                                    <option value="<?php echo e(request('sub_category_id') != null ? request('sub_category_id') : null); ?>"
                                            selected <?php echo e(request('sub_category_id') != null ? '' : 'disabled'); ?>><?php echo e(request('sub_category_id') != null ? $subCategory['defaultName']: translate('select_Sub_Category')); ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-4 col-xl-3">
                            <div class="form-group">
                                <label class="title-color" for="store"><?php echo e(translate('brand')); ?></label>
                                <select name="brand_id" class="js-select2-custom form-control text-capitalize">
                                    <option value="" selected><?php echo e(translate('select_brand')); ?></option>
                                    <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($brand->id); ?>" <?php echo e(request('brand_id')==$brand->id ? 'selected' :''); ?>><?php echo e($brand->default_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex gap-3 justify-content-end">
                                <a href="<?php echo e(route('vendor.products.request-restock-list')); ?>"
                                   class="btn btn-secondary px-5">
                                    <?php echo e(translate('reset')); ?>

                                </a>
                                <button type="submit" class="btn btn--primary px-5 action-get-element-type">
                                    <?php echo e(translate('show_data')); ?>

                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="row mt-20">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header gap-3 align-items-center">
                        <h5 class="mb-0 mr-auto">
                            <?php echo e(translate('request_list')); ?>

                            <span class="badge badge-soft-dark radius-50 fz-14 ml-1"><?php echo e($restockProducts->total()); ?></span>
                        </h5>

                        <form action="<?php echo e(url()->current()); ?>" method="GET">
                            <input type="hidden" name="restock_date" value="<?php echo e(request('restock_date')); ?>">
                            <input type="hidden" name="category_id" value="<?php echo e(request('category_id')); ?>">
                            <input type="hidden" name="sub_category_id" value="<?php echo e(request('sub_category_id')); ?>">
                            <input type="hidden" name="brand_id" value="<?php echo e(request('brand_id')); ?>">
                            <div class="input-group input-group-merge input-group-custom">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="tio-search"></i>
                                    </div>
                                </div>
                                <input id="datatableSearch_" type="search" name="searchValue" class="form-control"
                                       placeholder="<?php echo e(translate('search_by_Product_Name')); ?>"  aria-label="Search orders" value="<?php echo e(request('searchValue')); ?>">
                                <button type="submit" class="btn btn--primary"><?php echo e(translate('search')); ?></button>
                            </div>
                        </form>
                        <div class="dropdown">
                            <a type="button" class="btn btn-outline--primary text-nowrap" href="<?php echo e(route('vendor.products.restock-export', ['restock_date' => request('restock_date'),'brand_id' => request('brand_id'), 'category_id' => request('category_id'), 'sub_category_id' => request('sub_category_id'),  'searchValue' => request('searchValue')])); ?>">
                                <img width="14" src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/img/excel.png')); ?>" class="excel" alt="">
                                <span class="ps-2"><?php echo e(translate('export')); ?></span>
                            </a>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="datatable"
                               class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table w-100 text-start">
                            <thead class="thead-light thead-50 text-capitalize">
                            <tr>
                                <th><?php echo e(translate('SL')); ?></th>
                                <th><?php echo e(translate('product_name')); ?></th>
                                <th class="text-center"><?php echo e(translate('selling_price')); ?></th>
                                <th class="text-center"><?php echo e(translate('last_request_date')); ?></th>
                                <th class="text-center"><?php echo e(translate('number_of_request')); ?></th>
                                <th class="text-center"><?php echo e(translate('action')); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $restockProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$restockProduct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <th scope="row"><?php echo e(++$key); ?></th>
                                    <td>
                                        <a href="<?php echo e(route('vendor.products.view',['id'=>$restockProduct->product['id'] ?? 0])); ?>"
                                           class="media align-items-center gap-2">
                                            <img src="<?php echo e(getStorageImages(path: $restockProduct?->product?->thumbnail_full_url, type: 'backend-product')); ?>"
                                                 class="avatar border" alt="">
                                            <span class="media-body title-color hover-c1">
                                                <?php echo e(Str::limit($restockProduct->product['name'] ?? '', 20)); ?>

                                                <?php if($restockProduct['variant']): ?>
                                                    <p class="small font-weight-bold m-0"><?php echo e(translate('Variant:')); ?> <?php echo e($restockProduct['variant']); ?></p>
                                                <?php endif; ?>
                                            </span>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <?php echo e(setCurrencySymbol(amount: usdToDefaultCurrency(amount: $restockProduct->product['unit_price'] ?? 0), currencyCode: getCurrencyCode())); ?>

                                    </td>
                                    <td class="text-center">
                                        <?php echo e($restockProduct->updated_at->format('d F Y, h:i A')); ?>

                                    </td>
                                    <td class="text-center">
                                        <?php echo e($restockProduct?->restockProductCustomers?->count() ?? 0); ?>

                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <a class="btn btn-outline-info btn-sm square-btn" title="View"
                                               href="<?php echo e(route('vendor.products.view',['id'=>$restockProduct->product['id'] ?? 0])); ?>">
                                                <img src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/img/icons/restock_view.svg')); ?>" alt="">
                                            </a>
                                            <a class="btn btn-outline--primary btn-sm square-btn action-update-product-quantity"
                                               title="<?php echo e(translate('edit')); ?>"
                                               id="<?php echo e($restockProduct->product['id']); ?>"
                                               data-url="<?php echo e(route('vendor.products.get-variations', ['id'=> $restockProduct->product['id'], 'restock_id' => $restockProduct->id])); ?>"
                                               data-target="#update-stock">
                                                <img src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/img/icons/restock_update.svg')); ?>" alt="">
                                            </a>
                                            <span class="btn btn-outline-danger btn-sm square-btn delete-data"
                                                  title="<?php echo e(translate('delete')); ?>"
                                                  data-id="product-<?php echo e($restockProduct->id); ?>">
                                                <img src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/img/icons/restock_delete.svg')); ?>" alt="">
                                            </span>
                                        </div>
                                        <form action="<?php echo e(route('vendor.products.restock-delete',[$restockProduct->id])); ?>"
                                              method="post" id="product-<?php echo e($restockProduct->id); ?>">
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
                            <?php echo e($restockProducts->links()); ?>

                        </div>
                    </div>

                    <?php if(count($restockProducts)==0): ?>
                        <?php echo $__env->make('layouts.vendor.partials._empty-state',['text'=>'no_product_found'],['image'=>'default'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <span id="message-select-word" data-text="<?php echo e(translate('select')); ?>"></span>
    <div class="modal fade update-stock-modal restock-stock-update" id="update-stock" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="<?php echo e(route('vendor.products.update-quantity')); ?>" method="post" class="row">
                    <div class="modal-body">
                        <?php echo csrf_field(); ?>
                        <div class="rest-part-content"></div>
                        <div class="d-flex justify-content-end gap-10 flex-wrap align-items-center">
                            <button type="button" class="btn btn-danger px-4" data-dismiss="modal" aria-label="Close">
                                <?php echo e(translate('close')); ?>

                            </button>
                            <button class="btn btn--primary" class="btn btn--primary px-4" type="submit">
                                <?php echo e(translate('update')); ?>

                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
    <script type="text/javascript">
        changeInputTypeForDateRangePicker($('input[name="restock_date"]'));
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.vendor.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\musas\Desktop\softwares\6valley\POSA-latest version\POSA\resources\views/vendor-views/product/request-restock-list.blade.php ENDPATH**/ ?>