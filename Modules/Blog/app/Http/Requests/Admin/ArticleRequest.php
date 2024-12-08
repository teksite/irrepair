<?php

namespace Modules\Blog\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ArticleRequest extends FormRequest
{
    public function rules(): array
    {

        if (request()->method() == 'POST') {
            return $this->defaultRules();

        } elseif (request()->method() == 'PATCH' || request()->method() == 'PUT') {

            return array_merge( $this->defaultRules(),
                [
                    'title' => ['required', 'string', Rule::unique('blog_articles', 'title')->ignore($this->article->id)],
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
            return auth()->check() && auth()->user()->can("article-create");
        } elseif (request()->method() == 'PATCH' || request()->method() == 'PUT') {
            return auth()->check() && auth()->user()->can("article-edit");
        }
        return false;
    }

    public function defaultRules():array
    {
        return [
            'title' => 'required|string|unique:blog_articles,title',
            'body' => 'nullable',
            'excerpt' => 'nullable',
        ];
    }
}
