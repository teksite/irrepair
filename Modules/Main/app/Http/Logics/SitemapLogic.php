<?php

namespace Modules\Main\Http\Logics;

use Illuminate\Support\Facades\Route;
use Modules\Main\Action\FetchServiceData;
use Modules\Main\Action\ServiceResult;
use Modules\Main\Action\ServiceWrapper;
use Psr\Http\Message\UriInterface;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\SitemapIndex;
use Spatie\Sitemap\Tags\Url;

class SitemapLogic
{
     //use HasTrash;
     //const model = Module::class;

    public function makeSitemapsDir()
    {
        app(ServiceWrapper::class)(function () {
            if (!is_dir(public_path('sitemaps'))) mkdir(public_path('sitemaps'));
        });
    }

    public function generateSitemaps()
    {
        foreach (glob(public_path('sitemaps/*')) as $file) {
            if (is_file($file)) unlink($file);
        }

        return app(ServiceWrapper::class)(function () {
            if (config('sitesetting.sitemap') == 'auto') {
                $this->autoMapping();
            } else {
                $this->manualMapping();
            }
        });
    }

    private function autoMapping()
    {
        set_time_limit(300);
        $path = public_path('sitemaps') . '/sitemap.xml';
        SitemapGenerator::create(config('app.url'))->writeToFile($path);
    }

    private function manualMapping()
    {
        $allUrls = [];
        foreach (config('sitemapable') as $configModule) {

            foreach ($configModule['mappables'] ?? [] as $mappables) {

                $urls = $this->mapping($mappables);

                $fileName = $mappables['file_name'] ?? 'sitemap_' . rand(1000, 9999);
                $allUrls[$fileName] = $urls;

                if (config('sitesetting.sitemap') == 'index') {
                    $sitemapIndex = SitemapIndex::create();

                    foreach ($allUrls as $name => $urls) {
                        $individualMap = Sitemap::create();
                        foreach ($urls as $url) {
                            $individualMap->add($url);
                        }
                        $path = 'sitemaps' . '/' . $name . '.xml';
                        $individualMap->writeToFile(public_path($path));
                        $sitemapIndex->add($path);
                    }

                    $sitemapIndex->writeToFile(public_path('sitemaps') . '/sitemap.xml');

                } elseif (config('sitesetting.sitemap') == 'single') {
                    $singleSitemap = Sitemap::create();

                    foreach ($allUrls as $urls) {
                        foreach ($urls as $url) {
                            $singleSitemap->add($url);
                        }
                        $path = 'sitemaps' . '/' . 'sitemap' . '.xml';
                        $singleSitemap->writeToFile(public_path($path));
                    }
                }
            }
        }
    }

    private function mapping($mappables)
    {
        $urls = [];
        if (isset($mappables['bulk'])) $urls = array_merge($urls, $this->bulkMapping($mappables['bulk']));

        if (isset($mappables['single'])) $urls = array_merge($urls, $this->instanceDriver($mappables['single']));

        return $urls;

    }

    private function instanceDriver(array $single): array
    {
        $urls=[];
        $model = $single['model'];

        $driver = $single['driver'] ?? 'instance';
        if(is_array($model)) {
            foreach ($model as $mdl) {
                if ($driver == 'instance') {
                    $urls[]= $this->mapInstancesByThemselves($mdl);
                }
                if ($driver == 'config') {
                    $urls[]= $this->mapInstancesByConfig($mdl, $single);
                }
            }
            return $urls;
        }else{
            if ($driver == 'instance') {
                $urls[]= $this->mapInstancesByThemselves($model);
                return $urls;
            }
            if ($driver == 'config') {
                $urls[]= $this->mapInstancesByConfig($model, $single);
                return $urls;
            }
        }

        return [];
    }

    private function mapInstancesByThemselves($model): array
    {
        $urls = [];

        $items = $model::query()->with(['seo'])->get();
        foreach ($items as $item) {
            if ($item->path() ==null) continue;
            if ($item->seo && $item->seo->sitemap) {
                $sitemap = $item->seo->sitemap;

                $priority = $sitemap['priority'] ?? 0.5;
                $changeFrequently = $sitemap['changeFrequently'] ?? 'yearly';

                $newUrl = Url::create($item->path())
                    ->setPriority($priority)
                    ->setChangeFrequency($changeFrequently)
                    ->setLastModificationDate($item->updated_at ?? $item->created_at);



                if(isset($sitemap['images']) && count($sitemap['images'])){
                    foreach ($sitemap['images'] ?? [] as $image) {
                        $newUrl->addImage($image['url'] ?? '', $image['description'] ?? '', $image['geo_location'] ?? '', $image['title'] ?? '');
                    }
                }else{
                    $primaryImage = $item->featured_image ?? $item->avatar ?? $item->cover ?? $item->icon ?? null;
                    if ($primaryImage) $newUrl->addImage($primaryImage);
                }


                foreach ($sitemap['videos'] ?? [] as $video) {
                    if (isset($video['cover'], $video['title'], $video['description'], $video['url'])) {
                        $newUrl->addVideo($video['cover'], $video['title'], $video['description'], $video['url']);
                    }
                }

                $urls[] = $newUrl;
            }
        }
        return $urls;


    }

    private function mapInstancesByConfig($model, $details): array
    {
        $urls = [];
        $items = $model::query()->with(['seo'])->get();

        $changeFrequently_column = $details['changeFrequently_column'] ?? null;
        $changeFrequently = $details['changeFrequently'] ?? 'yearly';
        $priority = $details['priority'] ?? 0.5;

        if (isset($details['image'])) {
            $image_url_column = $details['image']['url_column'] ?? null;
            $image_geo_column = $details['image']['geo_column'] ?? null;
            $image_title_column = $details['image']['title_column'] ?? null;

        }
        if (isset($details['video'])) {
            $video_url_column = $details['image']['url_column'] ?? null;
            $video_description = $details['image']['description_column'] ?? null;
            $video_title_column = $details['image']['title_column'] ?? null;
            $video_cover_column = $details['image']['cover_column'] ?? null;

        }

        foreach ($items as $item) {
            if ($item->path() ==null) continue;

            $newUrl = Url::create($item->path())->setPriority($priority);
            if ($changeFrequently) $newUrl->setChangeFrequency($changeFrequently);
            if ($changeFrequently_column) $newUrl->setLastModificationDate($item->$changeFrequently_column);

            if (isset($image_url_column) && $item->$image_url_column) {
                $newUrl->addImage(
                    $item->$image_url_column,
                    isset($image_description_column) ? $item->$image_description_column : '',
                    isset($image_geo_column) ? $item->$image_geo_column : '',
                    isset($_imagetitle_column) ? $item->$_imagetitle_column : '',

                );
            }

            if (isset($video_url_column, $video_description, $video_title_column, $video_cover_column)) {

                $newUrl->addVideo($item->$video_url_column, $item->$video_description, $item->$video_title_column, $item->$video_cover_column);
            }

            $urls[] = $newUrl;
        }
        return $urls;
    }

    private function bulkMapping(array $bulk): array
    {
        $newUrl=[] ;
        $bulkUrl=isset($bulk['route']) && Route::has($bulk['route']) ? route($bulk['route']) : (isset($bulk['url']) ? url($bulk['url']) : null) ;
        $priority=$bulk['priority'] ?? 0.5;
        $changeFrequently=$bulk['changeFrequently'] ?? 'monthly';
        if($bulkUrl){
            $newUrl[] = Url::create($bulkUrl)->setPriority($priority)->setChangeFrequency($changeFrequently);

        }
        return $newUrl;

    }

}
