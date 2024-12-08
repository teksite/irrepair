<?php

namespace Modules\Menu\Http\Controllers\Web\Admin\Menus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Modules\Main\Services\Facade\WebResponse;
use Modules\Menu\Http\Logics\MenuItemsLogic;
use Modules\Menu\Http\Requests\Admin\MenuItemRequest;
use Modules\Menu\Models\Menu;

class ItemsController extends Controller implements HasMiddleware
{
    public function __construct(public MenuItemsLogic $logic)
    {
    }

    public static function middleware(): array
    {
        return [
            new Middleware(['can:menu-read' , 'can:menu-edit']),
        ];
    }

    public function index(Menu $menu)
    {
        $items = $this->logic->getAllMenuItems($menu)->data;
        return view('menu::pages.admin.menus.items.index' ,compact('menu','items'));
    }



    public function store(MenuItemRequest $request , Menu $menu)
    {
        $result = $this->logic->registerMenuItem($request->validated() , $menu);

        return WebResponse::byResult($result, 'admin.appearance.menus.items.index')->params($menu)->go();
    }


    public function update(MenuItemRequest $request, Menu $menu)
    {
        $result = $this->logic->changeMenuItems($request->validated() , $menu);

        return WebResponse::byResult($result, 'admin.appearance.menus.items.index')->params($menu)->go();
    }

}
