<?php

namespace Modules\Blog\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PinnedPostRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'posts' => 'nullable|array',
        ];
    }


    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->can('post-read');
    }
}
