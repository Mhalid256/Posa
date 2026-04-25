<?php

namespace App\Http\Requests\Vendor;

use Illuminate\Foundation\Http\FormRequest;

class VendorRoleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('seller')->check();
    }

    public function rules(): array
    {
        return [
            'name'      => ['required', 'string', 'max:191'],
            'modules'   => ['required', 'array', 'min:1'],
            'modules.*' => ['required', 'string'],
        ];
    }
}
