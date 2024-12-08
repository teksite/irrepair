<?php

namespace Modules\Theme\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Main\Casts\JsonCast;

class ThemeSetting extends Model
{
    protected $fillable = ['key', 'value', 'stance'];
    public $timestamps =false;

    protected function casts(): array
    {
        return [
            'value' => JsonCast::class,
        ];
    }
}
