<?php

namespace Modules\Shop\Http\Controllers\Web\Admin\Categories;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Modules\Main\Services\Facade\WebResponse;
use Modules\Shop\Http\Logics\CategoriesLogic;
use Modules\Shop\Http\Requests\Admin\CategoryRequest;
use Modules\Shop\Models\Category;

class CategoriesController extends Controller implements HasMiddleware
{

    public function __construct(public CategoriesLogic $logic)
    {

    }

    public static function middleware(): array
    {
        return [
            new Middleware('can:product-category-read'),
            new Middleware('can:product-category-create', only: ['create', 'store']),
            new Middleware('can:product-category-edit', only: ['edit', 'update']),
            new Middleware('can:product-category-delete', only: ['destroy']),
        ];
    }

    public function index()
    {
        $categories = $this->logic->getAllCategories()->data;
        return view('shop::pages.admin.categories.index', compact('categories'));
    }


    public function create()
    {
        return redirect()->action([CategoriesController::class, 'index']);
    }


    public function store(CategoryRequest $request): RedirectResponse
    {
        $result = $this->logic->registerCategory($request->validated());
        return WebResponse::byResult($result, 'admin.shop.categories.index')->go();
    }


    public function show(Category $category)
    {
       abort(404);
    }


    public function edit(Category $category)
    {
        return view('shop::pages.admin.categories.edit', compact('category'));
    }


    public function update(CategoryRequest $request, Category $category): RedirectResponse
    {
        $result = $this->logic->changeCategory($request->validated(), $category);
        return WebResponse::redirect()->byResult($result, 'admin.shop.categories.edit')->params($result->data)->go();
    }


    public function destroy(Category $category)
    {
        $result = $this->logic->destroyCategory($category);
        return WebResponse::redirect()->byResult($result, 'admin.shop.categories.index')->go();
    }
}
