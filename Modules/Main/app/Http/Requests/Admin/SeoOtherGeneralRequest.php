<?php

namespace Modules\Main\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SeoOtherGeneralRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'key'=>'required|string',
            'seo'=>'required|array',
            'seo.schema'=>'nullable|array',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() &&  auth()->user()->can('seo-edit');
    }
}
