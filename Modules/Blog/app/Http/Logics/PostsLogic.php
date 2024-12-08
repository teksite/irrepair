<?php

namespace Modules\Blog\Http\Logics;

use Modules\Blog\Models\Post;
use Modules\Main\Action\FetchServiceData;
use Modules\Main\Action\ServiceResult;
use Modules\Main\Action\ServiceWrapper;
use Modules\Main\Traits\Fetch\FetchData;
use Modules\Main\Traits\Trash\HasTrash;
use Illuminate\Support\Arr;



class PostsLogic
{
    use HasTrash ,FetchData;
    const model = Post::class;

    public function getAllPosts()
    {
        return app(ServiceWrapper::class)(function () {
            return app(FetchServiceData::class)(Post::class ,['title' ,'status' , 'created_at' ,'published_at']);
        });
    }

    public function registerPost(array $inputs): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($inputs) {
            $inputs['user_id']=auth()->id();
            $post = Post::query()->create(Arr::except($inputs,['tags','seo']));

            $post->categories()->attach($inputs['categories']);
            $post->saveTags($inputs['tags'] ?? null);
            $post->saveSeo($inputs['seo']  ?? []);
            return $post;

        });
    }

    public function changePost(array $inputs, Post $post)
    {
        return app(ServiceWrapper::class)(function () use ($inputs, $post) {
            $post->update($inputs);
            $post->categories()->sync($inputs['categories']);
            $post->saveTags($inputs['tags'] ?? null);
            $post->saveSeo($inputs['seo']  ?? []);
            return $post;
        });
    }

    public function destroyPost(Post $post)
    {
        return app(ServiceWrapper::class)(fn()=> $post->delete());
    }


}
