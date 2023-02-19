<?php

namespace App\Domains\Authorization\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateRoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|unique:roles,name',
            'permission_ids' => 'required|array',
            'permission_ids.*' => 'exists:permissions,id',
        ];
    }
}
