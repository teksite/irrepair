<?php

namespace Modules\Page\Http\Controllers\Web\Admin\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Modules\Main\Services\Facade\WebResponse;
use Modules\Page\Http\Logics\PagesLogic;
use Modules\Page\Models\Page;

class PagesTrashController extends Controller implements HasMiddleware
{
    public function __construct(public PagesLogic $logic)
    {
    }

    public static function middleware(): array
    {
        return [
            new Middleware('can:page-delete'),
            new Middleware('can:page-force-delete' ,only:['prune','flush']),
        ];
    }
    public function index()
    {
        $res =$this->logic->getAllTrashes();
        $pages=$res->data;
        $trash = $this->logic->trashesCount();
        $trashCount = $trash->data;
        return view('page::pages.admin.pages.trash',compact('pages' ,'trashCount'));
    }



    public function undo($id): RedirectResponse
    {
        $result = $this->logic->restoreOne($id);
        return WebResponse::byResult($result, 'admin.pages.trash.index')->go();
    }

    public function prune($id): RedirectResponse
    {
        $result = $this->logic->deleteOne($id);
        return WebResponse::byResult($result, 'admin.pages.trash.index')->go();
    }

    public function restore(): RedirectResponse
    {
        $result = $this->logic->restoreAll();
        return WebResponse::byResult($result, 'admin.pages.index')->go();
    }


    public function flush(): RedirectResponse
    {
        $result = $this->logic->deleteAll();
        return WebResponse::byResult($result, 'admin.pages.index')->go();
    }

}
