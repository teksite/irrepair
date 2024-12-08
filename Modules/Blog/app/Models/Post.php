<?php

namespace Modules\Blog\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Comment\Traits\HasComment;
use Modules\Main\Casts\ImageCast;
use Modules\Main\Casts\SlugCast;
use Modules\Main\Enums\PublishStatusEnum;
use Modules\Main\Models\Scopes\PublishStatusScope;
use Modules\Main\Traits\Seo\HasSeo;
use Modules\Main\Traits\Tag\HasTag;

class Post extends Model
{
    use HasTag, SoftDeletes , HasSeo ,HasComment ;
    protected $table ='blog_posts';

    protected $fillable = ['user_id', 'title', 'slug', 'body', 'excerpt', 'featured_image', 'status', 'published_at','template' ,'pinned'];

    protected $casts = [
        'slug' => SlugCast::class.':posts.show',
        'featured_image' => ImageCast::class,
        'status' => PublishStatusEnum::class,
        'published_at' => 'datetime',

    ];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new PublishStatusScope);

    }


    public function path()
    {
        return route('posts.show', $this);
    }

    public function breadcrumb()
    {
        return
            [
                __('blog')=> route('posts.index'),
                $this->attributes['title'] => $this->path(),
            ];
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class ,'blog_category_post');
    }

}
