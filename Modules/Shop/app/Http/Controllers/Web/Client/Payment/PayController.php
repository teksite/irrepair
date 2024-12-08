<?php

namespace Modules\Shop\Http\Controllers\Web\Client\Payment;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Modules\Shop\Http\Logics\PaymentPortalLogic;
use Modules\Shop\Http\Requests\PayRequest;


class PayController extends Controller
{
    public function __construct(public PaymentPortalLogic $logic)
    {
    }

    private string $cartTitle = 'default';


    /**
     * @throws Exception
     */
    public function pay(PayRequest $request)
    {
       $result =$this->logic->processOrderPayment($request->validated());
       return $result->data;
    }

    public function callback(Request $request): \Illuminate\Http\RedirectResponse
    {
        $result = $this->logic->callback($request);
        return $result ?
            redirect()->route('product.index')->with(['reply' => [
                'message' => __('the payment was successful'),
                'type' => 'success',
                'toast'=>false
            ]]):
            redirect()->route('cart.show')->with(['reply' => [
                'message' => __('the payment failed'),
                'type' => 'warning',
                'toast'=>false
            ]]);


    }

}
