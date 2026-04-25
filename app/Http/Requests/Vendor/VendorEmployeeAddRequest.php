<?php

namespace App\Http\Requests\Vendor;

use Illuminate\Foundation\Http\FormRequest;

class VendorEmployeeAddRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('seller')->check();
    }

    public function rules(): array
    {
        return [
            'name'            => ['required', 'string', 'max:191'],
            'phone'           => ['required', 'string', 'max:20'],
            'email'           => ['required', 'email', 'max:191', 'unique:vendor_employees,email'],
            'vendor_role_id'  => ['required', 'integer', 'exists:vendor_roles,id'],
            'password'        => ['required', 'string', 'min:8', 'confirmed'],
            'image'           => ['required', 'image', 'mimes:jpg,jpeg,png,gif,bmp', 'max:5120'],
            'identify_type'   => ['nullable', 'in:nid,passport'],
            'identify_number' => ['nullable', 'string', 'max:100'],
            'identity_image'  => ['nullable', 'array'],
            'identity_image.*'=> ['image', 'mimes:jpg,jpeg,png,gif,bmp', 'max:5120'],
        ];
    }
}
