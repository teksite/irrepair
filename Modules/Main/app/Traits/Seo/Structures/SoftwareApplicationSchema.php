<?php

namespace Modules\Main\Traits\Seo\Structures;

use Carbon\Carbon;
use Spatie\SchemaOrg\Airline;
use Spatie\SchemaOrg\Corporation;
use Spatie\SchemaOrg\EducationalOrganization;
use Spatie\SchemaOrg\GovernmentOrganization;
use Spatie\SchemaOrg\ItemList;
use Spatie\SchemaOrg\JobPosting;
use Spatie\SchemaOrg\LocalBusiness;
use Spatie\SchemaOrg\MedicalOrganization;
use Spatie\SchemaOrg\MonetaryAmount;
use Spatie\SchemaOrg\NGO;
use Spatie\SchemaOrg\Organization;
use Spatie\SchemaOrg\PerformingGroup;
use Spatie\SchemaOrg\Person;
use Spatie\SchemaOrg\Place;
use Spatie\SchemaOrg\PostalAddress;
use Spatie\SchemaOrg\QualitativeValue;
use Spatie\SchemaOrg\QuantitativeValue;
use Spatie\SchemaOrg\Quantity;
use Spatie\SchemaOrg\Schema;
use Spatie\SchemaOrg\SoftwareApplication;
use Spatie\SchemaOrg\SportsTeam;

trait SoftwareApplicationSchema
{
    public function softwareApplicationSchema(array $data = [], array $instance = [])
    {
        $schema = $data['schema'] ?? [];
        $softwareArray = $data['schema']['software'] ?? [];
        $schemaItem = [];
        foreach ($softwareArray as $software) {
            $schemaItem[] = (new SoftwareApplication())
                ->name($software['title'] ?? $instance['title'])
                ->description($software['description'] ?? $data['description'] ?? '')
                ->url($software['url'] ?? url()->current())
                ->applicationCategory($software['applicationCategory'])
                ->operatingSystem($software['operatingSystem'] ?? '')
                ->applicationSuite($software['applicationSuite'] ?? '')
                ->downloadUrl($software['downloadUrl'] ?? '')
            ;
        }
        if (count($schemaItem) > 1) {
            return (new ItemList())->itemListElement($schemaItem);
        } else {
            return $schemaItem[0];
        }
    }
}
