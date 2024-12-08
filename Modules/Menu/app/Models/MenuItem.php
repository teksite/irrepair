<?php

namespace Modules\Menu\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

// use Modules\Menu\Database\Factories\MenuItemFactory;

class MenuItem extends Model
{
    use HasRecursiveRelationships;

    protected $fillable = ['menu_id', 'parent_id', 'position', 'title', 'url', 'classes','next_icon','pre_icon' ,'image', 'subtitle'];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
