<?php

namespace Modules\Main\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Modules\Main\Casts\JsonCast;


class UserMeta extends Model
{
    protected $fillable=['key','value','stance'];

    public function casts()
    {
        return [
            'value'=>JsonCast::class
        ];
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
