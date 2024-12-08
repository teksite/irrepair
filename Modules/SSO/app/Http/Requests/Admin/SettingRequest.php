<?php

namespace Modules\SSO\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'social'=>'required|array',
            'social.*'=>'required|array',
            'social.*.stance'=>'required|in:on,off',
            'social.*.client_secret_key'=>'nullable|string',
            'social.*.client_id'=>'nullable|string',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->can('setting-edit');
    }
}
