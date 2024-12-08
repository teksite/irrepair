<?php

namespace Modules\Main\Traits\Seo\Structures;

use Illuminate\Support\Facades\Request;
use Spatie\SchemaOrg\Blog;
use Spatie\SchemaOrg\Schema;

trait BlogSchema
{
    public function blogSchema(array $data = [], array $instance = []): Blog
    {
        $schema= $data['schema'] ?? [];
        return (new Schema())::blog()
           ->name($schema['title'] ?? $data['title'] ?? $instance['title'])
            ->description($schema['description'] ?? $data['description'] ?? $instance['excerpt'])
            ->url(url()->current())
            ->image($schema['image'] ?? $instance['featured_image'] ?? null)
            ->identifier(Request::fullUrl() . '#Blog');
    }
}
