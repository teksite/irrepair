<?php

namespace Modules\Main\Http\Controllers\Web\Panel\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controllers\Middleware;
use Modules\Main\Http\Logics\UsersLogic;
use Modules\Main\Http\Requests\Panel\UpdateUserPasswordRequest;
use Modules\Main\Http\Requests\Panel\UpdateUserRequest;
use Modules\Main\Services\Facade\WebResponse;

class PasswordController extends Controller
{
    public function __construct(public UsersLogic $logic)
    {
    }
    public static function middleware(): array
    {
        return [
            new Middleware('can:client-password-edit'),
        ];
    }

    public function edit()
    {
        $user=auth()->user();
        return view('main::pages.panel.users.password', compact('user'));
    }


    public function update(UpdateUserPasswordRequest $request): RedirectResponse
    {
        $result = $this->logic->changePassword($request->validated(), auth()->user());
        return WebResponse::redirect()->byResult($result, 'login')->go();

    }
}
