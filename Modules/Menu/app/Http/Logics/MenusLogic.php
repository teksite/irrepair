<?php

namespace Modules\Menu\Http\Logics;

use Illuminate\Support\Str;
use Modules\Main\Action\FetchServiceData;
use Modules\Main\Action\ServiceResult;
use Modules\Main\Action\ServiceWrapper;
use Modules\Main\Traits\Trash\HasTrash;
use Illuminate\Support\Arr;
use Modules\Menu\Models\Menu;


class MenusLogic
{
     //use HasTrash;
     //const model = Module::class;

    public function getAllMenus()
    {
        return app(ServiceWrapper::class)(function () {
            return app(FetchServiceData::class)(Menu::class ,['title' ,'label']);
        });
    }

    public function registerMenu(array $inputs): ServiceResult
    {
        $inputs['label']='menu_'.Str::random(3).rand(123,987);
        return app(ServiceWrapper::class)(fn() => Menu::query()->create($inputs));
    }

    public function changeMenu(array $inputs, Menu $menu)
    {
        return app(ServiceWrapper::class)(function () use ($inputs, $menu) {
            $menu->update($inputs);
            return $menu;
        });
    }

    public function destroyMenu(Menu $menu)
    {
        return app(ServiceWrapper::class)(function () use ($menu) {
            $menu->delete();
        });
    }

}
