<?php

namespace Modules\Main\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Main\Casts\JsonCast;

// use Modules\Main\Database\Factories\MetaModelFactory;

class MetaModel extends Model
{
    use HasFactory;

    protected $fillable = ['key', 'value','meta_id','meda_type'];

    public function casts()
    {
        return [
            'value'=>JsonCast::class
        ];
    }

    public function model()
    {
        return $this->morphTo('model', 'model_type', 'model_id');

    }


}
