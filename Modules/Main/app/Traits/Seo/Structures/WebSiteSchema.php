<?php

namespace Modules\Main\Traits\Seo\Structures;

use Illuminate\Support\Facades\Request;
use Modules\Main\Models\SeoGeneral;
use Spatie\SchemaOrg\Graph;
use Spatie\SchemaOrg\Schema;

trait WebSiteSchema
{
    public function websiteSchema()
    {
        $General = SeoGeneral::query()->firstWhere('key', 'seo_general')?->value;

        $schema = new Schema();
        return $schema::webSite()
            ->name($General['title'] ??__(config('app.name')))
            ->url(config('app.url'))
            ->description($General['description'] ?? null)
            ->inLanguage($General['language'] ?? "fa_IR")
            ->setProperty('potentialAction', [
                "@type" => "SearchAction",
                "target" => route('search') . '?s={search_term_string}',
                "query-input" => "required name=search_term_string"
            ]);


    }
}
