<?php

namespace Modules\Main\Traits\Seo\Structures;

use Carbon\Carbon;
use Illuminate\Support\Facades\Request;
use phpseclib3\File\ASN1\Maps\IssuerAltName;
use Spatie\SchemaOrg\Clip;
use Spatie\SchemaOrg\ItemList;
use Spatie\SchemaOrg\Organization;
use Spatie\SchemaOrg\Person;
use Spatie\SchemaOrg\Schema;
use Spatie\SchemaOrg\VideoObject;

trait PersonSchema
{
    public function personSchema(array $data = [], array $instance = [])
    {
        $schema = $data['schema'] ?? [];

        return (new Person())
             ->name($schema['name'] ?? $data['name'] ?? $instance['name'] ?? $instance['title'])
             ->url($schema['url'] ?? $data['url'] ?? $instance['path'] ?? '')
            ->image($schema['image'] ?? $data['image'] ?? $instance['avatar'] ?? $instance['featured_image'] ?? '')
            ->jobTitle($schema['jobTitle'] ?? $data['jobTitle'] ?? '')
            ->worksFor((new Organization())->name($schema['worksFor'] ?? $data['worksFor'] ??  ''))
            ->sameAs($schema['sameAs'] ?? $data['sameAs'] ?? '');

    }
}
