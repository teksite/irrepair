<?php

namespace Modules\Shop\Http\Controllers\Web\Client\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Modules\Shop\Models\Product;

class ProductsController extends Controller
{

    public function index()
    {
//        return view('shop::index');
    }

    public function show(Product $product): \Illuminate\Contracts\View\View
    {
        $seo = $product->generateSeo();
        $extra=$product->meta->keyBy('key')->map(function ($item) {
            return $item->value;
        })->toArray();
        return View::first(["pages.shop.products.templates.$product->template", 'pages.shop.products.show'], compact('product' ,'extra' ,'seo'));
    }
}
