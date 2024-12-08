<?php

namespace Modules\Shop\Http\Controllers\Web\Client\Payment;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Modules\Blog\Models\Post;
use Modules\Main\Http\Logics\SeoGeneralLogic;
use Modules\Main\Services\Facade\WebResponse;
use Modules\Shop\Http\Logics\CartLogic;
use Modules\Shop\Http\Requests\CartRequest;
use Modules\Shop\Models\Cart;

class CartController extends Controller
{
    public function __construct(public CartLogic $logic)
    {
    }


    public function store(CartRequest $request)
    {
        $result = $this->logic->addToCart($request->validated());
        return WebResponse::byResult($result, successMessage: __('the product is added to your cart'))->go();
    }


    public function show()
    {
        $cart = $this->logic->getTheCart()->data;
        if ($cart->products_count > 0) {
            return view("pages.shop.payment.cart", compact('cart'));
        }
        return redirect('/');
    }


    public function update(Request $request)
    {

    }


    public function destroy(CartRequest $request)
    {
      $result= $this->logic->deleteProductFromCart($request->validated());
        return WebResponse::byResult($result, successMessage: __('the product is removed from your cart'))->go();
    }
}
