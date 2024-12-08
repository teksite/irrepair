<?php

namespace Modules\Main\Http\Logics;

use Modules\Main\Action\FetchServiceData;
use Modules\Main\Action\ServiceResult;
use Modules\Main\Action\ServiceWrapper;
use Modules\Main\Models\Tag;
use Modules\Main\Traits\Trash;
use Illuminate\Support\Arr;



class TagsLogic
{
     //use HasTrash;
     //const model = Module::class;
    public function getAllTags()
    {
        return app(ServiceWrapper::class)(function () {
            return app(FetchServiceData::class)(Tag::class , ['title']);
        });
    }

    public function registerTag(array $inputs): ServiceResult
    {
        return app(ServiceWrapper::class)(fn() => Tag::create($inputs));
    }

    public function changeTag(array $inputs, Tag $tag)
    {
        return app(ServiceWrapper::class)(fn()=>$tag->update($inputs));
    }

    public function destroyTag(Tag $tag)
    {
        return app(ServiceWrapper::class)(function () use ($tag) {
            $tag->delete();
        });
    }

}
