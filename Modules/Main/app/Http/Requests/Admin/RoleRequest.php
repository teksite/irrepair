<?php

namespace Modules\Main\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoleRequest extends FormRequest
{
    const default = [
        'title' => 'required|string|min:3|max:100|unique:permissions,title',
        'description' => 'nullable|string|max:200',
        'permissions' => 'required|array',
        'permissions.*' => 'required|integer|exists:permissions,id'
    ];

    public function rules(): array
    {
        if (request()->method() == 'POST') {
            return self::default;

        } elseif (request()->method() == 'PATCH' || request()->method() == 'PUT') {
            return array_merge(
                self::default,
                [
                    'title' => ['required', 'string', 'min:3', 'max:100', Rule::unique('roles')->ignore($this->role->id)]
                ]
            );
        }
        return [
            'nodata' => 'required|string|min:3|max:100|regex:/^[a-z0-9]+$/i',
        ];
    }


    public function authorize(): bool
    {
        if (request()->method() == 'POST') {
            return auth()->check() && auth()->user()->can("role-create");
        } elseif (request()->method() == 'PATCH' || request()->method() == 'PUT') {
            return auth()->check() && auth()->user()->can("role-edit");
        }
        return false;
    }
}
