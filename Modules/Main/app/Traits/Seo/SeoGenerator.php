<?php

namespace Modules\Main\Traits\Seo;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Modules\Main\Models\SeoModel;
use Modules\Main\Traits\Seo\Meta\MetaTags;
use Modules\Main\Traits\Seo\Structures\BreadcrumbSchema;
use Modules\Main\Traits\Seo\Structures\PageSchemaGenerator;
use Modules\Main\Traits\Seo\Structures\SiteTypeSchema;
use Modules\Main\Traits\Seo\Structures\WebSiteSchema;
use Spatie\SchemaOrg\Graph;

trait SeoGenerator
{
    use PageSchemaGenerator, BreadcrumbSchema, WebSiteSchema, SiteTypeSchema, MetaTags;

    public function generateSeo(array $seoData = [], array $default = []): string
    {
        $seoData = $this instanceof Model && $this->seo ? $this->seo->toArray() : $seoData;
        $default = $this instanceof Model ? $this->toArray() : $default;

        $schemaScripts = $this->schemaScripts($seoData, $default);

        $seoMetaScripts = $this->metaScripts($seoData, $default);

        return $seoMetaScripts . " \n " . $schemaScripts;
    }

    private function schemaScripts(array $seoData, array $default): string
    {
        $schemaStructures = [];
//        $schemaStructures[] = $this->siteTypeSchema();
//        $schemaStructures[] = $this->websiteSchema();

        $pageSchema = $this->pageSchema($seoData ,$default)->toScript();

        $schemaStructures[] = $this->generatingPageSchema($seoData, $default);
        $breadcrumbArray=method_exists($this, 'breadcrumb') ? $this->breadcrumb() : ($seoData['breadcrumb'] ?? []);

        $schemaStructures[] = $this->generateBreadcrumbSchema($breadcrumbArray);
        $graph = new Graph();
        foreach ($schemaStructures as $sch) if ($sch) $graph->set($sch);
        return $pageSchema ." \n " .$graph->toScript();
    }

    private function metaScripts(array $seoData, array $default): string
    {
        return $this->generateMetaTag($seoData, $default);
    }
}
