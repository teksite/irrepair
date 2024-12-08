<?php

namespace Modules\Shop\Http\Logics;

use Modules\Main\Action\FetchServiceData;
use Modules\Main\Action\ServiceResult;
use Modules\Main\Action\ServiceWrapper;
use Modules\Main\Traits\Trash\HasTrash;
use Illuminate\Support\Arr;
use Modules\Shop\Models\Order;


class OrderLogic
{
    use HasTrash;

    const model = Order::class;

    public function getAllOrders()
    {
        return app(ServiceWrapper::class)(function () {
            return app(FetchServiceData::class)(Order::class, ['order_number', 'status', 'created_at']);
        });
    }

    public function registerOrder(array $inputs): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($inputs) {



        });
    }

    public function changeOrder(array $inputs, Order $order)
    {
        return app(ServiceWrapper::class)(function () use ($inputs, $order) {
            $order->details()->update($inputs);
            return $order;
        });
    }

    public function editOrder(array $inputs, Order $order)
    {
        return app(ServiceWrapper::class)(function () use ($inputs, $order) {
            if(isset($inputs['details'])){
                $order->details()->update($inputs['details']);
            }
            $order->update($inputs);
            return $order;
        });
    }

    public function destroyOrder(Order $order)
    {
        return app(ServiceWrapper::class)(fn() => $order->delete());
    }


}
