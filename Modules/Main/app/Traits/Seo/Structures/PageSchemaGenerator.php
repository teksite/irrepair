<?php

namespace Modules\Main\Traits\Seo\Structures;

trait PageSchemaGenerator
{
    use WebpageSchema, ArticleSchema, BlogSchema, CollectionPage, FAQSchema, JobPositionSchema, SoftwareApplicationSchema,
        VideoObjectSchema, PersonSchema, ProductSchema;

    public function generatingPageSchema(array $data, array $default = [])
    {
        $schemaType = $data['seo_type'] ?? 'WebPage';

        return match ($schemaType) {
            'Blog' => $this->blogSchema($data, $default),
            'Article' => $this->articleSchema($data, $default),
            'CollectionPage' => $this->CollectionPageSchema($data, $default),
            'FAQPage' => $this->faqSchema($data, $default),
            'JobPosition' => $this->jobPositionSchema($data, $default),
            'SoftwareApplication' => $this->softwareApplicationSchema($data, $default),
            'VideoObject' => $this->VideoObjectSchema($data, $default),
            'Person' => $this->personSchema($data, $default),
            'Product' => $this->productSchema($data, $default),
            default => null,
        };
    }
}
