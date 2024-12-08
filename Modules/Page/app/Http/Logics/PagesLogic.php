<?php

namespace Modules\Page\Http\Logics;

use Modules\Main\Action\FetchServiceData;
use Modules\Main\Action\ServiceResult;
use Modules\Main\Action\ServiceWrapper;
use Modules\Main\Traits\Trash\HasTrash;
use Illuminate\Support\Arr;
use Modules\Page\Models\Page;


class PagesLogic
{
    use HasTrash;
    const model = page::class;

    public function getAllPages()
    {
        return app(ServiceWrapper::class)(function () {
            return app(FetchServiceData::class)(Page::class ,['title' ,'status' , 'created_at','published_at']);
        });
    }

    public function registerPage(array $inputs): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($inputs) {
            $inputs['user_id']=auth()->id();
            $page = Page::query()->create(Arr::except($inputs,['tags','seo']));

            $page->saveTags($inputs['tags'] ?? null);
             $page->saveSeo($inputs['seo']  ?? []);

            return $page;

        });
    }

    public function changePage(array $inputs, Page $page)
    {
        return app(ServiceWrapper::class)(function () use ($inputs, $page) {

            $page->update($inputs);
            $page->setMeta($inputs['extra'] ?? []);
            $page->saveTags($inputs['tags'] ?? null);
            $page->saveSeo($inputs['seo']  ?? []);
            return $page;
        });
    }

    public function destroyPage(Page $page)
    {
        return app(ServiceWrapper::class)(fn()=>$page->delete());
    }

}
