<?php

namespace Modules\Menu\Http\Logics;

use Illuminate\Support\Facades\DB;
use Modules\Main\Action\FetchServiceData;
use Modules\Main\Action\ServiceResult;
use Modules\Main\Action\ServiceWrapper;
use Modules\Main\Traits\Trash\HasTrash;
use Illuminate\Support\Arr;
use Modules\Menu\Models\Menu;


class MenuItemsLogic
{
    //use HasTrash;
    //const model = Module::class;
    public function getAllMenuItems(Menu $menu)
    {
        return app(ServiceWrapper::class)(function () use ($menu) {
            return app(FetchServiceData::class)(
                fn() => $menu->items()->where('parent_id', 0)->orderBy('position')->get()
            );
        });

    }

    public function registerMenuItem(array $inputs, Menu $menu): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($menu, $inputs) {
            $max = DB::table('menu_items')->where('menu_id', $menu->id)->max('position');

            $inputs['position'] = $max ? $max + 1 : 0;
            $inputs['parent_id'] = 0;
            $menu->items()->create($inputs);
        });
    }

    public function changeMenuItems(array $inputs, Menu $menu)
    {
        return app(ServiceWrapper::class)(function () use ($menu, $inputs) {
            $items = $inputs['items'];
            $updateItems = [];
            $existingIds = $menu->items()->pluck('id')->toArray();
            $newItemIds = collect($items)->pluck('id')->filter()->toArray();

            foreach ($items as $item) {
                if (isset($item['id'])) {
                    $item['menu_id']=$menu->id;
                    $updateItems[] = $item;
                }
            }

            DB::table('menu_items')->upsert($updateItems, ['id']);

            $idDiff = array_diff($existingIds, $newItemIds);
            if (!empty($idDiff))  $menu->items()->whereIn('id', $idDiff)->delete();

        });

    }
}
