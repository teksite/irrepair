<?php

namespace Modules\Main\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Main\Casts\JsonCast;


class SeoModel extends Model
{
    protected $fillable=['model_id','model_type','title','description','keywords','conical_url','indexable','followable','seo_type','schema','sitemap'];

    protected $casts = [
        'keywords'=>JsonCast::class,
        'schema'=>JsonCast::class,
        'meta_schema'=>JsonCast::class,
        'sitemap'=>JsonCast::class,
    ];

    public function model()
    {
        return $this->morphTo(SeoModel::class,'model' ,'model_type','model_id');
    }
}
