<?php

namespace Modules\Shop\Models;

use Illuminate\Database\Eloquent\Model;

class OrderPayment extends Model
{
    protected $table = 'shop_order_payments';
    protected $fillable = ['order_id', 'res_number', 'price', 'status', 'tracking_code','ip_address','mac_address'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
