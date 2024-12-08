<?php

namespace Modules\Main\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGeneralSeoRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'key' =>'required|in:seo_general,seo_organization,seo_localBusiness',
            'stance' => 'required|in:on,off',
            'web' => 'nullable|array',
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
