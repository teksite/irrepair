<?php

namespace Modules\Blog\Http\Controllers\Web\Admin\Posts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Modules\Blog\Http\Logics\PinPostsLogic;
use Modules\Blog\Http\Logics\PostsLogic;
use Modules\Blog\Http\Requests\Admin\PinnedPostRequest;
use Modules\Main\Services\Facade\WebResponse;

class PinnedPostsController extends Controller implements HasMiddleware
{
    public function __construct(public PinPostsLogic $logic)
    {

    }

    public static function middleware(): array
    {
        return [
            new Middleware('can:post-read'),
        ];
    }

    public function index()
    {
        $posts = $this->logic->getAllPosts()->data;
        return view('blog::pages.admin.posts.pinned', compact('posts'));
    }


    public function store(PinnedPostRequest $request)
    {
        $result = $this->logic->newPinned($request->validated());
        return WebResponse::byResult($result, 'admin.blog.pinned.index')->go();


    }

    public function update(PinnedPostRequest $request)
    {

        $result = $this->logic->updatePinnedPosts($request->validated());
        return WebResponse::byResult($result, 'admin.blog.pinned.index')->go();
    }

}

