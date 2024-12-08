<?php

namespace Modules\Main\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{


    protected $fillable = ['title','description'];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }


}
