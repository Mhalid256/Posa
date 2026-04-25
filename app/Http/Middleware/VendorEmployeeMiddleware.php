<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorEmployeeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * Allows access if:
     *   (a) A real seller is logged in via 'seller' guard (status = approved), OR
     *   (b) A vendor employee is logged in via 'vendor_employee' guard (status = 1/active)
     *
     * @param Request $request
     * @param Closure $next
     * @param string|null $module  Optional module key to check permission for
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $module = null): mixed
    {
        // ── Case A: Real seller/vendor is logged in ──────────────────────────
        if (Auth::guard('seller')->check() && Auth::guard('seller')->user()->status == 'approved') {
            return $next($request);
        }

        // ── Case B: Vendor employee is logged in ─────────────────────────────
        if (Auth::guard('vendor_employee')->check()) {
            $employee = Auth::guard('vendor_employee')->user();

            // Check employee is still active
            if (!$employee->status) {
                Auth::guard('vendor_employee')->logout();
                session()->flash('error', translate('your_account_has_been_suspended'));
                return redirect()->route('vendor.employee.auth.login');
            }

            // If a specific module permission is required, check it
            if ($module && !$employee->hasModuleAccess($module)) {
                abort(403, translate('access_denied'));
            }

            // Share employee info with all views for sidebar rendering
            view()->share('vendorEmployee', $employee);
            view()->share('isVendorEmployee', true);

            return $next($request);
        }

        // ── Not authenticated at all ─────────────────────────────────────────
        // Redirect employees to their login, vendors to vendor login
        return redirect()->route('vendor.employee.auth.login');
    }
}
