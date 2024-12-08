<?php

namespace Modules\Menu\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MenuRequest extends FormRequest
{

    public function rules(): array
    {

        if (request()->method() == 'POST' || request()->method() == 'PATCH' || request()->method() == 'PUT') {
            return $this->defaultRules();
        }
        return [
            'nodata' => 'required|string|min:3|max:100|regex:/^[a-z0-9]+$/i',
        ];
    }

    public function authorize(): bool
    {
        if (request()->method() == 'POST') {
            return auth()->check() && auth()->user()->can("menu-create");
        } elseif (request()->method() == 'PATCH' || request()->method() == 'PUT') {
            return auth()->check() && auth()->user()->can("menu-edit");
        }
        return false;
    }

    public function defaultRules():array
    {
        return [
            'title'=>'required|string|min:3|max:100',
            'classes'=>'nullable|string',
        ];

    }
}
