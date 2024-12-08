<?php

namespace Modules\Menu\Http\Controllers\Web\Admin\Menus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Modules\Main\Services\Facade\WebResponse;
use Modules\Menu\Http\Logics\MenusLogic;
use Modules\Menu\Http\Requests\Admin\MenuRequest;
use Modules\Menu\Models\Menu;

class MenusController extends Controller implements HasMiddleware
{
    public function __construct(public MenusLogic $logic)
    {
    }

    public static function middleware(): array
    {
        return [
            new Middleware('can:menu-read'),
            new Middleware('can:menu-create', only: ['create', 'store']),
            new Middleware('can:menu-edit', only: ['edit', 'update']),
            new Middleware('can:menu-delete', only: ['destroy']),
        ];
    }


    public function index()
    {
        $results = $this->logic->getAllMenus();
        $menus=$results->data;
        return view('menu::pages.admin.menus.index', compact('menus'));
    }


    public function create()
    {
        return redirect()->action([MenusController::class,'index']);
    }


    public function store(MenuRequest $request)
    {
        $result = $this->logic->registerMenu($request->validated());
        return WebResponse::byResult($result, 'admin.appearance.menus.index')->go();
    }


    public function show(Menu $menu)
    {
        abort(404);
    }


    public function edit(Menu $menu)
    {
        return view('menu::pages.admin.menus.edit', compact('menu'));
    }


    public function update(MenuRequest $request, Menu $menu)
    {
        $result = $this->logic->changeMenu($request->validated(), $menu);
        return WebResponse::redirect()->byResult($result, 'admin.appearance.menus.edit')->params($result->data)->go();
    }


    public function destroy(Menu $menu)
    {
        $result = $this->logic->destroyMenu($menu);
        return WebResponse::redirect()->byResult($result, 'admin.appearance.menus.index')->go();
    }
}
