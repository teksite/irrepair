<?php

namespace Modules\Shop\Http\Logics;

use Modules\Main\Action\FetchServiceData;
use Modules\Main\Action\ServiceResult;
use Modules\Main\Action\ServiceWrapper;
use Modules\Main\Traits\Trash\HasTrash;
use Illuminate\Support\Arr;
use Modules\Shop\Models\Category;


class CategoriesLogic
{
     use HasTrash;
     const model = Category::class;


    public function getAllCategories()
    {
        return app(ServiceWrapper::class)(function () {
            return app(FetchServiceData::class)(Category::class ,['title', 'created_at']);
        });
    }

    public function registerCategory(array $inputs): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($inputs) {
            return Category::query()->create($inputs);

        });
    }

    public function changeCategory(array $inputs, Category $category)
    {
        return app(ServiceWrapper::class)(function () use ($inputs, $category) {

            $category->update($inputs);

            return $category;
        });
    }

    public function destroyCategory(Category $category)
    {
        return app(ServiceWrapper::class)(fn()=>$category->delete());
    }


}
