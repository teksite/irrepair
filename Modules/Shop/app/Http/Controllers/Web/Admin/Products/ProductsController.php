<?php

namespace Modules\Shop\Http\Controllers\Web\Admin\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Modules\Main\Services\Facade\WebResponse;
use Modules\Shop\Http\Logics\ProductsLogic;
use Modules\Shop\Http\Requests\Admin\ProductRequest;
use Modules\Shop\Models\Product;

class ProductsController extends Controller implements HasMiddleware
{

    public function __construct(public ProductsLogic $logic)
    {

    }

    public static function middleware(): array
    {
        return [
            new Middleware('can:product-read'),
            new Middleware('can:product-create', only: ['create', 'store']),
            new Middleware('can:product-edit', only: ['edit', 'update']),
            new Middleware('can:product-delete', only: ['destroy']),
        ];
    }
    public function index()
    {
        $products = $this->logic->getAllProducts()->data;
        $trashCount = $this->logic->trashesCount()->data;
        return view('shop::pages.admin.products.index', compact('products', 'trashCount'));
    }


    public function create()
    {
        return view('shop::pages.admin.products.create');
    }


    public function store(ProductRequest $request): RedirectResponse
    {
        $result = $this->logic->registerProduct($request->validated());
        return WebResponse::byResult($result, 'admin.shop.products.edit')->params($result->data)->go();
    }


    public function show(Product $product)
    {
        return redirect($product->path());
    }


    public function edit(Product $product)
    {
        return view('shop::pages.admin.products.edit', compact('product'));
    }


    public function update(ProductRequest $request, Product $product): RedirectResponse
    {
        $result = $this->logic->changeProduct($request->validated(), $product);
        return WebResponse::redirect()->byResult($result, 'admin.shop.products.edit')->params($product)->go();
    }


    public function destroy(Product $product)
    {
        $result = $this->logic->destroyProduct($product);
        return WebResponse::redirect()->byResult($result, 'admin.shop.products.index')->go();
    }
}
