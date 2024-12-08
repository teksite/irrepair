<?php

namespace Modules\Shop\Http\Controllers\Web\Admin\Orders;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Modules\Main\Services\Facade\WebResponse;
use Modules\Shop\Http\Logics\OrderLogic;
use Modules\Shop\Http\Requests\Admin\OrderChangeRequest;
use Modules\Shop\Http\Requests\Admin\OrderRequest;
use Modules\Shop\Models\Order;

class OrdersController extends Controller implements HasMiddleware
{

    public function __construct(public OrderLogic $logic)
    {

    }

    public static function middleware(): array
    {
        return [
            new Middleware('can:order-read'),
            new Middleware('can:order-create', only: ['create', 'store']),
            new Middleware('can:order-edit', only: ['edit', 'update']),
            new Middleware('can:order-delete', only: ['destroy']),
        ];
    }

    public function index()
    {
        $orders = $this->logic->getAllOrders()->data;
        $trashCount = $this->logic->trashesCount()->data;
        return view('shop::pages.admin.orders.index', compact('orders', 'trashCount'));
    }


    public function create()
    {
//        return view('shop::pages.admin.orders.create');
    }


    public function store(OrderRequest $request): RedirectResponse
    {
//        $result = $this->logic->registerOrder($request->validated());
//        return WebResponse::byResult($result, 'admin.shop.orders.edit')->params($result->data)->go();
    }


    public function show(Order $order)
    {
        return view('shop::pages.admin.orders.show', compact('order'));
    }


    public function edit(Order $order)
    {
        return view('shop::pages.admin.orders.edit', compact('order'));
    }

    public function change(Order $order)
    {
        return view('shop::pages.admin.orders.change', compact('order'));
    }


    public function update(OrderRequest $request, Order $order): RedirectResponse
    {
        $result = $this->logic->changeOrder($request->validated(), $order);
        return WebResponse::redirect()->byResult($result, 'admin.sell.orders.edit')->params($order)->go();
    }

    public function setChange(OrderChangeRequest $request, Order $order): RedirectResponse
    {
        $result = $this->logic->editOrder($request->validated(), $order);
        return WebResponse::redirect()->byResult($result, 'admin.sell.orders.change')->params($order)->go();
    }


    public function destroy(Order $order)
    {
        $result = $this->logic->destroyOrder($order);
        return WebResponse::redirect()->byResult($result, 'admin.sell.orders.index')->go();
    }
}
