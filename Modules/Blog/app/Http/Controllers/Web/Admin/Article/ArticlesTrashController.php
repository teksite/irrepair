<?php

namespace Modules\Blog\Http\Controllers\Web\Admin\Article;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Modules\Blog\Http\Logics\ArticlesLogic;
use Modules\Main\Services\Facade\WebResponse;

class ArticlesTrashController extends Controller  implements HasMiddleware
{
    public function __construct(public ArticlesLogic $services)
    {

    }
    public static function middleware(): array
    {
        return [
            new Middleware('can:post-force-delete'),
        ];
    }

    public function index()
    {
        $res =$this->services->getAllTrashes();
        $articles=$res->data;

        return view('blog::pages.admin.articles.trash',compact('articles'));
    }


    public function undo($id): RedirectResponse
    {
        $result = $this->services->restoreOne($id);
        return WebResponse::byResult($result, 'admin.blog.articles.trash.index')->go();
    }


    public function prune($id): RedirectResponse
    {
        $result = $this->services->deleteOne($id);
        return WebResponse::byResult($result, 'admin.blog.articles.trash.index')->go();
    }

    public function restore(): RedirectResponse
    {
        $result = $this->services->restoreAll();
        return WebResponse::byResult($result, 'admin.blog.articles.index')->go();
    }


    public function flush(): RedirectResponse
    {
        $result = $this->services->deleteAll();
        return WebResponse::byResult($result, 'admin.blog.articles.index')->go();
    }

}
