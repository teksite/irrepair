<?php

namespace Modules\Main\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Modules\Main\Http\Logics\OtpLogic;
use Modules\Main\Http\Requests\Auth\LoginByOtpRequest;

class LoginByOtpController extends Controller
{
    public function __construct(public OtpLogic $logic)
    {
    }

    public function login(LoginByOtpRequest $request)
    {
        if (!session()->has('login')) {
            return redirect()->route('login')->with('reply', [
                'type' => 'error',
                'message' => __('the user is not recognized, try again'),
            ]);
        }

        $loginData = session()->get('login');
        $userId = $loginData['id'];
        $remember = $loginData['remember'];

        $user = User::find($userId);
        $code = $request->validated('sent_code');

        auth()->login($user, $remember);

        session()->forget('login');

        $request->session()->regenerate();


        return redirect('/')->with('reply', [
            'type' => 'success',
            'message' => __('you are logged in successfully'),
        ]);


    }
}
