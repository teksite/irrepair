<?php

namespace Modules\Blog\Http\Logics;

use Modules\Blog\Models\Article;
use Modules\Main\Action\FetchServiceData;
use Modules\Main\Action\ServiceResult;
use Modules\Main\Action\ServiceWrapper;
use Modules\Main\Traits\Fetch\FetchData;
use Modules\Main\Traits\Trash\HasTrash;
use Illuminate\Support\Arr;



class ArticlesLogic
{
     use HasTrash, FetchData;
     const model = Article::class;

    public function getAllArticles()
    {
        return app(ServiceWrapper::class)(function () {
            return app(FetchServiceData::class)(Article::class, ['title']);
        });
    }
    public function registerArticle(array $inputs): ServiceResult
    {
        $inputs['user_id'] = auth()->id();
        return app(ServiceWrapper::class)(fn() => Article::query()->create($inputs));
    }
    public function changeArticle(array $inputs, Article $article)
    {
        return app(ServiceWrapper::class)(fn() => $article->update($inputs));
    }
    public function destroyArticle(Article $article)
    {
        return app(ServiceWrapper::class)(fn() => $article->delete());
    }



}
