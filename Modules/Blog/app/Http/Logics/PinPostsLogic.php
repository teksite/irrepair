<?php

namespace Modules\Blog\Http\Logics;

use Modules\Blog\Models\Post;
use Modules\Main\Action\FetchServiceData;
use Modules\Main\Action\ServiceResult;
use Modules\Main\Action\ServiceWrapper;
use Modules\Main\Traits\Trash\HasTrash;
use Illuminate\Support\Arr;



class PinPostsLogic
{
     //use HasTrash;
     //const model = Module::class;

    public function getAllPosts()
    {
        return app(ServiceWrapper::class)(function () {
            return Post::query()->whereNotNull('pinned')->orderBy('pinned')->select(['id', 'title', 'pinned'])->get();
        });
    }

    public function newPinned(array $inputs)
    {
        return app(ServiceWrapper::class)(function () use ($inputs) {
            $lastPinned=Post::query()->max('pinned');
            foreach ($inputs['posts'] as $id){
                Post::find($id)->update(['pinned'=>$lastPinned+1]);
                $lastPinned++;
            }
        });
    }
    public function updatePinnedPosts(array $inputs)
    {
        return app(ServiceWrapper::class)(function () use ($inputs) {
            $newImportant = $inputs['posts'] ?? [];

            $exImportant= Post::query()->whereNotNull('pinned')->select('id')->get()->toArray();

            foreach ($exImportant as $id) {
                if (!in_array($id , array_keys($newImportant))){
                    Post::find($id)->first()->update(['pinned' => null]);
                }
            }
            foreach ($newImportant as $id => $order) {
                Post::find($id)->update(['pinned' => $order]);
            }
        });
    }

}
