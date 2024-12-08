<?php

namespace Modules\Captcha\Http\Controllers\Ajax\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Captcha\services\Facade\Captcha;

class LocalCaptchaController extends Controller
{
    public function getCaptcha(Captcha $captcha, string $config = 'default')
    {
        if (ob_get_contents()) {
            ob_clean();
        }
        return Captcha::create($config);
    }

    public function reload(Request $request , $config = 'custom')
    {
        if (ob_get_contents()) {
            ob_clean();
        }

        return response()->json([
            'message'=>'success',
            'data'=>Captcha::src($config),
            'code'=>200
        ])->setStatusCode(200);
    }
}
