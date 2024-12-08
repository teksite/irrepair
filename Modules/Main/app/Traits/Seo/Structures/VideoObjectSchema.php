<?php

namespace Modules\Main\Traits\Seo\Structures;

use Carbon\Carbon;
use phpseclib3\File\ASN1\Maps\IssuerAltName;
use Spatie\SchemaOrg\Clip;
use Spatie\SchemaOrg\ItemList;
use Spatie\SchemaOrg\Schema;
use Spatie\SchemaOrg\VideoObject;

trait VideoObjectSchema
{
    public function VideoObjectSchema(array $data = [], array $instance = [])
    {
        $videosArray = $data['schema']['videos'] ?? [];
        foreach ($videosArray as $video) {

            $clips = [];
            foreach ($video['clips'] ?? [] as $clipItem){
                $clips[] = (new Clip())->startOffset($clipItem['startOffset'])
                ->endOffset($clipItem['endOffset'])
                ->url($clipItem['url'])
                ->thumbnailUrl($clipItem['thumbnailUrl'])
                ->description($clipItem['description'] ?? '')
                ->name($clipItem['name'] ?? '');
            }
            $schemaItem[] = (new VideoObject())
                ->name($video['title'] ?? $instance['title'])
                ->description($video['description'] ?? $data['description'] ?? '')
                ->embedUrl($video['embedUrl'] ?? '')
                ->contentUrl($video['contentUrl'] ?? request()->fullUrl())
                ->uploadDate($video['uploadDate'] ?? $instance['created_at'] )
                ->isFamilyFriendly(!isset($video['isFamilyFriendly']) || $video['isFamilyFriendly'] == 'yes')
                ->regionsAllowed($video['regionsAllowed'] ?? 'IR')
                ->duration(isset($video['duration']) ? toIso8601($video['duration']) : null)
                ->thumbnailUrl($video['thumbnails'] ?? [])

            ;
        }
        if (count($schemaItem) > 1) {
            return (new ItemList())->itemListElement($schemaItem);
        } else {
            return $schemaItem[0];
        }
    }
}
