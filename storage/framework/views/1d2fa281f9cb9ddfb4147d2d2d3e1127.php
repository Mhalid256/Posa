<?php use Illuminate\Support\Str; ?>


<?php $__env->startSection('title', translate('vendor_List')); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <div class="mb-4">
            <h2 class="h1 mb-0 text-capitalize d-flex align-items-center gap-2">
                <img src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/img/add-new-seller.png')); ?>" alt="">
                <?php echo e(translate('vendor_List')); ?>

                <span class="badge badge-info text-bg-info"><?php echo e($vendors->total()); ?></span>
            </h2>
        </div>

        <div class="card">
            <div class="px-3 py-4">
                <div class="d-flex justify-content-between gap-10 flex-wrap align-items-center mb-4">
                    <div class="">
                        <form action="<?php echo e(url()->current()); ?>" method="GET">
                            <div class="input-group">
                                <input id="datatableSearch_" type="search" name="searchValue" class="form-control"
                                       placeholder="<?php echo e(translate('search_by_shop_name_or_vendor_name_or_phone_or_email')); ?>" aria-label="Search orders" value="<?php echo e(request('searchValue')); ?>">
                                <div class="input-group-append search-submit">
                                    <button type="submit">
                                        <i class="fi fi-rr-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="d-flex justify-content-end gap-3">
                        <a type="button" class="btn btn-outline-primary text-nowrap" href="<?php echo e(route('admin.vendors.export',['searchValue' => request('searchValue')])); ?>">
                            <img width="14" src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/img/excel.png')); ?>" class="excel" alt="">
                            <span class="ps-2"><?php echo e(translate('export')); ?></span>
                        </a>

                        <a href="<?php echo e(route('admin.vendors.add')); ?>" type="button" class="btn btn-primary text-nowrap">
                            <i class="fi fi-rr-plus-small"></i>
                            <?php echo e(translate('add_New_Vendor')); ?>

                        </a>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table w-100">
                        <thead class="thead-light thead-50 text-capitalize">
                            <tr>
                                <th><?php echo e(translate('SL')); ?></th>
                                <th><?php echo e(translate('shop_name')); ?></th>
                                <th><?php echo e(translate('vendor_name')); ?></th>
                                <th><?php echo e(translate('contact_info')); ?></th>
                                <th><?php echo e(translate('status')); ?></th>
                                <th class="text-center"><?php echo e(translate('total_products')); ?></th>
                                <th class="text-center"><?php echo e(translate('total_orders')); ?></th>
                                <th class="text-center"><?php echo e(translate('action')); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$seller): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($vendors->firstItem()+$key); ?></td>
                                <td>
                                    <div class="d-flex align-items-center gap-10 w-max-content">
                                        <img width="50"
                                        class="avatar rounded-circle object-fit-cover" src="<?php echo e(getStorageImages(path: $seller?->shop?->image_full_url, type: 'backend-basic')); ?>"
                                            alt="">
                                        <div>
                                            <a class="text-dark text-hover-primary" href="<?php echo e(route('admin.vendors.view', ['id' => $seller->id])); ?>"><?php echo e($seller->shop ? Str::limit($seller->shop->name, 20) : translate('shop_not_found')); ?></a>
                                            <span class="text-danger fs-12">
                                                <?php if($seller->shop && $seller->shop->temporary_close): ?>
                                                <br>
                                                <?php echo e(translate('temporary_closed')); ?>

                                                <?php elseif($seller->shop && $seller->shop->vacation_status && $current_date >= date('Y-m-d', strtotime($seller->shop->vacation_start_date)) && $current_date <= date('Y-m-d', strtotime($seller->shop->vacation_end_date))): ?>
                                                <br>
                                                <?php echo e(translate('on_vacation')); ?>

                                                <?php endif; ?>
                                            </span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <a title="<?php echo e(translate('view')); ?>"
                                        class="text-dark text-hover-primary"
                                        href="<?php echo e(route('admin.vendors.view',$seller->id)); ?>">
                                        <?php echo e($seller->f_name); ?> <?php echo e($seller->l_name); ?>

                                    </a>
                                </td>
                                <td>
                                    <div class="mb-1">
                                        <strong><a class="text-dark text-hover-primary" href="mailto:<?php echo e($seller->email); ?>"><?php echo e($seller->email); ?></a></strong>
                                    </div>
                                    <a class="text-dark text-hover-primary" href="tel:<?php echo e($seller->phone); ?>"><?php echo e($seller->phone); ?></a>
                                </td>
                                <td>
                                    <?php echo $seller->status=='approved'?'<label class="badge badge-success text-bg-success">'.translate('active').'</label>':'<label class="badge badge-danger text-bg-danger">'.translate('inactive').'</label>'; ?>

                                </td>
                                <td class="text-center">
                                    <a href="<?php echo e(route('admin.vendors.view', ['id'=>$seller['id'], 'tab'=>'product'])); ?>"
                                        class="badge badge-info text-bg-info">
                                        <?php echo e($seller->product->count()); ?>

                                    </a>
                                </td>
                                <td class="text-center">
                                    <a href="<?php echo e(route('admin.vendors.view',['id'=>$seller['id'], 'tab'=>'order'])); ?>"
                                        class="badge badge-info text-bg-info">
                                        <?php echo e($seller->orders->where('seller_is', 'seller')->where('order_type', 'default_type')->count()); ?>

                                    </a>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <a title="<?php echo e(translate('view')); ?>"
                                            class="btn btn-outline-info icon-btn"
                                            href="<?php echo e(route('admin.vendors.view',$seller->id)); ?>">
                                            <i class="fi fi-rr-eye"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                <div class="table-responsive mt-4">
                    <div class="px-4 d-flex justify-content-center justify-content-md-end">
                        <?php echo $vendors->links(); ?>

                    </div>
                </div>
                <?php if(count($vendors)==0): ?>
                    <?php echo $__env->make('layouts.admin.partials._empty-state',['text'=>'no_vendor_found'],['image'=>'default'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\musas\Desktop\softwares\6valley\POSA-latest\POSA\resources\views/admin-views/vendor/index.blade.php ENDPATH**/ ?>