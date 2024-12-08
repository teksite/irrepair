<?php

namespace Modules\Comment\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Captcha\Rules\CaptchaRule;

class CommentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            "formpot"=>'prohibited',
            'message' => 'required|string|min:5',
            'parent_id' => 'required',
            'commentable_id' => 'required',
            'commentable_type' => 'required',
            'name' => [Rule::requiredIf(!auth()->check()),'string'],
            'email' => [Rule::requiredIf(!auth()->check()),'email'],
            'g-recaptcha-response'=>[Rule::requiredIf(!auth()->check()) , new CaptchaRule],

        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
