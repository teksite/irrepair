<?php

namespace Modules\Shop\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class AttributeValueProduct extends Pivot
{

    protected $fillable = [];
    protected $table='shop_attribute_product';



}
