

<?php $__env->startSection('title', translate('edit_role')); ?>

<?php $__env->startSection('content'); ?>
<div class="content container-fluid">
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="mb-0"><?php echo e(translate('edit_role')); ?>: <span class="text-primary"><?php echo e($role->name); ?></span></h4>
                <a href="<?php echo e(route('vendor.employee.role.index')); ?>" class="btn btn-outline-secondary btn-sm"><i class="fi fi-rr-arrow-left"></i> <?php echo e(translate('back')); ?></a>
            </div>
            <form action="<?php echo e(route('vendor.employee.role.update', $role->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="id" value="<?php echo e($role->id); ?>">
                <div class="row g-4">
                    <div class="col-md-5">
                        <div class="mb-3">
                            <label class="form-label"><?php echo e(translate('role_name')); ?> <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" value="<?php echo e($role->name); ?>" required>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <label class="form-label"><?php echo e(translate('module_access')); ?> <span class="text-danger">*</span></label>
                        <div class="d-flex justify-content-end mb-2"><div class="form-check"><input class="form-check-input" type="checkbox" id="selectAllEdit"> <label class="form-check-label small"><?php echo e(translate('select_all')); ?></label></div></div>
                        <?php $currentAccess = json_decode($role->module_access ?? '[]', true); ?>
                        <div class="row g-2">
                            <?php $__currentLoopData = $vendorRolePermissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $perm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-6">
                                <div class="form-check border rounded px-3 py-2">
                                    <input class="form-check-input module-checkbox" type="checkbox" name="modules[]" value="<?php echo e($perm); ?>" id="edit_<?php echo e($perm); ?>" <?php echo e(in_array($perm, $currentAccess) ? 'checked' : ''); ?>>
                                    <label class="form-check-label text-capitalize" for="edit_<?php echo e($perm); ?>">
                                        <i class="fi fi-rr-<?php echo e(match($perm) { 'dashboard' => 'chart-histogram', default => 'shield-check' }); ?> me-2"></i> <?php echo e(str_replace('_', ' ', $perm)); ?>

                                    </label>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
                <div class="mt-4 d-flex justify-content-end gap-2">
                    <a href="<?php echo e(route('vendor.employee.role.index')); ?>" class="btn btn-secondary"><?php echo e(translate('cancel')); ?></a>
                    <button type="submit" class="btn btn-primary"><?php echo e(translate('update_role')); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
<script>
document.getElementById('selectAllEdit')?.addEventListener('change', function(e) {
    document.querySelectorAll('.module-checkbox').forEach(cb => cb.checked = e.target.checked);
});
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.vendor.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\musas\Desktop\softwares\6valley\POSA-latest\POSA\resources\views/vendor-views/employee/role/edit.blade.php ENDPATH**/ ?>