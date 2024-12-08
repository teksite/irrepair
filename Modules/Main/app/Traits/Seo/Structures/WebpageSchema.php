<?php

namespace Modules\Main\Traits\Seo\Structures;

use Illuminate\Support\Facades\Request;
use Spatie\SchemaOrg\Schema;

trait WebpageSchema
{
    public function pageSchema(array $data = [], array $instance = [])
    {
        $schema= $data['schema'] ?? [];

        $title = $schema['title'] ?? $data['title'] ?? $instance['title'] ?? $instance['name'] ?? __(config('app.name'));
        $description = $schema['description'] ?? $data['description'] ?? $instance['excerpt'] ?? null;
        $image = $schema['image'] ?? $data['featured_image'] ?? $instance['featured_image'] ?? null;

        return (new Schema())::webPage()
            ->identifier(url()->current())
            ->name($title)
            ->description($description)
            ->isPartOf(config('app.url') . '/#WebSite')
            ->image($image)
            ->url($instance['addressUrl'] ?? url()->current());
    }
}
