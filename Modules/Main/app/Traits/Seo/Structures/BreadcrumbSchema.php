<?php

namespace Modules\Main\Traits\Seo\Structures;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Request;
use Spatie\SchemaOrg\Graph;
use Spatie\SchemaOrg\Schema;

trait BreadcrumbSchema
{
    public function generateBreadcrumbSchema(array $data = [], array $instance = [])
    {

        $schema = new Schema();

        $items = [];

        $items[] = (new Schema())::listItem()
            ->position(1)
            ->item([
                'type' => 'WebPage',
                'id' => config('app.url'),
                'url' => config('app.url'),
                'name' => 'صفحه نخست',
            ]);

        if ($data) {
            $position = 2;
            foreach ($data as $title => $path) {
                $itemSchema = new Schema();
                $items[] = $itemSchema::listItem()
                    ->position($position)
                    ->item([
                        '@type' => 'WebPage',
                        '@id' => url($path),
                        'url' => url($path),
                        'name' => $title
                    ]);
                $position++;
            }
        } elseif(isset($instance['title']) || isset($instance['name'])) {
            (new Schema())::listItem()
                ->position(2)
                ->item([
                    'type' => 'WebPage',
                    'id' =>url()->current(),
                    'url' => url()->current(),
                    'name' => $instance['title'] ?? $instance['name'],
                ]);
        }

        return $schema->breadcrumbList()->identifier(url()->current() . '#breadcrumb')->itemListElement($items);
    }
}
