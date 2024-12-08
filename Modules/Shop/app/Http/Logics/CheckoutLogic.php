<?php

namespace Modules\Shop\Http\Logics;

use Illuminate\Support\Str;
use Modules\Main\Action\FetchServiceData;
use Modules\Main\Action\ServiceResult;
use Modules\Main\Action\ServiceWrapper;
use Modules\Main\Traits\Trash\HasTrash;
use Illuminate\Support\Arr;


class CheckoutLogic
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

    public function addOrder()
    {
        return app(ServiceWrapper::class)(function (){

            $cart = $this->user->cart()->where(['title' => $this->cartTitle])->with('products', function ($query) {
                $query->select([
                    'id', 'title', 'price_offline_regular',
                    'price_offline_sell',
                    'price_online_regular',
                    'price_online_sell',
                    'price_instalment_regular',
                    'price_instalment_sell',
                ]);
            })->first();

            if ($cart && $cart->products->count()) {
                $order= $this->cartToOrder($cart);
            }else{
               $order=null;
            }
            return $order?->data ?? null;

        });

    }

    private function cartToOrder($cart)
    {
        return app(ServiceWrapper::class)(function () use ($cart) {
            $cartProducts = $cart->products;

            $orderProductData = [];
            $sumPrices = 0;

            foreach ($cartProducts as $product) {
                $type = $product->pivot->type;
                $priceColumn = "price_{$type}_sell";
                $regularColumn = "price_{$type}_regular";
                $price = $product->$priceColumn ?? $product->$regularColumn;
                $quantity = $product->pivot->quantity;

                $sumPrices += (int) $quantity * (int) $price;

                $orderProductData[] = [
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'price' => $price,
                    'type' => $type,
                ];
            }

            $order = $this->user->orders()->create([
                'stance' => 'null',
                'status' => 'prepay',
                'order_number' => time() . Str::lower(Str::random(3)),
                'price' => $sumPrices,
                'ip_address' => request()->ip(),
            ]);

            $order->products()->attach(
                collect($orderProductData)->mapWithKeys(function ($item) {
                    return [$item['product_id'] => [
                        'quantity' => $item['quantity'],
                        'price' => $item['price'],
                        'type' => $item['type'],
                    ]];
                })
            );
            return $order;

        });
    }

}
