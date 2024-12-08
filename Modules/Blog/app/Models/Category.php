<?php

namespace Modules\Blog\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;
use Modules\Main\Casts\ImageCast;
use Modules\Main\Casts\SlugCast;
use Modules\Main\Traits\Seo\HasSeo;
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;


class Category extends Model
{
    use HasRecursiveRelationships /*, HasSeo */;
    protected $table='blog_categories';

    protected $fillable = ['parent_id', 'title', 'body', 'slug', 'featured_image',];

    protected $casts = [
        'slug' => SlugCast::class,
        'featured_image' => ImageCast::class,
    ];

    public function path()
    {
        return Route::has('blog.category.show') ? route('blog.category.show', $this) : null;
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class ,'blog_category_post');
    }
}
