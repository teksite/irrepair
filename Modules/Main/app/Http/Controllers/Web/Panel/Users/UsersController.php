<?php

namespace Modules\Main\Http\Controllers\Web\Panel\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\File;
use Modules\Main\Http\Logics\UsersLogic;
use Modules\Main\Http\Requests\Panel\UpdateUserRequest;
use Modules\Main\Services\Facade\WebResponse;

class UsersController extends Controller implements HasMiddleware
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

    public function edit()
    {
        $user = auth()->user();

        return view('main::pages.panel.users.edit', compact('user'));
    }


    public function update(UpdateUserRequest $request): RedirectResponse
    {

        $result = $this->logic->changeProfile($request->validated(), auth()->user());
        return WebResponse::redirect()->byResult($result, 'panel.users.edit')->go();
    }

}
