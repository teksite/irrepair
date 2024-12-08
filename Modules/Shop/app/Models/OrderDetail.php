<?php

namespace Modules\Shop\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Main\Casts\GeometryCast;
use Modules\Main\Casts\JsonCast;

// use Modules\Shop\Database\Factories\ShopOrderDetailFactory;

class OrderDetail extends Model
{
    protected $table = 'shop_order_details';

    protected $fillable = ['order_id', 'name', 'email', 'phone', 'address', 'zip_code', 'status', 'delivery','location'];

    protected function casts()
    {
        return [
            'address'=>JsonCast::class,
            'location'=>GeometryCast::class,
        ];
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }


}
