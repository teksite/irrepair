<?php

namespace Modules\Shop\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{

    protected $fillable = ['title'];
    protected $table='shop_carts';

    public function user()
    {
        return  $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class ,'shop_cart_products')->withPivot(['quantity' ,'type']);
    }


}
