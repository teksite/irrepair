<?php

namespace Modules\Page\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Main\Enums\PublishStatusEnum;

class PageRequest extends FormRequest
{
    public function rules(): array
    {

        if (request()->method() == 'POST') {
            return $this->defaultRules();

        } elseif (request()->method() == 'PATCH' || request()->method() == 'PUT') {

            return array_merge($this->defaultRules(),
                [
                    'slug' => ['required', 'string', Rule::unique('pages', 'slug')->ignore($this->page->id)],
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
            return auth()->check() && auth()->user()->can("page-create");
        } elseif (request()->method() == 'PATCH' || request()->method() == 'PUT') {
            return auth()->check() && auth()->user()->can("page-edit");
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
            'banner' => 'nullable',
            'status' => ['required', Rule::in(array_column(PublishStatusEnum::cases(), 'value'))],
            'template' => 'nullable|string',
            'slug' => 'required|string|unique:pages,slug',
            'published_at' => 'nullable|date',

            'seo' => 'nullable|array',
            'seo.meta' => 'nullable|array',
            'seo.schema' => 'nullable|array',
            'seo.sitemap' => 'nullable|array',

            'tags' => 'nullable|array',
            'extra' => 'nullable|array',


        ];
    }
}
