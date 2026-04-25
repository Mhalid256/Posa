@extends('layouts.vendor.app')

@section('title', translate('employee_list'))

@section('content')
<div class="content container-fluid">
    <div class="mb-4">
        <h2 class="h1 mb-0 text-capitalize d-flex align-items-center gap-2">
            <img src="{{ dynamicAsset('public/assets/back-end/img/employee.png') }}" width="25" alt="">
            {{ translate('employee_list') }}
        </h2>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
                <h3 class="mb-0">{{ translate('employee_table') }} <span class="badge bg-info text-white">{{ $employees->total() }}</span></h3>
                <div class="d-flex gap-3 flex-wrap">
                    <form action="{{ url()->current() }}" method="GET" class="d-flex gap-2">
                        <input type="search" name="searchValue" class="form-control form-control-sm" placeholder="{{ translate('search_by_name_or_email_or_phone') }}" value="{{ request('searchValue') }}">
                        <button type="submit" class="btn btn-sm btn-primary"><i class="fi fi-rr-search"></i> {{ translate('search') }}</button>
                    </form>
                    <form action="{{ url()->current() }}" method="GET" class="d-flex gap-2">
                        <select name="vendor_role_id" class="form-select form-select-sm">
                            <option value="all">{{ translate('all_roles') }}</option>
                            @foreach($employee_roles as $role)
                                <option value="{{ $role->id }}" {{ request('vendor_role_id') == $role->id ? 'selected' : '' }}>{{ ucfirst($role->name) }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-sm btn-secondary">{{ translate('filter') }}</button>
                    </form>
                    <a href="{{ route('vendor.employee.add') }}" class="btn btn-sm btn-primary">
                        <i class="fi fi-rr-plus-small"></i> {{ translate('add_new') }}
                    </a>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr><th>#</th><th>{{ translate('name') }}</th><th>{{ translate('email') }}</th><th>{{ translate('phone') }}</th><th>{{ translate('role') }}</th><th>{{ translate('status') }}</th><th class="text-center">{{ translate('action') }}</th></tr>
                    </thead>
                    <tbody>
                        @forelse($employees as $key => $employee)
                        <tr>
                            <td>{{ $employees->firstItem() + $key }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <img src="{{ getStorageImages(path: $employee->image_full_url ?? [], type: 'backend-profile') }}" width="40" height="40" class="rounded-circle object-fit-cover" alt="">
                                    <span class="fw-medium">{{ $employee->name }}</span>
                                </div>
                            </td>
                            <td>{{ $employee->email }}</td>
                            <td>{{ $employee->phone }}</td>
                            <td>{{ $employee->role->name ?? translate('role_not_found') }}</td>
                            <td>
                                <form action="{{ route('vendor.employee.status-update') }}" method="POST" id="emp-status-{{ $employee->id }}" class="no-reload-form">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $employee->id }}">
                                    <label class="switcher">
                                        <input class="switcher_input custom-modal-plugin" type="checkbox" name="status" value="1" {{ $employee->status ? 'checked' : '' }}
                                               data-modal-type="input-change-form" data-modal-form="#emp-status-{{ $employee->id }}"
                                               data-on-title="{{ translate('activate_employee') }}?" data-off-title="{{ translate('deactivate_employee') }}?"
                                               data-on-button-text="{{ translate('turn_on') }}" data-off-button-text="{{ translate('turn_off') }}">
                                        <span class="switcher_control"></span>
                                    </label>
                                </form>
                            </td>
                            <td class="text-center">
                                <div class="d-flex gap-2 justify-content-center">
                                    <a href="{{ route('vendor.employee.update', $employee->id) }}" class="btn btn-outline-primary btn-sm" title="{{ translate('edit') }}"><i class="fi fi-rr-pencil"></i></a>
                                    <a href="{{ route('vendor.employee.view', $employee->id) }}" class="btn btn-outline-info btn-sm" title="{{ translate('view') }}"><i class="fi fi-rr-eye"></i></a>
                                    <button type="button" class="btn btn-outline-danger btn-sm" title="{{ translate('delete') }}" onclick="deleteEmployee({{ $employee->id }})"><i class="fi fi-rr-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="7" class="text-center py-5">{{ translate('no_employee_found') }}</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4 d-flex justify-content-end">{{ $employees->links() }}</div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
function deleteEmployee(id) {
    if (!confirm('{{ translate("are_you_sure_delete_employee") }}?')) return;
    fetch('{{ route("vendor.employee.delete") }}', {
        method: 'DELETE',
        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Content-Type': 'application/json' },
        body: JSON.stringify({ id: id })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            toastr.success(data.message);
            setTimeout(() => location.reload(), 800);
        } else {
            toastr.error(data.message);
        }
    });
}
</script>
@endpush