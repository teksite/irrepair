<?php

namespace Modules\Captcha\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Modules\Captcha\services\Facade\Captcha;
use Modules\Main\Models\Setting;

class CaptchaRule implements ValidationRule
{
    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (config('sitesetting.captcha') === false) {
            return;
        }
        $local = Setting::query()->firstWhere('key', "local_captcha");
        $local_stance = $local ? $local->stance : 'off';

        $google = Setting::query()->firstWhere('key', "google_v2_captcha");
        $google_stance = $google ? $google->stance : 'off';

        if ($local_stance == 'on') {
            $this->validatingViaLocalRule($value, $fail);
        } elseif ($google_stance == 'on') {
            $this->validatingViaGoogleRule($value, $fail, $google);
        } else {
            $fail('error');
        }
    }

    private function validatingViaGoogleRule($value, $fail, $google)
    {

        try {
            $google = Setting::query()->firstWhere('key', "google_v2_captcha");
            if (!!$google) {
                $data = $google->value;

                $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                    'secret' => $data['secret_key'],
                    'response' => $value,
                    'remoteip' => request()->ip(),
                ])->json();
                $response['success'] ?: $fail('recaptcha validation fails');
            } else {
                throw  new \Exception('error invalidation process');

            }

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            $fail('something goes wrong in validating google recaptcha');
        }
    }


    private function validatingViaLocalRule($value, $fail)
    {
        if (!Captcha::check($value)) $fail(__('recaptcha validation fails, please try again'));

    }
}
