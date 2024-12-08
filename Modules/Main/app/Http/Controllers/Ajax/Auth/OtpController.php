<?php

namespace Modules\Main\Http\Controllers\Ajax\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Main\Action\ApiRequest;
use Modules\Main\Http\Logics\OtpLogic;
use Modules\Main\Services\Facade\ApiResponse;
use Modules\Main\Services\Facade\Otp;

class OtpController extends Controller
{
    public function __construct(public OtpLogic $logic)
    {

    }

    public function send()
    {
        if (!session()->has('login')) {
            return response()->json([
                'data' => [],
                'message' => ['user' => 'user can not be recognized'],
                'code' => 403,
                'result' => 'failed'
            ])->setStatusCode(403);
        }

        $loginData = session()->get('login');

        $userid = $loginData['id'];

        $code = Otp::create($userid);

        $result =$this->logic->sendOtp($userid ,$code, 'email');

        return ApiResponse::byResult($result)->reply();
    }


}
