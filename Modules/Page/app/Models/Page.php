<?php

namespace Modules\Page\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Main\Casts\ImageCast;
use Modules\Main\Casts\SlugCast;
use Modules\Main\Enums\PublishStatusEnum;
use Modules\Main\Models\Scopes\PublishStatusScope;
use Modules\Main\Traits\Meta\HasMeta;
use Modules\Main\Traits\Seo\HasSeo;
use Modules\Main\Traits\Tag\HasTag;


class Page extends Model
{
    use SoftDeletes, HasTag, HasMeta ,HasSeo;

    protected $fillable = ['title', 'slug', 'body', 'excerpt', 'featured_image', 'template', 'banner', 'status', 'published_at'];

    protected $casts = [
        'slug' => SlugCast::class . ':posts.show',
        'featured_image' => ImageCast::class,
        'banner' => ImageCast::class,
        'status' => PublishStatusEnum::class,
        'published_at' => 'datetime',

    ];

    public function breadcrumb()
    {
        return
            [
                $this->attributes['title'] => $this->path(),
            ];
    }

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new PublishStatusScope());
    }


    public function path()
    {
        return route('pages.show', $this);
    }

}
