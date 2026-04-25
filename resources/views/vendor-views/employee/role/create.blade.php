@extends('layouts.vendor.app')

@section('title', translate('employee_role_setup'))

@section('content')
<div class="content container-fluid">
    <div class="row g-4">
        {{-- Left: Create role form --}}
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h4 class="mb-3 text-primary"><i class="fi fi-sr-shield-check me-2"></i> {{ translate('create_new_role') }}</h4>
                    <form action="{{ route('vendor.employee.role.add') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="role_name" class="form-label">{{ translate('role_name') }} <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="role_name" class="form-control" value="{{ old('name') }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{ translate('module_access') }} <span class="text-danger">*</span></label>
                            <div class="d-flex justify-content-end mb-2"><div class="form-check"><input class="form-check-input" type="checkbox" id="selectAllModules"> <label class="form-check-label small">{{ translate('select_all') }}</label></div></div>
                            <div class="row g-2">
                                @foreach($vendorRolePermissions as $perm)
                                <div class="col-12">
                                    <div class="form-check border rounded px-3 py-2">
                                        <input class="form-check-input module-checkbox" type="checkbox" name="modules[]" value="{{ $perm }}" id="mod_{{$perm}}">
                                        <label class="form-check-label text-capitalize w-100" for="mod_{{$perm}}">
                                            <i class="fi fi-rr-{{ match($perm) {
                                                'dashboard' => 'chart-histogram',
                                                'pos_management' => 'shop',
                                                'order_management' => 'shopping-cart',
                                                'product_management' => 'box-open',
                                                default => 'shield-check'
                                            } }} me-2"></i> {{ str_replace('_', ' ', $perm) }}
                                        </label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">{{ translate('save_role') }}</button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Right: Role list --}}
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                        <h4 class="mb-0">{{ translate('role_list') }} <span class="badge bg-info">{{ $roles->total() }}</span></h4>
                        <form action="{{ url()->current() }}" method="GET" class="d-flex gap-2">
                            <input type="search" name="searchValue" class="form-control form-control-sm" placeholder="{{ translate('search_roles') }}" value="{{ request('searchValue') }}">
                            <button type="submit" class="btn btn-sm btn-primary"><i class="fi fi-rr-search"></i></button>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead><tr><th>{{ translate('SL') }}</th><th>{{ translate('role_name') }}</th><th>{{ translate('module_access') }}</th><th>{{ translate('status') }}</th><th class="text-center">{{ translate('action') }}</th></tr></thead>
                            <tbody>
                                @foreach($roles as $key => $role)
                                <tr>
                                    <td>{{ $roles->firstItem() + $key }}</td>
                                    <td class="fw-medium">{{ $role->name }}</td>
                                    <td>
                                        @php $mods = json_decode($role->module_access ?? '[]', true); @endphp
                                        @foreach(array_slice($mods, 0, 2) as $mod)
                                            <span class="badge bg-secondary me-1">{{ str_replace('_', ' ', $mod) }}</span>
                                        @endforeach
                                        @if(count($mods) > 2) <span class="badge bg-light text-dark">+{{ count($mods)-2 }}</span> @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('vendor.employee.role.status-update') }}" method="POST" id="role-status-{{ $role->id }}">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $role->id }}">
                                            <label class="switcher">
                                                <input class="switcher_input custom-modal-plugin" type="checkbox" name="status" value="1" {{ $role->status ? 'checked' : '' }}
                                                       data-modal-type="input-change-form" data-modal-form="#role-status-{{ $role->id }}">
                                                <span class="switcher_control"></span>
                                            </label>
                                        </form>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('vendor.employee.role.update', $role->id) }}" class="btn btn-outline-primary btn-sm"><i class="fi fi-rr-pencil"></i></a>
                                            <button type="button" class="btn btn-outline-danger btn-sm" onclick="deleteRole({{ $role->id }})"><i class="fi fi-rr-trash"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3 d-flex justify-content-end">{{ $roles->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
document.getElementById('selectAllModules')?.addEventListener('change', function(e) {
    document.querySelectorAll('.module-checkbox').forEach(cb => cb.checked = e.target.checked);
});

function deleteRole(id) {
    if (!confirm('{{ translate("delete_role_confirmation") }}')) return;
    fetch('{{ route("vendor.employee.role.delete") }}', {
        method: 'DELETE',
        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Content-Type': 'application/json' },
        body: JSON.stringify({ id: id })
    }).then(r => r.json()).then(data => {
        if (data.success) toastr.success(data.message), setTimeout(() => location.reload(), 800);
        else toastr.error(data.message);
    });
}
</script>
@endpush