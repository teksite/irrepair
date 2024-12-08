<?php

namespace Modules\Shop\Http\Logics;

use Exception;
use Illuminate\Http\Request;
use Modules\Main\Action\FetchServiceData;
use Modules\Main\Action\ServiceResult;
use Modules\Main\Action\ServiceWrapper;
use Modules\Main\Traits\Trash\HasTrash;
use Illuminate\Support\Arr;
use Modules\Shop\Models\OrderPayment;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment as Shetabit;


class PaymentPortalLogic
{
    private $user;
    private $cartTitle;
    //use HasTrash;
    //const model = Module::class;
    public function __construct()
    {
        $this->user = auth()->user();
        $this->cartTitle = config('sitesettings.shop.cart_title', 'default');
    }

    public function processOrderPayment(array $inputs)
    {
        return app(ServiceWrapper::class)(/**
         * @throws Exception
         */ function () use ($inputs) {

            $order = $this->user->orders()
                ->where('status', 'prepay')
                ->latest('id') // Specify column for better clarity
                ->first();

            if (!$order) {
                throw new Exception('No prepay order found.');
            }

            // Prepare address and location data
            $address = Arr::only($inputs['address'], ['province', 'city', 'street']);
            $location = Arr::only($inputs['geo'], ['latitude', 'longitude']);

            // Create order details
            $details = $order->details()->create([
                'name' => $inputs['name'],
                'email' => $inputs['email'],
                'phone' => $inputs['phone'],
                'zip_code' => $inputs['zip_code'],
                'address' => $address,
                'location' => [
                    'lat' => $location['latitude'],
                    'lng' => $location['longitude'],
                ],
            ]);

            // Handle payment
            return $this->handlePayment($order)->data;
        });
    }


    public function callback(Request $request)
    {
        try {
            // Fetch payment and related order in one query
            $payment = OrderPayment::with('order')->where('res_number', $request->Authority)->firstOrFail();

            // Verify the transaction
            $receipt = Shetabit::amount($payment->price)->transactionId($request->Authority)->verify();

            // Update payment and order status
            $payment->update([
                'status' => 1,
                'tracking_code' => $receipt->getReferenceId(),
            ]);

            $payment->order->update(['status' => 'paid']);

            // Clear cart in a single query
            $cart = auth()->user()->cart()
                ->where('title', $this->cartTitle)
                ->with('products:id')
                ->first();

            if ($cart) {
                $cart->products()->detach(); // Detach products
                $cart->delete(); // Delete cart
            }

            return true;
        } catch (InvalidPaymentException $exception) {
            // Handle failed payment
            if (isset($payment) && $payment->order) {
                $payment->order->update(['status' => 'failed']);
                $payment->order->details()->update(['status' => 'canceled']);
            }
            return false;
        }
    }


    private function handlePayment($order)
    {
        return app(ServiceWrapper::class)(function () use ($order) {

            $price = $order->price;
            $invoice = (new Invoice)->amount($price);

            return Shetabit::callbackUrl(route('payment.callback'))
                ->via('zarinpal')
                ->purchase($invoice, function ($driver, $transactionId) use ($order, $price) {
                    $this->storePayment($order, $transactionId, $price);
                })->pay()->render();
        });
    }

    private function storePayment($order, $transactionId, $price)
    {
        return app(ServiceWrapper::class)(function () use ($price, $order, $transactionId) {
            $order->payments()->create([
                'res_number' => $transactionId,
                'price' => $price,
                'status' => 0,
                'ip_address' => request()->ip(),
            ]);
        });
    }
}
