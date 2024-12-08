<?php

namespace Modules\Main\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TagRequest extends FormRequest
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
           return [
               'title' => 'required|string|max:255|unique:tags,title',
           ];

        } elseif (request()->method() == 'PATCH' || request()->method() == 'PUT') {
            return [
                'title' => ['required', 'string', Rule::unique('tags', 'title')->ignore($this->tag->id)],
            ];

        }
        return [
            'nodata' => 'required|string|min:3|max:100|regex:/^[a-z0-9]+$/i',
        ];
    }


    public function authorize(): bool
    {
       return auth()->check() && auth()->user()->can("admin");
    }
}
