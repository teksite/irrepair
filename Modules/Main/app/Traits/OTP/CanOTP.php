<?php

namespace Modules\Main\Traits\OTP;

use Modules\Main\Models\OneTimePassword;

trait CanOTP
{
    public function otps()
    {
        return $this->hasMany(OneTimePassword::class);
    }

}
