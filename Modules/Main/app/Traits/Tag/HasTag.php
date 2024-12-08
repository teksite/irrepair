<?php

namespace Modules\Main\Traits\Tag;

use Illuminate\Database\Eloquent\Builder;
use Modules\Main\Action\ServiceWrapper;
use Modules\Main\Models\MetaModel;
use Modules\Main\Models\Tag;

trait HasTag
{
    use SaveTag;
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'model', 'tag_models', 'model_id', 'tag_id');
    }
}
