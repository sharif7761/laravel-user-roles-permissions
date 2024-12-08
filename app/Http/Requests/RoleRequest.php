<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        $roleId = $this->route('role'); // Get the role ID from the route if updating

        if ($this->isMethod('post')) {
            // For creation
            return [
                'name' => 'required|string|max:255|unique:roles,name',
                'permissions' => 'nullable|array',
                'permissions.*' => 'exists:permissions,id',
            ];
        }

        if ($this->isMethod('put') || $this->isMethod('patch')) {
            // For update
            return [
                'name' => 'required|string|max:255|unique:roles,name,' . $roleId,
                'permissions' => 'nullable|array',
                'permissions.*' => 'exists:permissions,id',
            ];
        }

        return [];
    }

    /**
     * Get custom messages for validation errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'The role name is required.',
            'name.unique' => 'The role name has already been taken.',
            'permissions.*.exists' => 'One or more permissions do not exist.',
        ];
    }
}
