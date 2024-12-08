<?php

namespace Modules\Main\Traits\Seo\Structures;

use Illuminate\Support\Facades\Request;
use Spatie\SchemaOrg\Graph;
use Spatie\SchemaOrg\Organization;
use Spatie\SchemaOrg\Person;
use Spatie\SchemaOrg\Schema;

trait ArticleSchema
{
    public function articleSchema(array $data = [], array $instance = [])
    {
        $schema= $data['schema'] ?? [];

        return (new Schema())::article()
            ->additionalType($schema['type'])
            ->headline($schema['headline'] ?? $data['title'] ?? $instance['title'])
            ->description($schema['description'] ?? $data['description'] ?? $instance['excerpt'] ?? null)
            ->image($instance['featured_image'] ?? null)
            ->sdDatePublished($instance['published_at'] ?? $instance['created_at'])
            ->dateModified($instance['updated_at'])
            ->mainEntityOfPage((new \Spatie\SchemaOrg\WebPage)->identifier(url()->current()))

            ->if($schema['publisherName'], function (\Spatie\SchemaOrg\Article $article) use ($schema) {
                $article->publisher((new Organization())->name($schema['publisherName'])->logo($schema['publisherLogo']));
            })
            ->if($schema['authorType'] == 'Person', function (\Spatie\SchemaOrg\Article $article) use ($schema) {
                $article->author((new Person())->name($schema['authorName'])->url($schema['authorUrl']));
            })
            ->if($schema['authorType'] == 'Organization', function (\Spatie\SchemaOrg\Article $article) use ($schema) {
                $article->author((new Organization())->name($schema['authorName'])->url($schema['authorUrl']));
            });
    }
}
