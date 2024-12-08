<?php

namespace Modules\Blog\Http\Controllers\Web\Admin\Posts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Modules\Blog\Http\Logics\PostsLogic;
use Modules\Blog\Http\Requests\Admin\PostRequest;
use Modules\Blog\Models\Post;
use Modules\Main\Services\Facade\WebResponse;

class PostsController extends Controller implements HasMiddleware
{
    public function __construct(public PostsLogic $logic)
    {

    }

    public static function middleware(): array
    {
        return [
            new Middleware('can:post-read'),
            new Middleware('can:post-create', only: ['create', 'store']),
            new Middleware('can:post-edit', only: ['edit', 'update']),
            new Middleware('can:post-delete', only: ['destroy']),
        ];
    }

    public function index()
    {
        $posts = $this->logic->getAllPosts()->data;

        $trashCount = $this->logic->trashesCount()->data;

        return view('blog::pages.admin.posts.index', compact('posts', 'trashCount'));
    }


    public function create()
    {
        return view('blog::pages.admin.posts.create');
    }


    public function store(PostRequest $request)
    {
        $result = $this->logic->registerPost($request->validated());
        return WebResponse::byResult($result, 'admin.blog.posts.edit')->params($result->data)->go();
    }


    public function show(Post $post)
    {
        return redirect($post->path());
    }


    public function edit(Post $post)
    {
        return view('blog::pages.admin.posts.edit', compact('post'));
    }


    public function update(PostRequest $request, Post $post)
    {
        $result = $this->logic->changePost($request->validated(), $post);
        return WebResponse::redirect()->byResult($result, 'admin.blog.posts.edit')->params($post)->go();
    }


    public function destroy(Post $post)
    {
        $result = $this->logic->destroyPost($post);
        return WebResponse::redirect()->byResult($result, 'admin.blog.posts.index')->go();
    }
}
