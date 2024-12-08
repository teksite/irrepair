<?php

namespace Modules\SSO\Http\Controllers\Web\Auth\Authentication;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Modules\Main\Action\ServiceWrapper;
use Modules\Main\Http\Logics\UsersLogic;

class SsoController extends Controller
{

    public function redirect(Request $request): \Symfony\Component\HttpFoundation\RedirectResponse|RedirectResponse
    {
        $data = $request->validate([
            'type' => ['required', 'in:google,twitter,linkedin,github,gitlab,facebook'],
        ]);

        return Socialite::driver($data['type'])->redirect();

    }

    public function callback(Request $request): Application|Redirector|RedirectResponse
    {
        $type = $request->get('type');
        if (!$type) return redirect('/login');
        app(ServiceWrapper::class)(function () use ($type) {

            $data = Socialite::driver($type)->stateless()->user();
            $user = User::firstWhere('email', $data->email);
            if (!$user) {
                $inputs = [
                    'name' => $data->name ?? $data->nickname,
                    'nickname' => $data->nickname ?? $data->name,
                    'email' => $data->email,
                    'phone' => $data->phone ?? null,
                    'featured_image' => $data->avatar,
                    'password' => Str::random(),
                ];
                $result = (new UsersLogic())->registerUser($inputs, true);
                $user = $result->data;
            }
            auth()->loginUsingId($user->id);
        });

        return redirect()->route('panel.index')->with('reply', [
            'type' => 'success',
            'message' => __('you are logged in successfully') . '!!!'
        ]);

    }

}
