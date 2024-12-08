<?php

namespace Modules\Captcha\services\Facade;

use Illuminate\Support\Facades\Facade;

class Captcha extends Facade
{
    protected static function getFacadeAccessor()
    {
        return  \Modules\Captcha\services\Captcha::class;
    }

}
