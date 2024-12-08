<?php

namespace Modules\Main\Traits\Seo\Structures;

use Illuminate\Support\Facades\Request;
use Spatie\SchemaOrg\Graph;
use Spatie\SchemaOrg\ItemList;
use Spatie\SchemaOrg\ListItem;
use Spatie\SchemaOrg\Schema;
use Spatie\SchemaOrg\WebPage;

trait CollectionPage
{
    public function CollectionPageSchema(array $data = [], array $instance = [])
    {
        $schema = $data['schema'] ?? [];
        $items = [];

        if (isset($data['listItems'])) {
            $i = 1;
            foreach ($data['listItems'] as $item) {
                $items[] = (new ListItem())->position($i)->item((new WebPage())
                    ->name($item['title'] ?? $item['name']));
                $i++;
            }
        }

        return (new Schema())::collectionPage()
            ->identifier(url()->current() . '#webpage')
            ->url(url()->current())
            ->name($data['title'])
            ->description($data['description'])
            ->isPartOf((new Schema())::webSite()->identifier(config('app.url') . '#website'))
            ->if(count($items),function (\Spatie\SchemaOrg\CollectionPage $collectionPage) use($items){
                $collectionPage->mainEntity((new Schema())::itemList()->itemListElement($items));
            });
    }


}
