

<?php $__env->startSection('title', translate('employee_details')); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <div class="mb-3">
            <h2 class="h1 mb-0 text-capitalize d-flex align-items-center gap-2">
                <img src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/img/employee.png')); ?>" width="20" alt="">
                <?php echo e(translate('employee_details')); ?>

            </h2>
        </div>

        <div class="card mt-3">
            <div class="card-body">
                <h3 class="mb-3 text-primary">#<?php echo e(translate('EMP')); ?> <?php echo e($employee->id); ?></h3>
                <div class="row g-2">
                    <div class="col-lg-7 col-xl-8">
                        <div class="media align-items-center flex-wrap flex-sm-nowrap gap-3">
                            <img width="220" class="rounded border" src="<?php echo e($employee->image_full_url); ?>" alt="<?php echo e($employee->name); ?>">
                            <div class="media-body">
                                <div class="text-capitalize mb-4">
                                    <h3 class="mb-2"><?php echo e($employee->name); ?></h3>
                                    <p class="text-muted"><?php echo e($employee->role?->name ?? translate('role_not_found')); ?></p>
                                </div>
                                <ul class="d-flex flex-column gap-2 px-0 list-unstyled">
                                    <li class="d-flex gap-2 align-items-center">
                                        <i class="fi fi-rr-phone-flip"></i>
                                        <a href="tel:<?php echo e($employee->phone); ?>" class="text-dark"><?php echo e($employee->phone); ?></a>
                                    </li>
                                    <li class="d-flex gap-2 align-items-center">
                                        <i class="fi fi-rr-envelope"></i>
                                        <a href="mailto:<?php echo e($employee->email); ?>" class="text-dark"><?php echo e($employee->email); ?></a>
                                    </li>
                                    <?php if($employee->identify_type): ?>
                                        <li class="d-flex gap-2 align-items-center">
                                            <i class="fi fi-rr-id-badge"></i>
                                            <span class="text-uppercase">
                                                <?php echo e($employee->identify_type); ?> — <?php echo e($employee->identify_number ?? translate('N/A')); ?>

                                            </span>
                                        </li>
                                    <?php endif; ?>
                                    <li class="d-flex gap-2 align-items-center">
                                        <i class="fi fi-rr-calendar-day"></i>
                                        <span><?php echo e(translate('joined')); ?>: <?php echo e($employee->created_at->format('d/m/Y')); ?></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5 col-xl-4">
                        <div class="bg-primary-light rounded p-3">
                            <div class="bg-white rounded p-3">
                                <div class="d-flex gap-2 align-items-center mb-2">
                                    <i class="fi fi-rr-portrait"></i>
                                    <h5 class="mb-0 text-capitalize"><?php echo e(translate('access_permissions')); ?>:</h5>
                                </div>
                                <?php if($employee->role): ?>
                                    <div class="tags d-flex gap-2 flex-wrap mt-2">
                                        <?php $__currentLoopData = json_decode($employee->role->module_access ?? '[]'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <span class="badge badge-info text-bg-info text-capitalize">
                                                <?php echo e(str_replace('_', ' ', $module)); ?>

                                            </span>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                <?php else: ?>
                                    <p class="text-muted small mb-0"><?php echo e(translate('no_permissions_assigned')); ?></p>
                                <?php endif; ?>
                            </div>

                            <?php if(!empty($employee->identify_images)): ?>
    <div class="bg-white rounded p-3 mt-3">
        <h6 class="mb-2"><?php echo e(translate('identity_documents')); ?></h6>
        <div class="row g-2">
            <?php $__currentLoopData = $employee->identify_images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-6">
                    <img src="<?php echo e($img); ?>" class="img-fluid rounded border" alt="">
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
<?php endif; ?>
                        </div>
                    </div>

                    <div class="col-12 mt-3">
                        <div class="d-flex justify-content-end gap-2">
                            <a href="<?php echo e(route('vendor.employee.list')); ?>" class="btn btn-outline-secondary">
                                <i class="fi fi-rr-arrow-left"></i> <?php echo e(translate('back')); ?>

                            </a>
                            <a href="<?php echo e(route('vendor.employee.update', $employee->id)); ?>" class="btn btn-primary">
                                <i class="fi fi-rr-pencil"></i> <?php echo e(translate('edit')); ?>

                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.vendor.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\musas\Desktop\softwares\6valley\POSA-latest version\POSA\resources\views/vendor-views/employee/view.blade.php ENDPATH**/ ?>