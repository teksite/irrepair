<?php

namespace Modules\Main\Http\Logics;

use Illuminate\Support\Arr;
use Modules\Main\Action\FetchServiceData;
use Modules\Main\Action\ServiceWrapper;
use Modules\Main\Models\Permission;
use Modules\Main\Models\Role;


class RolesLogic
{
    //use HasTrash;
    const model = Role::class;

    public function getAllRoles()
    {
        return app(ServiceWrapper::class)(function () {
            return app(FetchServiceData::class)(Role::class ,['title']);
        });
    }

    public function registerRole(array $input)
    {
        return app(ServiceWrapper::class)(function () use ($input) {
            $role= Role::query()->create(Arr::except($input,'permissions'));
            $role->permissions()->attach($input['permissions']);
            $this->clearCache();
            return $role;
        });
    }


    public function changeRole(array $input, Role $role)
    {
        return app(ServiceWrapper::class)(function () use ($input, $role) {
            $role->update(Arr::except($input,'permissions'));
            $role->permissions()->sync($input['permissions']);
            $this->clearCache();
            return $role;
        });
    }

    public function destroyRole(Role $role)
    {
        return app(ServiceWrapper::class)(function () use ($role) {
            $role->delete();
        });
    }
    public  function clearCache(): void
    {

        cache()->forget('allRoles');
        cache()->forever('allRoles',Role::query()->select(['title','id'])->get());
    }

}
