<?php use Carbon\Carbon; ?>


<?php $__env->startSection('title', translate('subscriber_list')); ?>

<?php $__env->startSection('content'); ?>
<div class="content container-fluid">
    <div class="mb-3">
        <h2 class="h1 mb-0 text-capitalize d-flex align-items-center gap-2">
            <img src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/img/subscribers.png')); ?>" width="20" alt="">
            <?php echo e(translate('subscriber_list')); ?>

            <span class="badge text-dark bg-body-secondary fw-semibold rounded-50"><?php echo e($totalSubscribers); ?></span>
        </h2>
    </div>
    <div class="card mb-3">
        <div class="card-body">
            <form action="<?php echo e(url()->current()); ?>" method="GET">
                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label"><?php echo e(translate('Subscription_Date')); ?></label>
                            <div class="position-relative">
                            <span class="fi fi-sr-calendar icon-absolute-on-right"></span>
                                <input type="text" name="subscription_date" value="<?php echo e(request('subscription_date', '')); ?>" class="js-daterangepicker-with-range form-control cursor-pointer" value="<?php echo e(request('subscription_date')); ?>" placeholder="<?php echo e(translate('Select_Date')); ?>" autocomplete="off" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label"><?php echo e(translate('Sort_By')); ?></label>
                            <select class="custom-select" name="sort_by">
                                <option disabled <?php echo e(is_null(request('sort_by')) ? 'selected' : ''); ?>><?php echo e(translate('select_mail_sorting_order')); ?></option>
                                <option value="asc" <?php echo e(request('sort_by') === 'asc' ? 'selected' : ''); ?>><?php echo e(translate('Sort_by_oldest')); ?></option>
                                <option value="desc" <?php echo e(request('sort_by') === 'desc' ? 'selected' : ''); ?>><?php echo e(translate('Sort_by_newest')); ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label"><?php echo e(translate('Choose_First')); ?></label>
                            <input type="number" name="choose_first" min="1" value="<?php echo e(request('choose_first')); ?>" class="form-control" placeholder="<?php echo e(translate('Ex')); ?> : <?php echo e(translate('100')); ?>">
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-wrap gap-3 justify-content-end mt-3">
                    <a href="<?php echo e(route('admin.customer.subscriber-list')); ?>"
                       class="btn btn-secondary min-w-120">
                        <?php echo e(translate('reset')); ?>

                    </a>
                    <button type="submit" class="btn btn-primary min-w-120"><?php echo e(translate('Filter')); ?></button>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body d-flex flex-column gap-20">
                    <div class="d-flex justify-content-between align-items-center gap-20 flex-wrap">
                        <h3 class="mb-0">
                            <?php echo e(translate('subscriber_list')); ?>

                            <span class="badge text-dark bg-body-secondary fw-semibold rounded-50"><?php echo e($subscriberList->total()); ?></span>
                        </h3>
                        <div class="d-flex flex-wrap gap-3 align-items-center justify-content-sm-end flex-grow-1">
                            <div class="flex-grow-1 max-w-280">
                                <form action="<?php echo e(url()->current()); ?>" method="GET">
                                    <input type="hidden" name="subscription_date" value="<?php echo e(request('subscription_date')); ?>">
                                    <input type="hidden" name="sort_by" value="<?php echo e(request('sort_by')); ?>">
                                    <input type="hidden" name="choose_first" value="<?php echo e(request('choose_first')); ?>">
                                    <div class="input-group">
                                       <input id="datatableSearch_" type="search" name="searchValue" class="form-control"
                                            placeholder="<?php echo e(translate('search_by_email')); ?>"  aria-label="Search orders" value="<?php echo e(request('searchValue')); ?>">
                                            <div class="input-group-append search-submit">
                                                <button type="submit">
                                                    <i class="fi fi-rr-search"></i>
                                                </button>
                                            </div>
                                    </div>
                                </form>
                            </div>
                            <div class="dropdown">
                                <a type="button" class="btn btn-outline-primary text-nowrap" href="<?php echo e(route('admin.customer.subscriber-list.export', ['sort_by' => request('sort_by'), 'choose_first' => request('choose_first'), 'subscription_date' => request('subscription_date'), 'searchValue' => request('searchValue')])); ?>">
                                    <img width="14" src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/img/excel.png')); ?>" class="excel" alt="">
                                    <span class="ps-2"><?php echo e(translate('export')); ?></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table style="text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>;"
                            class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table w-100">
                            <thead class="thead-light thead-50 text-capitalize">
                            <tr>
                                <th><?php echo e(translate('SL')); ?></th>
                                <th scope="col">
                                    <?php echo e(translate('email')); ?>

                                </th>
                                <th><?php echo e(translate('subscription_date')); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $subscriberList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($subscriberList->firstItem()+$key); ?></td>
                                        <td><?php echo e($item->email); ?></td>
                                        <td>
                                            <?php echo e(date('d M Y, h:i A',strtotime($item->created_at))); ?>

                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>

                    </div>

                    <div class="table-responsive">
                        <div class="px-4 d-flex justify-content-lg-end">
                            <?php echo e($subscriberList->links()); ?>

                        </div>
                    </div>
                    <?php if(count($subscriberList)==0): ?>
                        <?php echo $__env->make('layouts.admin.partials._empty-state',['text'=>'no_subscriber_found'],['image'=>'default'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script type="text/javascript">
        changeInputTypeForDateRangePicker($('input[name="subscription_date"]'));
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\musas\Desktop\softwares\6valley\POSA-latest version\POSA\resources\views/admin-views/customer/subscriber-list.blade.php ENDPATH**/ ?>