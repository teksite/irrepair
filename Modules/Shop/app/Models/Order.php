<?php

namespace Modules\Shop\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Main\Casts\JsonCast;

class Order extends Model
{
    use SoftDeletes;


    protected $table='shop_orders';

    protected $fillable = ["user_id","price","status","order_number","ip_address" ,'mac_address'];

    public function user()
    {
        return  $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class ,'shop_order_products')->withPivot(['quantity' ,'type' ,'price']);
    }

    public function payments()
    {
        return $this->hasOne(OrderPayment::class);
    }

    public function details()
    {
        return $this->hasOne(OrderDetail::class);
    }
}
