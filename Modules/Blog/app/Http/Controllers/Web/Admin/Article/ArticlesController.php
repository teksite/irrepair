<?php

namespace Modules\Blog\Http\Controllers\Web\Admin\Article;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Modules\Blog\Http\Logics\ArticlesLogic;
use Modules\Blog\Http\Requests\Admin\ArticleRequest;
use Modules\Blog\Models\Article;
use Modules\Main\Services\Facade\WebResponse;

class ArticlesController extends Controller implements HasMiddleware
{
    public function __construct(public ArticlesLogic $logic)
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
        $results = $this->logic->getAllArticles();
        $articles = $results->data;
        $trash = $this->logic->trashesCount();
        $trashCount = $trash->data;
        return view('blog::pages.admin.articles.index', compact('articles', 'trashCount'));
    }


    public function create()
    {
        return view('blog::pages.admin.articles.create');
    }


    public function store(ArticleRequest $request)
    {
        $result = $this->logic->registerArticle($request->validated());
        return WebResponse::byResult($result, 'admin.blog.articles.edit')->params($result->data)->go();
    }


    public function show(Article $article)
    {
        abort(404);
    }


    public function edit(Article $article)
    {
        return view('blog::pages.admin.articles.edit', compact('article'));
    }


    public function update(ArticleRequest $request, Article $article)
    {
        $result = $this->logic->changeArticle($request->validated(), $article);
        return WebResponse::redirect()->byResult($result, 'admin.blog.articles.edit')->params($article)->go();
    }


    public function destroy(Article $article)
    {
        $result = $this->logic->destroyArticle($article);
        return WebResponse::redirect()->byResult($result, 'admin.blog.articles.index')->go();
    }
}
