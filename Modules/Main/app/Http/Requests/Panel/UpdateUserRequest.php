<?php

namespace Modules\Main\Http\Requests\Panel;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class UpdateUserRequest extends FormRequest
{

    public function rules(): array
    {
        $rules = [
            "name" => 'required|string',

            'featured_image' => 'nullable',
            'nickname' => 'nullable|string',
            'code_meli' => 'nullable|string',

            'meta' => 'array|nullable',
            'meta.max_user_creation.value' => 'nullable|string',
            'meta.social.*.value' => 'nullable|string',
            'meta.social.*.status' => 'sometimes|in:off,on',
        ];
        if (request()->password) $rules = array_merge($rules, ['password' => ['required', 'min:8', Rules\Password::defaults()]]);

        return $rules;
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->can('client-edit');
    }
}
