<?php

if (!function_exists('canAccessModule')) {
    /**
     * Check if the currently authenticated user (real vendor OR vendor employee)
     * has access to a given module in the vendor panel sidebar.
     *
     * Real vendors always return true (they own the shop).
     * Vendor employees return true only if the module is in their role's module_access.
     *
     * Usage in blade:  @if(canAccessModule('order_management')) ... @endif
     *
     * @param string $module  One of the VENDOR_ROLE_MODULE_PERMISSION keys
     * @return bool
     */
    function canAccessModule(string $module): bool
    {
        // Real seller/vendor — always has full access
        if (auth('seller')->check()) {
            return true;
        }

        // Vendor employee — call getFreshModuleAccess() directly,
        // never $employee->module_access (accessor is cached by Laravel
        // after first call and won't reflect mid-session role changes).
        if (auth('vendor_employee')->check()) {
            $employee = auth('vendor_employee')->user();
            return in_array($module, $employee->getFreshModuleAccess());
        }

        return false;
    }
}

if (!function_exists('currentVendorId')) {
    /**
     * Get the vendor ID regardless of whether it's a real seller
     * or a vendor employee who is logged in.
     *
     * Use this anywhere you currently use auth('seller')->id()
     * to make sure vendor employee sessions also work correctly.
     *
     * @return int|null
     */
    function currentVendorId(): ?int
    {
        if (auth('seller')->check()) {
            return auth('seller')->id();
        }

        if (auth('vendor_employee')->check()) {
            return auth('vendor_employee')->user()->vendor_id;
        }

        return null;
    }
}

if (!function_exists('isVendorEmployee')) {
    /**
     * Returns true if the current session is a vendor employee (not the real vendor).
     * Useful in blades to show/hide employee-specific UI elements.
     *
     * @return bool
     */
    function isVendorEmployee(): bool
    {
        return auth('vendor_employee')->check();
    }
}


if (!function_exists('fileUploader')) {
    function fileUploader($file, $path, $width = null, $old = null)
    {
        // Delete old file if provided
        if ($old && Storage::disk('public')->exists($old)) {
            Storage::disk('public')->delete($old);
        }
        $fileName = Str::random(20) . '.' . $file->getClientOriginalExtension();
        $filePath = $file->storeAs($path, $fileName, 'public');
        return $filePath;
    }
}