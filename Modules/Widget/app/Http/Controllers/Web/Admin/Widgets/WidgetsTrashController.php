<?php

namespace Modules\Widget\Http\Controllers\Web\Admin\Widgets;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Modules\Main\Services\Facade\WebResponse;
use Modules\Widget\Http\Logics\WidgetsLogic;

class WidgetsTrashController extends Controller implements HasMiddleware
{
    public function __construct(public WidgetsLogic $logic)
    {
    }

    public static function middleware(): array
    {
        return [
            new Middleware('can:widget-delete'),
            new Middleware('can:widget-force-delete' ,only:['prune','flush']),
        ];
    }
    public function index()
    {
        $res =$this->logic->getAllTrashes();
        $widgets=$res->data;

        return view('widget::pages.admin.widgets.trash',compact('widgets'));
    }



    public function undo($id): RedirectResponse
    {
        $result = $this->logic->restoreOne($id);
        return WebResponse::byResult($result, 'admin.widgets.trash.index')->go();
    }

    public function prune($id): RedirectResponse
    {
        $result = $this->logic->deleteOne($id);
        return WebResponse::byResult($result, 'admin.widgets.trash.index')->go();
    }

    public function restore(): RedirectResponse
    {
        $result = $this->logic->restoreAll();
        return WebResponse::byResult($result, 'admin.widgets.index')->go();
    }


    public function flush(): RedirectResponse
    {
        $result = $this->logic->deleteAll();
        return WebResponse::byResult($result, 'admin.widgets.index')->go();
    }


}
