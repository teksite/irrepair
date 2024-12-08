<?php

namespace Modules\Shop\Http\Logics;

use Modules\Main\Action\FetchServiceData;
use Modules\Main\Action\ServiceResult;
use Modules\Main\Action\ServiceWrapper;
use Modules\Main\Traits\Trash\HasTrash;
use Illuminate\Support\Arr;


class CartLogic
{
    private $user;
    private $cart;

    private string $cartTitle;

    public function __construct()
    {
        $this->user = auth()->user();
        $this->cartTitle = config('sitesettings.shop.cart_title', 'default');
        $this->cart = $this->user->cart()->firstOrCreate(['title' => $this->cartTitle]);

    }

    public function addToCart(array $inputs): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($inputs) {
            $encryptedModel = $inputs['entity'];
            $encryptedModelId = $inputs['identification'];
            $type = $inputs['type'];

            $id = decrypt($encryptedModelId);
            if (in_array($id, $this->cart->products->pluck('id')->toArray())) {
                return $this->cart;
            }
            return $this->cart?->products()->attach($id, ['quantity' => 1, 'type' => $type]);
        });
    }

    public function getTheCart(): ServiceResult
    {
        return app(ServiceWrapper::class)(function () {
            return $this->user->cart()->with('products', function ($query) {
                $query->select([
                    'id', 'title', 'slug',
                    'price_offline_regular',
                    'price_offline_sell',
                    'price_online_regular',
                    'price_online_sell',
                    'price_instalment_regular',
                    'price_instalment_sell',
                ]);
            })->first();
        });
    }

    public function deleteProductFromCart(array $inputs): ServiceResult
    {

        return app(ServiceWrapper::class)(function () use ($inputs) {

            $encryptedModel = $inputs['entity'];
            $encryptedModelId = $inputs['identification'];

            $model = decrypt($encryptedModel);
            $id = decrypt($encryptedModelId);

            $this->cart->products()->detach($id);
        });

    }

}
