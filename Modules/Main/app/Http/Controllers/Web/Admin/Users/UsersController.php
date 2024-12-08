<?php

namespace Modules\Main\Http\Controllers\Web\Admin\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Route;
use Modules\Main\Http\Logics\UsersLogic;
use Modules\Main\Http\Requests\Admin\UserRequest;
use Modules\Main\Services\Facade\WebResponse;

class UsersController extends Controller implements HasMiddleware
{
    public function __construct(public UsersLogic $logic)
    {

    }

    public static function middleware(): array
    {
        return [
            new Middleware('can:user-read'),
            new Middleware('can:user-create', only: ['create', 'store']),
            new Middleware('can:user-edit', only: ['edit', 'update']),
            new Middleware('can:user-delete', only: ['destroy']),
        ];
    }

    public function index()
    {
        $users = $this->logic->getAllUsers()->data;
        return view('main::pages.admin.users.index', compact('users'));
    }


    public function create()
    {
        return view('main::pages.admin.users.create');
    }


    public function store(UserRequest $request)
    {
        $result=$this->logic->registerUser($request->validated());
        return WebResponse::byResult($result, 'admin.users.edit')->params($result->data)->go();
    }


    public function show(User $user)
    {
        if (Route::has('users.show')) {
            return redirect()->route('users.show', $user);

        }
        abort(404);
    }


    public function edit(User $user)
    {
        $social=$user->getMeta('social','value');
        $creation=$user->getMeta('max_user_creation','value');
        return view('main::pages.admin.users.edit', compact('user','social','creation'));

    }


    public function update(UserRequest $request, User $user)
    {
        $result=$this->logic->changeUser($request->validated(), $user);
        return WebResponse::byResult($result, 'admin.users.edit')->params($result->data)->go();
    }


    public function destroy(User $user)
    {
        if(auth()->user()->roles()->min('hierarchy') >= $user->roles()->min('hierarchy')) {
            return  WebResponse::type('error')->message('you can delete users with higher position')->go();
        }

        $result = $this->logic->destroyUser($user);
        return WebResponse::redirect()->byResult($result, 'admin.users.index')->go();
    }


}
