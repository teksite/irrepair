<?php

namespace Modules\Comment\Http\Requests\Client;

use Illuminate\Validation\Rule;
use Modules\Captcha\Rules\CaptchaRule;
use Modules\Main\Action\ApiRequest;

class CommentApiRequest extends ApiRequest
{

    public function rules(): array
    {
        return [
            'message' => 'required|string|min:5',
            'parent_id' => 'required',
            'commentable_id' => 'required',
            'commentable_type' => 'required',
            'name' => [Rule::requiredIf(!auth()->check()),'string'],
            'email' => [Rule::requiredIf(!auth()->check()),'email'],
            "formpot"=>'prohibited',
            'g-recaptcha-response'=>[Rule::requiredIf(!auth()->check()) , new CaptchaRule],


        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
