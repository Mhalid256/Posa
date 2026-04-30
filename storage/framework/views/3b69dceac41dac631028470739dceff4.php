<?php $__env->startSection('title',translate('deliveryman_List')); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <div class="mb-3">
            <h2 class="h1 mb-0 text-capitalize d-flex align-items-center gap-2">
                <img src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/img/deliveryman.png')); ?>" width="20" alt="">
                <?php echo e(translate('delivery_man')); ?> <span class="badge badge-soft-dark radius-50 fs-12"><?php echo e($deliveryMens->total()); ?></span>
            </h2>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between gap-10 flex-wrap align-items-center mb-4">
                    <div class="">
                        <form action="<?php echo e(url()->current()); ?>" method="GET">
                            <div class="input-group">
                                <input id="datatableSearch_" type="search" name="searchValue" class="form-control"
                                       placeholder="<?php echo e(translate('search_by_name').','.translate('_contact_info')); ?>" aria-label="Search" value="<?php echo e(request('searchValue')); ?>" >
                                <div class="input-group-append search-submit">
                                    <button type="submit">
                                        <i class="fi fi-rr-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="d-flex justify-content-end gap-3">
                        <a type="button" class="btn btn-outline-primary text-nowrap" href="<?php echo e(route('admin.delivery-man.export',['searchValue' => request('searchValue')])); ?>">
                            <img width="14" src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/img/excel.png')); ?>" class="excel" alt="">
                            <span class="ps-2"><?php echo e(translate('export')); ?></span>
                        </a>

                        <a href="<?php echo e(route('admin.delivery-man.add')); ?>" class="btn btn-primary text-nowrap">
                            <i class="fi fi-rr-plus-small"></i>
                            <?php echo e(translate('add_Delivery_Man')); ?>

                        </a>
                    </div>
                </div>

                <div class="table-responsive datatable-custom">
                    <table class="table table-hover table-borderless table-thead-bordered align-middle card-table">
                        <thead class="thead-light thead-50 text-capitalize table-nowrap">
                            <tr>
                                <th><?php echo e(translate('SL')); ?></th>
                                <th><?php echo e(translate('name')); ?></th>
                                <th><?php echo e(translate('contact info')); ?></th>
                                <th><?php echo e(translate('total_Orders')); ?></th>
                                <th><?php echo e(translate('rating')); ?></th>
                                <th class="text-center"><?php echo e(translate('status')); ?></th>
                                <th class="text-center"><?php echo e(translate('action')); ?></th>
                            </tr>
                        </thead>

                        <tbody id="set-rows">
                        <?php $__currentLoopData = $deliveryMens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $deliveryMen): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($deliveryMens->firstitem()+$key); ?></td>
                                <td>
                                    <div class="media align-items-center gap-10">
                                        <img class="rounded-circle aspect-1" width="50" alt="" src="<?php echo e(getStorageImages(path:$deliveryMen->image_full_url,type:'backend-profile')); ?>">
                                        <div class="media-body overflow-hidden text-truncate">
                                            <a title="Earning Statement" class="text-dark text-hover-primary" href="<?php echo e(route('admin.delivery-man.earning-statement-overview', ['id' => $deliveryMen['id']])); ?>">
                                                <?php echo e($deliveryMen['f_name'].' '.$deliveryMen['l_name']); ?>

                                            </a>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column gap-1">
                                        <div><a class="text-dark text-hover-primary" href="mailto:<?php echo e($deliveryMen['email']); ?>"><strong><?php echo e($deliveryMen['email']); ?></strong></a></div>
                                        <a class="text-dark text-hover-primary" href="tel:<?php echo e($deliveryMen['country_code']); ?><?php echo e($deliveryMen['phone']); ?>"><?php echo e($deliveryMen['country_code'].' '. $deliveryMen['phone']); ?></a>
                                    </div>
                                </td>
                                <td>
                                    <a href="<?php echo e(route('admin.orders.list', ['all', 'delivery_man_id' => $deliveryMen['id']])); ?>" class="badge badge-info text-bg-info">
                                        <span><?php echo e($deliveryMen->orders_count); ?></span>
                                    </a>
                                </td>
                                <td>
                                    <a href="<?php echo e(route('admin.delivery-man.rating', ['id' => $deliveryMen['id']])); ?>" class="badge badge-info text-bg-info">
                                        <span class="d-inline-flex align-items-center gap-1"><?php echo e(isset($deliveryMen->rating[0]->average) ? number_format($deliveryMen->rating[0]->average, 2, '.', ' ') : 0); ?>

                                            <i class="fi fi-sr-star"></i>
                                        </span>
                                    </a>
                                </td>
                                <td>
                                    <form action="<?php echo e(route('admin.delivery-man.status-update')); ?>"
                                          method="post" id="deliveryman_status<?php echo e($deliveryMen['id']); ?>-form"
                                          class="no-reload-form">
                                        <?php echo csrf_field(); ?>
                                        <input type="hidden" name="id" value="<?php echo e($deliveryMen['id']); ?>">
                                        <label class="switcher mx-auto" for="deliveryman_status<?php echo e($deliveryMen['id']); ?>">
                                            <input
                                                class="switcher_input custom-modal-plugin"
                                                type="checkbox" value="1" name="status"
                                                id="deliveryman_status<?php echo e($deliveryMen['id']); ?>"
                                                <?php echo e($deliveryMen->is_active == 1 ? 'checked':''); ?>

                                                data-modal-type="input-change-form"
                                                data-modal-form="#deliveryman_status<?php echo e($deliveryMen['id']); ?>-form"
                                                data-on-image="<?php echo e(dynamicAsset(path: 'public/assets/new/back-end/img/modal/deliveryman-status-on.png')); ?>"
                                                data-off-image="<?php echo e(dynamicAsset(path: 'public/assets/new/back-end/img/modal/deliveryman-status-off.png')); ?>"
                                                data-on-title = "<?php echo e(translate('Want_to_Turn_ON_Deliveryman_Status').'?'); ?>"
                                                data-off-title = "<?php echo e(translate('Want_to_Turn_OFF_Deliveryman_Status').'?'); ?>"
                                                data-on-message = "<p><?php echo e(translate('if_enabled_this_deliveryman_can_log_in_to_the_system_and_deliver_products')); ?></p>"
                                                data-off-message = "<p><?php echo e(translate('if_disabled_this_deliveryman_cannot_log_in_to_the_system_and_deliver_any_products')); ?></p>"
                                                data-on-button-text="<?php echo e(translate('turn_on')); ?>"
                                                data-off-button-text="<?php echo e(translate('turn_off')); ?>">
                                            <span class="switcher_control"></span>
                                        </label>
                                    </form>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center align-items-center gap-10">
                                        <a  class="btn btn-outline-primary icon-btn edit" title="<?php echo e(translate('edit')); ?>" href="<?php echo e(route('admin.delivery-man.edit',[$deliveryMen['id']])); ?>">
                                            <i class="fi fi-rr-pencil"></i>
                                        </a>
                                        <a title="Earning Statement" class="btn btn-outline-info icon-btn" href="<?php echo e(route('admin.delivery-man.earning-statement-overview', ['id' => $deliveryMen['id']])); ?>">
                                            <i class="fi fi-rr-sack-dollar"></i>
                                        </a>
                                        <a class="btn btn-outline-danger icon-btn delete delete-data" href="javascript:" data-id="delivery-man-<?php echo e($deliveryMen['id']); ?>" title="<?php echo e(translate('delete')); ?>">
                                            <i class="fi fi-rr-trash"></i>
                                        </a>
                                    </div>
                                    <form action="<?php echo e(route('admin.delivery-man.delete',[$deliveryMen['id']])); ?>"
                                            method="post" id="delivery-man-<?php echo e($deliveryMen['id']); ?>">
                                        <?php echo csrf_field(); ?> <?php echo method_field('delete'); ?>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                <div class="table-responsive mt-4">
                    <div class="px-4 d-flex justify-content-end">
                        <?php echo $deliveryMens->links(); ?>

                    </div>
                </div>
                <?php if(count($deliveryMens)==0): ?>
                    <?php echo $__env->make('layouts.admin.partials._empty-state',['text'=>'no_delivery_man_found'],['image'=>'default'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>
    <script src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/js/admin/deliveryman.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\musas\Desktop\softwares\6valley\POSA-latest version\POSA\resources\views/admin-views/delivery-man/list.blade.php ENDPATH**/ ?>