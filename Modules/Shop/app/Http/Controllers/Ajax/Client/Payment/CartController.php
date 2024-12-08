<?php

namespace Modules\Shop\Http\Controllers\Ajax\Client\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Main\Services\Facade\ApiResponse;
use Modules\Shop\Http\Logics\CartLogic;
use Modules\Shop\Http\Requests\CartRequest;

class CartController extends Controller
{
    public function __construct(public CartLogic $logic)
    {
    }


    public function store(CartRequest $request)
    {
        $result = $this->logic->addToCart($request->validated());
        return ApiResponse::byResult($result, successMessage: __('the product is added to your cart'))->reply();
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
        $result=$this->logic->deleteProductFromCart($request->validated());
        return ApiResponse::byResult($result, successMessage: __('the product is removed from your cart'))->reply();
    }
}
