<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RefreshEmployeePermissions
{
    public function handle($request, Closure $next)
    {
        if (Auth::guard('vendor_employee')->check()) {
            $employee = Auth::guard('vendor_employee')->user();

            // 1. Bust the cached 'role' Eloquent relation
            $employee->unsetRelation('role');
            $employee->load('role');

            // 2. Bust the cached 'module_access' accessor value.
            //    Laravel stores computed accessor results in the model's
            //    attribute bag — forgetting it forces a fresh DB read on
            //    the next call, so added permissions show up immediately.
            unset($employee->module_access);
        }
        return $next($request);
    }
}