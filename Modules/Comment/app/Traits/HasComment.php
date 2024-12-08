<?php

namespace Modules\Comment\Traits;

use Modules\Comment\Models\Comment;

trait HasComment
{
    public function comments()
    {
        return $this->morphMany(Comment::class, 'model');
    }
}
