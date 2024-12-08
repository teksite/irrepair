<?php

namespace Modules\Main\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Main\Http\Logics\OtpLogic;
use Modules\Main\Services\Facade\Otp;
use Modules\Main\Services\Facade\WebResponse;

class OtpController extends Controller
{
    public function __construct(public OtpLogic $logic)
    {

    }

    public function send()
    {
        if (!session()->has('login')) {
            return redirect()->route('login')->with('reply', [
                'type' => 'error',
                'message' => __('the user is not recognized, try again'),
            ]);
        }

        $loginData = session()->get('login');

        $userid = $loginData['id'];

        $code = Otp::create($userid);

        $result =$this->logic->sendOtp($userid ,$code, 'email');

        return WebResponse::byResult($result)->params($result->data)->go();

    }


}
