<?php

namespace Modules\Shop\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Main\Enums\PublishStatusEnum;

class ProductRequest extends FormRequest
{
    public function rules(): array
    {

        if (request()->method() == 'POST') {
            return $this->defaultRules();

        } elseif (request()->method() == 'PATCH' || request()->method() == 'PUT') {

            return array_merge($this->defaultRules(),
                [
                    'slug' => ['required', 'string', Rule::unique('shop_products', 'slug')->ignore($this->product->id)],
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
            return auth()->check() && auth()->user()->can("product-create");
        } elseif (request()->method() == 'PATCH' || request()->method() == 'PUT') {
            return auth()->check() && auth()->user()->can("product-edit");
        }
        return false;
    }

    public function defaultRules(): array
    {
        return [
            'category_id' => 'required|integer|exists:shop_categories,id',
            'title' => 'required|string|min:3|max:255',
            'slug' => 'required|string|min:3|max:255|unique:shop_products,slug',
            "excerpt" => "nullable|string",
            "introduction" => "nullable|string",
            "body" => "nullable|string",
            "featured_image" => 'nullable|string',
            "image" => 'nullable|string',
            "video" => 'nullable|string',
            'chapters' => 'nullable|array',

            "faq" => 'nullable|array',
            "order" => 'nullable|integer',
            "price_offline_regular" => "nullable",
            "price_offline_sell" => "nullable|lt:price_offline_regular",
            "price_online_regular" => "nullable",
            "price_online_sell" => "nullable|lt:price_online_regular",
            "price_instalment" => "nullable",
            "attributes"=>"nullable|array",

            'status' => ['required', Rule::in(array_column(PublishStatusEnum::cases(), 'value'))],
            'template' => 'nullable|string',

            'meta' => 'nullable|array',

            'seo' => 'nullable|array',
            'seo.meta' => 'nullable|array',
            'seo.schema' => 'nullable|array',
            'seo.sitemap' => 'nullable|array',
            'tags' => 'nullable|array',

        ];
    }
}
