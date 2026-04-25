<?php

namespace App\Enums\ViewPaths\Vendor;

/**
 * View paths and URIs for the Vendor Employee Role section.
 */
enum VendorEmployeeRole: string
{
    case DEFAULT = 'default';

    const INDEX = [
        URI  => 'index',
        VIEW => 'vendor-views.employee.role.create',
    ];

    const UPDATE = [
        URI  => 'update',
        VIEW => 'vendor-views.employee.role.edit',
    ];
}
