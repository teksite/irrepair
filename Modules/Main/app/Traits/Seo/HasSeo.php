<?php

namespace Modules\Main\Traits\Seo;

use Illuminate\Database\Eloquent\Relations\MorphOne;
use Modules\Main\Models\SeoModel;

trait HasSeo
{
    use SeoGenerator;

    public function seo(): MorphOne
    {
        return $this->morphOne(SeoModel::class, 'model', 'model_type', 'model_id');
    }

    public function saveSeo(array $inputs): void
    {
        $meta = $inputs['meta'] ?? null;
        $schema = $inputs['schema'] ?? null;
        $sitemap = $inputs['sitemap'] ?? null;

        $this->updateOrCreateSeoData($meta, $schema, $sitemap);

    }

    public function insertSeo(array|null $meta = null, array|null $schema = null, array|null $sitemap = null): void
    {
        $this->updateOrCreateSeoData($meta, $schema, $sitemap);

    }

    private function updateOrCreateSeoData(array|null $meta = null, array|null $schema = null, array|null $sitemap = null): void
    {
        $this->seo()->updateOrCreate(
            [
                'model_id' => $this->id,
                'model_type' => get_class($this),
            ],
            [
                'title' => $meta['title'] ?? $this->title ?? $this->name ?? null,
                'description' => $meta['description'] ?? $this->excerpt ?? null,
                'keywords' => exploding($meta['keywords'] ?? null),
                'conical_url' => $meta['conical_url'] ?? null,
                'indexable' => $meta['indexable'] ?? 'index',
                'followable' => $meta['followable'] ?? 'follow',
                'seo_type' => $meta['seo_type'] ?? 'WebPage',
                'schema' => $schema ?? null,
                'sitemap' => $sitemap ?? null,
            ]
        );
    }

}
