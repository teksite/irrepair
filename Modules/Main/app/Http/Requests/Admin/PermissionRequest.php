<?php

namespace Modules\Main\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PermissionRequest extends FormRequest
{

    const default = [
        'title' => 'required|string|min:3|max:100|unique:permissions,title',
        'description' => 'nullable|string|max:200'
    ];

    public function rules(): array
    {
        if (request()->method() == 'POST') {
            return self::default;

        } elseif (request()->method() == 'PATCH' || request()->method() == 'PUT') {
            return array_merge(self::default,
                [
                    'title' => ['required', 'string', 'min:3', 'max:100', Rule::unique('permissions')->ignore($this->permission->id)]
                ]
            );
        }
        return [
            'nodata' => 'required|string|min:3|max:100|regex:/^[a-z0-9]+$/i',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if (request()->method() == 'POST') {
            return auth()->check() && auth()->user()->can("permission-create");
        } elseif (request()->method() == 'PATCH' || request()->method() == 'PUT') {
            return auth()->check() && auth()->user()->can("permission-edit");
        }
        return false;
    }
}
