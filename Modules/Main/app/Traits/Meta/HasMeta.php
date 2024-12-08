<?php

namespace Modules\Main\Traits\Meta;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Log;
use Modules\Main\Models\MetaModel;

trait HasMeta
{
    public function meta()
    {
        return $this->morphMany(MetaModel::class, 'model', 'model_type', 'model_id');
    }

    public function getMeta(string $key , $column = 'value')
    {
        return  $this->meta()->firstWhere('key', $key)?->$column?->toArray() ?? [];
    }

    public function setMeta(array $data=[]){
        foreach ($data as $key => $value) {

            $this->meta()->updateOrCreate(['key'=>$key] , ['value'=>$value]);
        }
    }
}
