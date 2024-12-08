<?php

namespace Modules\Main\Http\Controllers\Web\Panel\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Modules\Main\Http\Controllers\Services\UsersServices;
use Modules\Main\Http\Logics\UsersLogic;
use Modules\Main\Http\Requests\Panel\UserPasswordRequest;
use Modules\Main\Services\Facade\WebResponse;

class SessionsController extends Controller
{
    public function __construct(public UsersLogic $logic)
    {
    }
    public static function middleware(): array
    {
        return [
            new Middleware('can:client-edit'),
        ];
    }
    public function index()
    {
        return view('main::pages.panel.users.sessions');
    }

    public function destroy(UserPasswordRequest $request)
    {
        $result = $this->logic->terminateSession($request->validated(), auth()->user());
        return WebResponse::redirect()->byResult($result, 'login')->go();
    }
}
