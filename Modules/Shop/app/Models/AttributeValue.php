<?php

namespace Modules\Shop\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{

    protected $fillable = ['value','attribute_id'];
    protected $table='shop_attribute_values';

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'shop_attribute_product', 'value_id', 'product_id');
    }


}
