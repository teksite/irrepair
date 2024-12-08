<?php

namespace Modules\Blog\Http\Logics;

use Modules\Blog\Models\Category;
use Modules\Main\Action\FetchServiceData;
use Modules\Main\Action\ServiceResult;
use Modules\Main\Action\ServiceWrapper;
use Modules\Main\Traits\Fetch\FetchData;
use Modules\Main\Traits\Trash\HasTrash;
use Illuminate\Support\Arr;



class CategoriesLogic
{
    use FetchData;
     //use HasTrash;
     //const model = Module::class;

    public function getAllCategories()
    {
        return app(ServiceWrapper::class)(function () {
            return app(FetchServiceData::class)(function () {
                $categories = Category::query();
                if ($keyword = request()->get('s')) {
                    $categories->where('title', 'LIKE', "%$keyword%");
                } else {
                    $categories = $categories->where('parent_id', 0);
                }
                return $categories->paginate(20);
            });
        });
    }

    public function getTreeCategories()
    {
        return app(ServiceWrapper::class)(function () {

            return Category::where('parent_id',0)->get()
                ->map(function ($category) {
                    return $category->descendantsAndSelf()->orderBy('title')->get();
                })->flatten();
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
        return app(ServiceWrapper::class)(fn() => $category->update($inputs));
    }

    public function destroyCategory(Category $category)
    {
        return app(ServiceWrapper::class)(function () use ($category) {
            if ($category->children) {
                foreach ($category->children as $child) {
                    $child->update([
                        'parent_id' => $category->parent_id ?? 0
                    ]);
                }
            }
            $relatedPosts = $category->posts();
            $relatedPosts->get()->map(function ($post) {
                $post->categories()->sync(1);
            });

            $category->delete();
        });
    }




}
