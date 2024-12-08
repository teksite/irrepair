<?php

namespace Modules\Blog\Traits;

use Modules\Blog\Models\Article;

trait HasArticle
{
    public function article()
    {
        return $this->belongsToMany(Article::class);
    }
}
