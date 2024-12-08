<?php

namespace Modules\Blog\Http\Requests\Admin;

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

            return array_merge( $this->defaultRules(),
                [
                    'slug' => ['string' ,'string' ,Rule::unique('blog_categories','slug')->ignore($this->category->id)],
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
            return auth()->check() && auth()->user()->can("post-category-create");
        } elseif (request()->method() == 'PATCH' || request()->method() == 'PUT') {
            return auth()->check() && auth()->user()->can("post-category-edit");
        }
        return false;
    }

    public function defaultRules():array
    {
        return [
            'parent_id' => 'nullable',
            'title' => 'required|string',
            'body' => 'nullable|string',
            'featured_image' => 'nullable|string',
            'slug' => 'required|string|unique:blog_categories,slug',
        ];
    }
}
