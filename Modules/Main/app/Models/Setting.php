<?php

namespace Modules\Main\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Main\Casts\JsonCast;


class Setting extends Model
{

    protected $fillable =['key','value','stance'];

    protected function casts(): array
    {
        return [
            'value' => JsonCast::class,
        ];
    }

    public function scopeGetData($query ,string $title ,null|string $column =null)
    {
        $raw=$query->where('key' ,$title)->first();
        if(is_null($raw)) return  null;
        return is_null($column) ?  $raw : $raw->$column;
    }

}
