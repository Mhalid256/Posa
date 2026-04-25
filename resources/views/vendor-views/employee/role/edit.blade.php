@extends('layouts.vendor.app')

@section('title', translate('edit_role'))

@section('content')
<div class="content container-fluid">
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="mb-0">{{ translate('edit_role') }}: <span class="text-primary">{{ $role->name }}</span></h4>
                <a href="{{ route('vendor.employee.role.index') }}" class="btn btn-outline-secondary btn-sm"><i class="fi fi-rr-arrow-left"></i> {{ translate('back') }}</a>
            </div>
            <form action="{{ route('vendor.employee.role.update', $role->id) }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $role->id }}">
                <div class="row g-4">
                    <div class="col-md-5">
                        <div class="mb-3">
                            <label class="form-label">{{ translate('role_name') }} <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" value="{{ $role->name }}" required>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <label class="form-label">{{ translate('module_access') }} <span class="text-danger">*</span></label>
                        <div class="d-flex justify-content-end mb-2"><div class="form-check"><input class="form-check-input" type="checkbox" id="selectAllEdit"> <label class="form-check-label small">{{ translate('select_all') }}</label></div></div>
                        @php $currentAccess = json_decode($role->module_access ?? '[]', true); @endphp
                        <div class="row g-2">
                            @foreach($vendorRolePermissions as $perm)
                            <div class="col-md-6">
                                <div class="form-check border rounded px-3 py-2">
                                    <input class="form-check-input module-checkbox" type="checkbox" name="modules[]" value="{{ $perm }}" id="edit_{{$perm}}" {{ in_array($perm, $currentAccess) ? 'checked' : '' }}>
                                    <label class="form-check-label text-capitalize" for="edit_{{$perm}}">
                                        <i class="fi fi-rr-{{ match($perm) { 'dashboard' => 'chart-histogram', default => 'shield-check' } }} me-2"></i> {{ str_replace('_', ' ', $perm) }}
                                    </label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="mt-4 d-flex justify-content-end gap-2">
                    <a href="{{ route('vendor.employee.role.index') }}" class="btn btn-secondary">{{ translate('cancel') }}</a>
                    <button type="submit" class="btn btn-primary">{{ translate('update_role') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
document.getElementById('selectAllEdit')?.addEventListener('change', function(e) {
    document.querySelectorAll('.module-checkbox').forEach(cb => cb.checked = e.target.checked);
});
</script>
@endpush