<?php

namespace Modules\Blog\Http\Controllers\Web\Admin\Posts;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Modules\Blog\Http\Logics\PostsLogic;
use Modules\Main\Services\Facade\WebResponse;

class PostsTrashController extends Controller implements HasMiddleware
{
    public function __construct(public PostsLogic $logic)
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
        $res =$this->logic->getAllTrashes();
        $posts=$res->data;

        return view('blog::pages.admin.posts.trash',compact('posts'));
    }


    public function undo($id): RedirectResponse
    {
        $result = $this->logic->restoreOne($id);
        return WebResponse::byResult($result, 'admin.blog.posts.trash.index')->go();
    }

    public function prune($id): RedirectResponse
    {
        $result = $this->logic->deleteOne($id);
        return WebResponse::byResult($result, 'admin.blog.posts.trash.index')->go();
    }

    public function restore(): RedirectResponse
    {
        $result = $this->logic->restoreAll();
        return WebResponse::byResult($result, 'admin.blog.posts.index')->go();
    }


    public function flush(): RedirectResponse
    {
        $result = $this->logic->deleteAll();
        return WebResponse::byResult($result, 'admin.blog.posts.index')->go();
    }


}
