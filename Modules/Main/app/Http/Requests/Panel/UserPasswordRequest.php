<?php

namespace Modules\Main\Http\Requests\Panel;

use Illuminate\Foundation\Http\FormRequest;

class UserPasswordRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'password' => ['required', 'current-password'],
        ];
    }


    public function authorize(): bool
    {
        return true;
    }
}
