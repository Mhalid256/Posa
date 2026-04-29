<?php

namespace App\Http\Requests\Vendor;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VendorEmployeeUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('seller')->check();
    }

    public function rules(): array
{
    $id = $this->route('id') ?? $this->input('id');

    return [
        'id'              => ['required', 'integer', 'exists:vendor_employees,id'],
        'name'            => ['required', 'string', 'max:191'],
        'phone'           => ['required', 'string', 'max:20'],
        'email'           => ['required', 'email', 'max:191', Rule::unique('vendor_employees', 'email')->ignore($id)],
        'vendor_role_id'  => ['required', 'integer', 'exists:vendor_roles,id'],  // Changed from role_id
        'password'        => ['nullable', 'string', 'min:8', 'confirmed'],
        'image'           => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif,bmp', 'max:5120'],
        'identify_type'   => ['nullable', 'in:nid,passport'],
        'identify_number' => ['nullable', 'string', 'max:100'],
        'identity_image'  => ['nullable', 'array'],
        'identity_image.*'=> ['image', 'mimes:jpg,jpeg,png,gif,bmp', 'max:5120'],
    ];
}
}
