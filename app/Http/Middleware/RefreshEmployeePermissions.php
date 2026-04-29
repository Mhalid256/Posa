<?php


namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RefreshEmployeePermissions
{
    public function handle(Request $request, Closure $next)
    {
        if (auth('vendor_employee')->check()) {
            $employee = auth('vendor_employee')->user();
            // Reload role relationship to get latest permissions
            $employee->load('role');
            // Optionally store in session for quick access
            session(['employee_modules' => $employee->module_access]);
        }
        return $next($request);
    }
}