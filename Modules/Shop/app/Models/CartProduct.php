<?php

namespace Modules\Shop\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Shop\Database\Factories\ShopCartProductFactory;

class CartProduct extends Model
{
    use HasFactory;
    protected $table='shop_cart_products';



    protected $fillable = [];

}
