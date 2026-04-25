@extends('layouts.vendor.app')

@section('title', translate('employee_details'))

@section('content')
    <div class="content container-fluid">
        <div class="mb-3">
            <h2 class="h1 mb-0 text-capitalize d-flex align-items-center gap-2">
                <img src="{{ dynamicAsset(path: 'public/assets/back-end/img/employee.png') }}" width="20" alt="">
                {{ translate('employee_details') }}
            </h2>
        </div>

        <div class="card mt-3">
            <div class="card-body">
                <h3 class="mb-3 text-primary">#{{ translate('EMP') }} {{ $employee->id }}</h3>
                <div class="row g-2">
                    <div class="col-lg-7 col-xl-8">
                        <div class="media align-items-center flex-wrap flex-sm-nowrap gap-3">
                            <img width="220" class="rounded border"
                                 src="{{ getStorageImages(path: $employee->image_full_url ?? [], type: 'backend-profile') }}"
                                 alt="{{ $employee->name }}">
                            <div class="media-body">
                                <div class="text-capitalize mb-4">
                                    <h3 class="mb-2">{{ $employee->name }}</h3>
                                    <p class="text-muted">{{ $employee->role?->name ?? translate('role_not_found') }}</p>
                                </div>
                                <ul class="d-flex flex-column gap-2 px-0 list-unstyled">
                                    <li class="d-flex gap-2 align-items-center">
                                        <i class="fi fi-rr-phone-flip"></i>
                                        <a href="tel:{{ $employee->phone }}" class="text-dark">{{ $employee->phone }}</a>
                                    </li>
                                    <li class="d-flex gap-2 align-items-center">
                                        <i class="fi fi-rr-envelope"></i>
                                        <a href="mailto:{{ $employee->email }}" class="text-dark">{{ $employee->email }}</a>
                                    </li>
                                    @if($employee->identify_type)
                                        <li class="d-flex gap-2 align-items-center">
                                            <i class="fi fi-rr-id-badge"></i>
                                            <span class="text-uppercase">
                                                {{ $employee->identify_type }} — {{ $employee->identify_number ?? translate('N/A') }}
                                            </span>
                                        </li>
                                    @endif
                                    <li class="d-flex gap-2 align-items-center">
                                        <i class="fi fi-rr-calendar-day"></i>
                                        <span>{{ translate('joined') }}: {{ $employee->created_at->format('d/m/Y') }}</span>
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
                                    <h5 class="mb-0 text-capitalize">{{ translate('access_permissions') }}:</h5>
                                </div>
                                @if($employee->role)
                                    <div class="tags d-flex gap-2 flex-wrap mt-2">
                                        @foreach(json_decode($employee->role->module_access ?? '[]') as $module)
                                            <span class="badge badge-info text-bg-info text-capitalize">
                                                {{ str_replace('_', ' ', $module) }}
                                            </span>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-muted small mb-0">{{ translate('no_permissions_assigned') }}</p>
                                @endif
                            </div>

                            @if(!empty($employee->identify_images))
                                <div class="bg-white rounded p-3 mt-3">
                                    <h6 class="mb-2">{{ translate('identity_documents') }}</h6>
                                    <div class="row g-2">
                                        @foreach($employee->identify_images as $img)
                                            <div class="col-6">
                                                <img src="{{ getStorageImages(path: $img, type: 'backend-basic') }}"
                                                     class="img-fluid rounded border" alt="">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-12 mt-3">
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('vendor.employee.list') }}" class="btn btn-outline-secondary">
                                <i class="fi fi-rr-arrow-left"></i> {{ translate('back') }}
                            </a>
                            <a href="{{ route('vendor.employee.update', $employee->id) }}" class="btn btn-primary">
                                <i class="fi fi-rr-pencil"></i> {{ translate('edit') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
