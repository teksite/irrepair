<?php

namespace Modules\Theme\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class HomepageRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
//            'banners' => 'required|array',
//            'introduction' => 'required|string',
            'extra'=>'nullable|array',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->can('theme-edit');
    }
}
