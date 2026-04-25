<?php

namespace App\Http\Middleware;

use Closure;
use App\Utils\Helpers;
use Illuminate\Support\Facades\Auth;

class SellerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
     public function handle($request, Closure $next)
        {
            // Real vendor/seller is authenticated
            if (auth('seller')->check() && auth('seller')->user()->status == 'approved') {
                view()->share('isVendorEmployee', false);
                return $next($request);
            }

    //         // Vendor employee is authenticated
            if (auth('vendor_employee')->check()) {
                $employee = auth('vendor_employee')->user();
                if (!$employee->status) {
                    auth()->guard('vendor_employee')->logout();
                    return redirect()->route('vendor.employee.auth.login');
                }
    //             // Share employee context with all views (for sidebar permission checks)
                view()->share('vendorEmployee', $employee);
                view()->share('isVendorEmployee', true);
                return $next($request);
            }

    //         // Not authenticated as anything
            return redirect()->route('vendor.auth.login');
        }
}
