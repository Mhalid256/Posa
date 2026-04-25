<?php

namespace App\Http\Controllers\Vendor\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class VendorEmployeeLoginController extends Controller
{
    /**
     * Show the employee login page.
     * If already logged in (as seller OR employee), redirect to dashboard.
     */
    public function getLoginView(): View|RedirectResponse
    {
        if (Auth::guard('seller')->check()) {
            return redirect()->route('vendor.dashboard.index');
        }
        if (Auth::guard('vendor_employee')->check()) {
            return redirect()->route('vendor.dashboard.index');
        }
        return view('vendor-views.employee.auth.login');
    }

    /**
     * Handle employee login form submission.
     */
    public function login(Request $request): RedirectResponse
    {
        $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $credentials = [
            'email'    => $request->input('email'),
            'password' => $request->input('password'),
        ];

        // Attempt login against the vendor_employee guard
        if (Auth::guard('vendor_employee')->attempt($credentials, $request->boolean('remember'))) {
            $employee = Auth::guard('vendor_employee')->user();

            // Check account is still active
            if (!$employee->status) {
                Auth::guard('vendor_employee')->logout();
                return back()->withErrors([
                    'email' => translate('your_account_has_been_suspended_contact_your_vendor'),
                ])->withInput(['email' => $request->email]);
            }

            // Store a flag in session so views/middleware know it's an employee session
            session(['is_vendor_employee' => true, 'vendor_employee_id' => $employee->id]);

            return redirect()->route('vendor.dashboard.index');
        }

        return back()->withErrors([
            'email' => translate('invalid_email_or_password'),
        ])->withInput(['email' => $request->email]);
    }

    /**
     * Log the employee out.
     */
    public function logout(): RedirectResponse
    {
        Auth::guard('vendor_employee')->logout();
        session()->forget(['is_vendor_employee', 'vendor_employee_id']);
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->route('vendor.employee.auth.login');
    }
}
