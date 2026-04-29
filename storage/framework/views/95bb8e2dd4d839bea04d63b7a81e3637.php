

<?php $__env->startSection('title', translate('employee_role_setup')); ?>

<?php $__env->startSection('content'); ?>
<div class="content container-fluid">
    <div class="row g-4">
        
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h4 class="mb-3 text-primary"><i class="fi fi-sr-shield-check me-2"></i> <?php echo e(translate('create_new_role')); ?></h4>
                    <form action="<?php echo e(route('vendor.employee.role.add')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="mb-3">
                            <label for="role_name" class="form-label"><?php echo e(translate('role_name')); ?> <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="role_name" class="form-control" value="<?php echo e(old('name')); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><?php echo e(translate('module_access')); ?> <span class="text-danger">*</span></label>
                            <div class="d-flex justify-content-end mb-2"><div class="form-check"><input class="form-check-input" type="checkbox" id="selectAllModules"> <label class="form-check-label small"><?php echo e(translate('select_all')); ?></label></div></div>
                            <div class="row g-2">
                                <?php $__currentLoopData = $vendorRolePermissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $perm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-12">
                                    <div class="form-check border rounded px-3 py-2">
                                        <input class="form-check-input module-checkbox" type="checkbox" name="modules[]" value="<?php echo e($perm); ?>" id="mod_<?php echo e($perm); ?>">
                                        <label class="form-check-label text-capitalize w-100" for="mod_<?php echo e($perm); ?>">
                                            <i class="fi fi-rr-<?php echo e(match($perm) {
                                                'dashboard' => 'chart-histogram',
                                                'pos_management' => 'shop',
                                                'order_management' => 'shopping-cart',
                                                'product_management' => 'box-open',
                                                default => 'shield-check'
                                            }); ?> me-2"></i> <?php echo e(str_replace('_', ' ', $perm)); ?>

                                        </label>
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100"><?php echo e(translate('save_role')); ?></button>
                    </form>
                </div>
            </div>
        </div>

        
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                        <h4 class="mb-0"><?php echo e(translate('role_list')); ?> <span class="badge bg-info"><?php echo e($roles->total()); ?></span></h4>
                        <form action="<?php echo e(url()->current()); ?>" method="GET" class="d-flex gap-2">
                            <input type="search" name="searchValue" class="form-control form-control-sm" placeholder="<?php echo e(translate('search_roles')); ?>" value="<?php echo e(request('searchValue')); ?>">
                            <button type="submit" class="btn btn-sm btn-primary"><i class="fi fi-rr-search"></i></button>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead><tr><th><?php echo e(translate('SL')); ?></th><th><?php echo e(translate('role_name')); ?></th><th><?php echo e(translate('module_access')); ?></th><th><?php echo e(translate('status')); ?></th><th class="text-center"><?php echo e(translate('action')); ?></th></tr></thead>
                            <tbody>
                                <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($roles->firstItem() + $key); ?></td>
                                    <td class="fw-medium"><?php echo e($role->name); ?></td>
                                    <td>
                                        <?php $mods = json_decode($role->module_access ?? '[]', true); ?>
                                        <?php $__currentLoopData = array_slice($mods, 0, 2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <span class="badge bg-secondary me-1"><?php echo e(str_replace('_', ' ', $mod)); ?></span>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(count($mods) > 2): ?> <span class="badge bg-light text-dark">+<?php echo e(count($mods)-2); ?></span> <?php endif; ?>
                                    </td>
                                    <td>
                                        <form action="<?php echo e(route('vendor.employee.role.status-update')); ?>" method="POST" id="role-status-<?php echo e($role->id); ?>">
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" name="id" value="<?php echo e($role->id); ?>">
                                            <label class="switcher">
                                                <input class="switcher_input custom-modal-plugin" type="checkbox" name="status" value="1" <?php echo e($role->status ? 'checked' : ''); ?>

                                                       data-modal-type="input-change-form" data-modal-form="#role-status-<?php echo e($role->id); ?>">
                                                <span class="switcher_control"></span>
                                            </label>
                                        </form>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex gap-2">
                                            <a href="<?php echo e(route('vendor.employee.role.update', $role->id)); ?>" class="btn btn-outline-primary btn-sm"><i class="fi fi-rr-pencil"></i></a>
                                            <button type="button" class="btn btn-outline-danger btn-sm" onclick="deleteRole(<?php echo e($role->id); ?>)"><i class="fi fi-rr-trash"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3 d-flex justify-content-end"><?php echo e($roles->links()); ?></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
<script>
document.getElementById('selectAllModules')?.addEventListener('change', function(e) {
    document.querySelectorAll('.module-checkbox').forEach(cb => cb.checked = e.target.checked);
});

function deleteRole(id) {
    Swal.fire({
        title: '<?php echo e(translate("are_you_sure")); ?>?',
        text: '<?php echo e(translate("delete_role_warning")); ?>',
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
            
            fetch('<?php echo e(route("vendor.employee.role.delete")); ?>', {
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
}
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.vendor.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\musas\Desktop\softwares\6valley\POSA-latest version\POSA\resources\views/vendor-views/employee/role/create.blade.php ENDPATH**/ ?>