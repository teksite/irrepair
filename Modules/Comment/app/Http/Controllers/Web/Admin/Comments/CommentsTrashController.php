<?php

namespace Modules\Comment\Http\Controllers\Web\Admin\Comments;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Modules\Comment\Http\Logics\CommentsLogic;
use Modules\Main\Services\Facade\WebResponse;

class CommentsTrashController extends Controller implements HasMiddleware
{

    public function __construct(public CommentsLogic $logic)
    {

    }
    public static function middleware(): array
    {
        return [
            new Middleware('can:comment-force-delete'),
        ];
    }

    public function index()
    {
        $res =$this->logic->getAllTrashes();
        $comments=$res->data;

        return view('comment::pages.admin.comments.trash',compact('comments'));
    }


    public function undo($id): RedirectResponse
    {
        $result = $this->logic->restoreOne($id);
        return WebResponse::byResult($result, 'admin.comments.trash.index')->go();
    }


    public function prune($id): RedirectResponse
    {
        $result = $this->logic->deleteOne($id);
        return WebResponse::byResult($result, 'admin.comments.trash.index')->go();
    }


    public function restore(): RedirectResponse
    {
        $result = $this->logic->restoreAll();
        return WebResponse::byResult($result, 'admin.comments.index')->go();
    }


    public function flush(): RedirectResponse
    {
        $result = $this->logic->deleteAll();
        return WebResponse::byResult($result, 'admin.comments.index')->go();
    }


}
