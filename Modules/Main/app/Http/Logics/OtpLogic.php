<?php

namespace Modules\Main\Http\Logics;

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Concurrency;
use Illuminate\Support\Facades\Mail;
use Modules\Main\Action\FetchServiceData;
use Modules\Main\Action\ServiceResult;
use Modules\Main\Action\ServiceWrapper;
use Modules\Main\Emails\OtpMail;
use Modules\Main\Models\OneTimePassword;
use Modules\Main\Services\Facade\Otp;
use Modules\Main\Traits\Trash\HasTrash;
use Illuminate\Support\Arr;


class OtpLogic
{
    //use HasTrash;
    //const model = Module::class;

    public function sendOtp($user_id, string $code, string $via)
    {
        return app(ServiceWrapper::class)(function () use ($user_id, $code, $via) {
            $user = User::find($user_id);
            switch ($via) {
                case 'email':
                    $this->viaEmail($user, $code);
                    break;
                case 'sms':
                    $this->viaSMS($user);
                    break;
                case 'telegram':
                    $this->viaTelegram($user);
                    break;
            }
        });
    }

    public function validateOtp($user_id, int|string $code, string $key)
    {
        return app(ServiceWrapper::class)(function () use ($code, $user_id, $key) {

            $user = User::find($user_id);

            return Otp::check($code);
        });
    }

    public function deleteTheOtp(User|Authenticatable $user, int|string $code)
    {
        return app(ServiceWrapper::class)(function () use ($user, $code) {
            return $user->oneTimePasswords()->where('code', $code)->delete();
        });
    }

    public function deleteOtps()
    {
        return app(ServiceWrapper::class)(function () {
            return OneTimePassword::query()->where('expired_at', '<', now())->delete();
        });
    }


    private function viaEmail(User $user, string $code)
    {
            Mail::to($user)->send(new OtpMail($code));
    }

    private function viaSMS()
    {

    }

    private function viaTelegram()
    {

    }

}
