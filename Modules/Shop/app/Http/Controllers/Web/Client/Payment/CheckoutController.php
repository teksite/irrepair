<?php

namespace Modules\Shop\Http\Controllers\Web\Client\Payment;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Modules\Main\Services\Facade\WebResponse;
use Modules\Shop\Http\Logics\CheckoutLogic;
use Modules\Shop\Models\OrderPayment;

class CheckoutController extends Controller
{
    public function __construct(public CheckoutLogic $logic)
    {
    }

    public function order()
    {
        $user = auth()->user();

        $result = $this->logic->addOrder();
        $order = $result->data;
        return $order ?
            view("pages.shop.payment.checkout", compact('order', 'user')) :
            redirect('/')->with(['reply' => [
                'message' => __('there is no item in your cart'),
                'type' => 'warning',
                'toast'=>false
            ]]);
    }


}
