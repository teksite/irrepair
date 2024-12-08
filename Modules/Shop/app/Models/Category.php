<?php

namespace Modules\Shop\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $table = 'shop_categories';
    protected $fillable = ['title', 'body'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

}
