<?php

namespace Modules\Shop\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Main\Enums\PublishStatusEnum;

class CategoryRequest extends FormRequest
{
    public function rules(): array
    {

        if (request()->method() == 'POST') {
            return $this->defaultRules();
        } elseif (request()->method() == 'PATCH' || request()->method() == 'PUT') {
            return array_merge($this->defaultRules(),
                [
                    'title' => ['required', 'string', Rule::unique('shop_categories', 'title')->ignore($this->category->id)],
                ]
            );
        }
        return [
            'nodata' => 'required|email|string|min:3|max:100|regex:/^[a-z0-9]+$/i',
        ];
    }


    public function authorize(): bool
    {
        if (request()->method() == 'POST') {
            return auth()->check() && auth()->user()->can("product-category-create");
        } elseif (request()->method() == 'PATCH' || request()->method() == 'PUT') {
            return auth()->check() && auth()->user()->can("product-category-edit");
        }
        return false;
    }

    public function defaultRules(): array
    {
        return [
            'title' => 'required|string|unique:shop_categories,title',
            'body' => 'nullable',
            'featured_image' => 'nullable',
        ];
    }
}
