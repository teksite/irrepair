<?php

namespace Modules\Menu\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = ['title','label','classes'];

    public function items()
    {
        return $this->hasMany(MenuItem::class);
    }
}
