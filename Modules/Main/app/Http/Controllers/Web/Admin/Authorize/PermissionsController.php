<?php

namespace Modules\Main\Http\Controllers\Web\Admin\Authorize;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Modules\Main\Http\Logics\PermissionsLogic;
use Modules\Main\Http\Requests\Admin\PermissionRequest;
use Modules\Main\Models\Permission;
use Modules\Main\Services\Facade\WebResponse;

class PermissionsController extends Controller implements HasMiddleware
{
    public function __construct(public PermissionsLogic $logic)
    {
    }

    public static function middleware(): array
    {
        return [
            new Middleware('can:permission-read'),
            new Middleware('can:permission-create', only: ['create', 'store']),
            new Middleware('can:permission-edit', only: ['edit', 'update']),
            new Middleware('can:permission-delete', only: ['destroy']),
        ];
    }


    public function index()
    {
        $res=$this->logic->getAllPermission();
        $permissions = $res->data;

        return view('main::pages.admin.permissions.index' , compact('permissions'));
    }

    public function create()
    {
        return action([$this,'index']);
    }

    public function store(PermissionRequest $request)
    {
        $result=$this->logic->registerPermission($request->validated());
        return WebResponse::byResult($result, 'admin.permissions.edit')->params($result->data)->go();

    }

    public function show(Permission $permission)
    {
        abort(404);
    }

    public function edit(Permission $permission)
    {
        return view('main::pages.admin.permissions.edit' , compact('permission'));
    }

    public function update(PermissionRequest $request, Permission $permission)
    {
        $result=$this->logic->changePermission($request->validated() ,$permission);
        return WebResponse::byResult($result, 'admin.permissions.edit')->params($permission)->go();
    }

    public function destroy(Permission $permission)
    {
        $result = $this->logic->destroyPermission($permission);
        return WebResponse::redirect()->byResult($result, 'admin.permissions.index')->go();
    }
}
