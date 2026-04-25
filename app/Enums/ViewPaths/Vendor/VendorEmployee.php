<?php

namespace App\Enums\ViewPaths\Vendor;

/**
 * View paths and URIs for the Vendor Employee section.
 *
 * Usage:  view(VendorEmployee::LIST[VIEW])
 *         route based on VendorEmployee::LIST[URI]
 */
enum VendorEmployee: string
{
    case DEFAULT = 'default';

    const LIST = [
        URI  => 'list',
        VIEW => 'vendor-views.employee.list',
    ];

    const ADD = [
        URI  => 'add',
        VIEW => 'vendor-views.employee.add-new',
    ];

    const UPDATE = [
        URI  => 'update',
        VIEW => 'vendor-views.employee.edit',
    ];

    const VIEW_DETAILS = [
        URI  => 'view',
        VIEW => 'vendor-views.employee.view',
    ];
}
