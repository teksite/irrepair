<?php

namespace Modules\Main\Http\Requests\Panel;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class UpdateUserPasswordRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'current_password' => ['required', 'current-password'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->can('client-password-edit');
    }
}
