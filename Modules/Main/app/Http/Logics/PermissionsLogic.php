<?php

namespace Modules\Main\Http\Logics;


use Illuminate\Support\Arr;
use Modules\Main\Action\FetchServiceData;
use Modules\Main\Action\ServiceResult;
use Modules\Main\Action\ServiceWrapper;
use Modules\Main\Models\Permission;

class PermissionsLogic
{
    //use HasTrash;
    const model = Permission::class;

    public function getAllPermission(mixed $fetchData=[]): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($fetchData) {
            return app(FetchServiceData::class)(Permission::class ,['title'] ,...$fetchData);
        });
    }

    public function registerPermission(array $input)
    {
        return app(ServiceWrapper::class)(function () use ($input) {
            $permission= Permission::query()->create($input);
            $this->clearCache();
            return $permission;
        },handler: true);
    }


    public function changePermission(array $input, Permission $permission)
    {
        return app(ServiceWrapper::class)(function () use ($input, $permission) {
            $permission->update($input);
           $this->clearCache();
            return $permission;
        });
    }

    public function destroyPermission(Permission $permission)
    {
        return app(ServiceWrapper::class)(function () use ($permission) {
            $permission->delete();
        });
    }
    public  function clearCache(): void
    {
        cache()->forget('allPermissionsGates');
        cache()->forever('allPermissionsGates',Permission::query()->select(['title','id'])->get());

        cache()->forget('allPermissions');
        cache()->forever('allPermissions',Permission::query()->select(['title','id'])->get());
    }


}
