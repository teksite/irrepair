<?php

namespace Modules\Main\Traits\Seo\Structures;

use Illuminate\Support\Facades\Request;
use Spatie\SchemaOrg\Graph;
use Spatie\SchemaOrg\Organization;
use Spatie\SchemaOrg\Person;
use Spatie\SchemaOrg\Schema;

trait ProductSchema
{
    public function productSchema(array $data = [], array $instance = [])
    {
        $schema= $data['schema'] ?? [];

        return (new Schema())::product()
          ;
    }
}
