<?php

namespace Modules\Blog\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Main\Enums\PublishStatusEnum;

class PostRequest extends FormRequest
{
    public function rules(): array
    {

        if (request()->method() == 'POST') {
            return $this->defaultRules();

        } elseif (request()->method() == 'PATCH' || request()->method() == 'PUT') {

            return array_merge($this->defaultRules(),
                [
                    'slug' => ['required', 'string', Rule::unique('posts', 'slug')->ignore($this->post->id)],
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
            return auth()->check() && auth()->user()->can("post-create");
        } elseif (request()->method() == 'PATCH' || request()->method() == 'PUT') {
            return auth()->check() && auth()->user()->can("post-edit");
        }
        return false;
    }

    public function defaultRules(): array
    {
        return [
            'title' => 'required|string',
            'body' => 'nullable',
            'excerpt' => 'nullable',
            'featured_image' => 'nullable',
            'published_at' => 'nullable',
            'categories' => 'required|array',
            'categories.*' => 'required|exists:categories,id',
            'status' => ['required', Rule::in(array_column(PublishStatusEnum::cases(), 'value'))],
            'template' => 'nullable|string',

            'meta' => 'nullable|array',

            'seo'=>'nullable|array',
            'seo.meta' => 'nullable|array',
            'seo.schema' => 'nullable|array',
            'seo.sitemap' => 'nullable|array',

            'tags' => 'nullable|array',

            'slug' => 'required|string|unique:posts,slug',
        ];
    }
}
