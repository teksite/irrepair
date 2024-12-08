<?php

namespace Modules\Main\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Modules\Main\Services\Facade\Otp;

class OtpRule implements ValidationRule
{
    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if(!Otp::check($value)) $fail(__('wrong code'));
    }
}
