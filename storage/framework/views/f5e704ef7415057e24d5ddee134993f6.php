

<?php $__env->startSection('title', translate('employee_list')); ?>

<?php $__env->startPush('style'); ?>
<style>
    .form-select-sm {
        padding-top: 0.25rem;
        padding-bottom: 0.25rem;
        padding-left: 0.5rem;
        font-size: 0.875rem;
        border-radius: 0.2rem;
        min-width: 160px;
    }
    .btn-sm {
        white-space: nowrap;
    }
    .search-input {
        min-width: 260px;
    }
    @media (max-width: 768px) {
        .search-input, .form-select-sm {
            width: 100% !important;
        }
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="content container-fluid">
    <div class="mb-4">
        <h2 class="h1 mb-0 text-capitalize d-flex align-items-center gap-2">
            <img src="<?php echo e(dynamicAsset('public/assets/back-end/img/employee.png')); ?>" width="25" alt="">
            <?php echo e(translate('employee_list')); ?>

        </h2>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
                <h3 class="mb-0"><?php echo e(translate('employee_table')); ?> <span class="badge bg-info text-white"><?php echo e($employees->total()); ?></span></h3>
                <div class="d-flex flex-wrap gap-3">
                    <!-- Search Form -->
                    <form action="<?php echo e(url()->current()); ?>" method="GET" class="d-flex align-items-center gap-2">
                        <input type="search" name="searchValue" class="form-control form-control-sm search-input" 
                               style="width: 260px;" placeholder="<?php echo e(translate('search_by_name_or_email_or_phone')); ?>" 
                               value="<?php echo e(request('searchValue')); ?>">
                        <button type="submit" class="btn btn-sm btn-primary"><i class="fi fi-rr-search"></i> <?php echo e(translate('search')); ?></button>
                    </form>

                    <!-- Filter by Role -->
                    <form action="<?php echo e(url()->current()); ?>" method="GET" class="d-flex align-items-center gap-2">
                        <select name="vendor_role_id" class="form-select form-select-sm" style="width: 180px;">
                            <option value="all"><?php echo e(translate('all_roles')); ?></option>
                            <?php $__currentLoopData = $employee_roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($role->id); ?>" <?php echo e(request('vendor_role_id') == $role->id ? 'selected' : ''); ?>><?php echo e(ucfirst($role->name)); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <button type="submit" class="btn btn-sm btn-secondary"><?php echo e(translate('filter')); ?></button>
                    </form>

                    <!-- Add New Button -->
                    <a href="<?php echo e(route('vendor.employee.add')); ?>" class="btn btn-sm btn-primary">
                        <i class="fi fi-rr-plus-small"></i> <?php echo e(translate('add_new')); ?>

                    </a>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr><th>#</th><th><?php echo e(translate('name')); ?></th><th><?php echo e(translate('email')); ?></th><th><?php echo e(translate('phone')); ?></th><th><?php echo e(translate('role')); ?></th><th><?php echo e(translate('status')); ?></th><th class="text-center"><?php echo e(translate('action')); ?></th></tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td class="fw-medium"><?php echo e($employees->firstItem() + $key); ?></td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <img src="<?php echo e($employee->image_full_url); ?>" width="40" height="40" class="rounded-circle object-fit-cover" alt="">
                                    <span><?php echo e($employee->name); ?></span>
                                </div>
                            </td>
                            <td><?php echo e($employee->email); ?></td>
                            <td><?php echo e($employee->phone); ?></td>
                            <td><?php echo e($employee->role->name ?? translate('role_not_found')); ?></td>
                            <td>
                                <form action="<?php echo e(route('vendor.employee.status-update')); ?>" method="POST" id="emp-status-<?php echo e($employee->id); ?>" class="no-reload-form">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="id" value="<?php echo e($employee->id); ?>">
                                    <label class="switcher">
                                        <input class="switcher_input custom-modal-plugin" type="checkbox" name="status" value="1" <?php echo e($employee->status ? 'checked' : ''); ?>

                                               data-modal-type="input-change-form" data-modal-form="#emp-status-<?php echo e($employee->id); ?>"
                                               data-on-title="<?php echo e(translate('activate_employee')); ?>?" data-off-title="<?php echo e(translate('deactivate_employee')); ?>?"
                                               data-on-button-text="<?php echo e(translate('turn_on')); ?>" data-off-button-text="<?php echo e(translate('turn_off')); ?>">
                                        <span class="switcher_control"></span>
                                    </label>
                                </form>
                            </td>
                            <td class="text-center">
                                <div class="d-flex gap-2 justify-content-center">
                                    <a href="<?php echo e(route('vendor.employee.update', $employee->id)); ?>" class="btn btn-outline-primary btn-sm" title="<?php echo e(translate('edit')); ?>"><i class="fi fi-rr-pencil"></i></a>
                                    <a href="<?php echo e(route('vendor.employee.view', $employee->id)); ?>" class="btn btn-outline-info btn-sm" title="<?php echo e(translate('view')); ?>"><i class="fi fi-rr-eye"></i></a>
                                    <button type="button" class="btn btn-outline-danger btn-sm delete-employee-btn" data-id="<?php echo e($employee->id); ?>" title="<?php echo e(translate('delete')); ?>"><i class="fi fi-rr-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="7" class="text-center py-5"><?php echo e(translate('no_employee_found')); ?></td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="mt-4 d-flex justify-content-end"><?php echo e($employees->links()); ?></div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
<script>
// SweetAlert2 delete (using event delegation for dynamic elements)
$(document).on('click', '.delete-employee-btn', function() {
    let id = $(this).data('id');
    Swal.fire({
        title: '<?php echo e(translate("are_you_sure")); ?>?',
        text: '<?php echo e(translate("delete_employee_warning")); ?>',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: '<?php echo e(translate("yes_delete_it")); ?>',
        cancelButtonText: '<?php echo e(translate("cancel")); ?>'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: '<?php echo e(translate("processing")); ?>',
                text: '<?php echo e(translate("please_wait")); ?>',
                allowOutsideClick: false,
                didOpen: () => { Swal.showLoading(); }
            });
            
            fetch('<?php echo e(route("vendor.employee.delete")); ?>', {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ id: id })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: '<?php echo e(translate("deleted")); ?>',
                        text: data.message,
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => location.reload());
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: '<?php echo e(translate("error")); ?>',
                        text: data.message
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: '<?php echo e(translate("error")); ?>',
                    text: '<?php echo e(translate("something_went_wrong")); ?>'
                });
            });
        }
    });
});
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.vendor.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\musas\Desktop\softwares\6valley\POSA-latest version\POSA\resources\views/vendor-views/employee/list.blade.php ENDPATH**/ ?>