<?php

namespace Modules\Main\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Main\Rules\OtpRule;

class LoginByOtpRequest extends FormRequest
{

    public function rules(): array
    {
        return [
           'sent_code'=>['required', new OtpRule()]
        ];
    }


    public function authorize(): bool
    {
        return !auth()->check();
    }
}
