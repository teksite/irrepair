<?php

namespace Modules\Shop\Models;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $fillable=['title','icon' ,'featured_image'];
    protected $table='shop_attributes';

    public function values()
    {
        return $this->hasMany(AttributeValue::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class , 'shop_attribute_product')->withPivot('value_id');
    }


}
