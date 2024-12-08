<?php

namespace Modules\Form\Http\Controllers\Web\Admin\Receives;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Modules\Form\Http\Logics\InboxesLogic;
use Modules\Main\Services\Facade\WebResponse;

class InboxesTrashController extends Controller implements HasMiddleware
{
    public function __construct(public InboxesLogic $logic)
    {
    }

    public static function middleware(): array
    {
        return [
            new Middleware('can:form-receive-delete'),
            new Middleware('can:form-receive-force-delete' ,only:['prune','flush']),
        ];
    }
    public function index()
    {
        $res =$this->logic->getAllTrashes();
        $inboxes=$res->data;
        $trash = $this->logic->trashesCount();
        $trashCount = $trash->data;
        return view('form::pages.admin.inboxes.trash',compact('inboxes' ,'trashCount'));
    }



    public function undo($id): RedirectResponse
    {
        $result = $this->logic->restoreOne($id);
        return WebResponse::byResult($result, 'admin.forms.inboxes.trash.index')->go();
    }

    public function prune($id): RedirectResponse
    {
        $result = $this->logic->deleteOne($id);
        return WebResponse::byResult($result, 'admin.forms.inboxes.trash.index')->go();
    }

    public function restore(): RedirectResponse
    {
        $result = $this->logic->restoreAll();
        return WebResponse::byResult($result, 'admin.forms.inboxes.index')->go();
    }


    public function flush(): RedirectResponse
    {
        $result = $this->logic->deleteAll();
        return WebResponse::byResult($result, 'admin.forms.inboxes.index')->go();
    }

}
