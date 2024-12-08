<?php

namespace Modules\Main\Http\Controllers\Web\Admin\Authorize;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Modules\Main\Http\Logics\PermissionsLogic;
use Modules\Main\Http\Logics\RolesLogic;
use Modules\Main\Http\Requests\Admin\RoleRequest;
use Modules\Main\Models\Role;
use Modules\Main\Services\Facade\WebResponse;

class RolesController extends Controller implements HasMiddleware
{
    public function __construct(public RolesLogic $logic)
    {
    }
    public static function middleware(): array
    {
        return [
            new Middleware('can:role-read'),
            new Middleware('can:role-create', only: ['create', 'store']),
            new Middleware('can:role-edit', only: ['edit', 'update']),
            new Middleware('can:role-delete', only: ['destroy']),
        ];
    }

    public function index()
    {
        $res=$this->logic->getAllRoles();
        $roles = $res->data;

        return view('main::pages.admin.roles.index' , compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = $this->getPermissions();
        return view('main::pages.admin.roles.create' , compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request)
    {
        $result=$this->logic->registerRole($request->validated());
        return WebResponse::byResult($result, 'admin.roles.edit')->params($result->data)->go();

    }

    /**
     * Show the specified resource.
     */
    public function show(Role $role)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {

        $permissions = $this->getPermissions();

        return view('main::pages.admin.roles.edit' , compact('permissions', 'role'));
    }


    public function update(RoleRequest $request, Role $role)
    {
        $result=$this->logic->changeRole($request->validated(), $role);
        return WebResponse::byResult($result, 'admin.roles.edit')->params($role)->go();
    }


    public function destroy(Role $role)
    {
        $result = $this->logic->destroyRole($role);
        return WebResponse::redirect()->byResult($result, 'admin.roles.index')->go();
    }


    private function getPermissions(): mixed
    {
        return (new PermissionsLogic())->getAllPermission(['paginating' => -1])->data;
    }
}
