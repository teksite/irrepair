<?php

namespace Modules\Captcha\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Modules\Captcha\services\Facade\Captcha;

class LocalCaptchaRule implements ValidationRule
{
    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (config('sitesetting.captcha') === false) {
            return;
        }
            if (!Captcha::check($value)) $fail(__('recaptcha validation fails, please try again'));
    }
}
