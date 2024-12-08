<?php

namespace Modules\Menu\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class MenuItemRequest extends FormRequest
{

    public function rules(): array
    {

        if (request()->method() == 'POST') {
            return $this->defaultRules();
        } elseif (request()->method() == 'PATCH' || request()->method() == 'PUT') {
            return [
                'items' => ['nullable', 'array'],
                'items.*' => ['required', 'array'],
                'items.*.url' => ['nullable', 'string'],
                'items.*.title' => ['required', 'string'],
                'items.*.subtitle' => ['nullable', 'string'],
                'items.*.position' => ['required', 'integer'],
                'items.*.classes' => ['nullable', 'string'],
                'items.*.pre_icon' => ['nullable', 'string'],
                'items.*.next_icon' => ['nullable', 'string'],
                'items.*.image' => ['nullable', 'string'],
                'items.*.id' => ['nullable', 'string'],
                'items.*.parent_id' => ['nullable', 'integer'],
            ];
        }
        return [
            'nodata' => 'required|string|min:3|max:100|regex:/^[a-z0-9]+$/i',
        ];
    }

    public function authorize(): bool
    {

        return auth()->check() && auth()->user()->can("menu-edit");

    }

    public function defaultRules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'url' => 'nullable|string|max:255',
        ];

    }
}
