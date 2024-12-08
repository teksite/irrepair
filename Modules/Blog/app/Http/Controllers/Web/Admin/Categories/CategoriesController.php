<?php

namespace Modules\Blog\Http\Controllers\Web\Admin\Categories;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Modules\Blog\Http\Logics\CategoriesLogic;
use Modules\Blog\Http\Requests\Admin\CategoryRequest;
use Modules\Blog\Models\Category;
use Modules\Main\Services\Facade\WebResponse;

class CategoriesController extends Controller implements HasMiddleware
{
    public function __construct(public CategoriesLogic $logic)
    {

    }

    public static function middleware(): array
    {
        return [
            new Middleware('can:post-category-read'),
            new Middleware('can:post-category-create', only: ['create', 'store']),
            new Middleware('can:post-category-edit', only: ['edit', 'update']),
            new Middleware('can:post-category-delete', only: ['destroy']),
        ];
    }

    public function index()
    {
        $results = $this->logic->getAllCategories();
        $categories = $results->data;
        return view('blog::pages.admin.categories.index', compact('categories'));
    }

    public function create()
    {

        $results = $this->logic->getTreeCategories();
        $categories = $results->data;
        return view('blog::pages.admin.categories.create', compact('categories'));
    }



    public function store(CategoryRequest $request)
    {
        $result = $this->logic->registerCategory($request->validated());
        return WebResponse::byResult($result, 'admin.blog.categories.edit')->params($result->data)->go();
    }

    public function show(Category $category)
    {
        if ($category->path()) return redirect()->route('blog.categories.show', $category);
        abort(404);
    }

    public function edit(Category $category)
    {
        $results = $this->logic->getTreeCategories();
        $categories = $results->data;
        return view('blog::pages.admin.categories.edit', compact('category', 'categories'));

    }

    public function update(CategoryRequest $request , Category $category)
    {

        $result = $this->logic->changeCategory($request->validated(), $category);
        return WebResponse::redirect()->byResult($result, 'admin.blog.categories.edit')->params($category)->go();
    }


    public function destroy(Category $category)
    {
        $result = $this->logic->destroyCategory($category);
        return WebResponse::redirect()->byResult($result, 'admin.blog.categories.index')->params($result->data)->go();
    }

}
