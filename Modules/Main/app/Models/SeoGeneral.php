<?php

namespace Modules\Main\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Main\Casts\JsonCast;

class SeoGeneral extends Model
{
    protected $fillable=['key','value','stance'];

    protected $casts = [
        'value'=>  JsonCast::class,
    ];

    public function scopeGeneral( $query , string $title)
    {
        return $query->firstWhere('title',$title) ?? null;
    }
}
