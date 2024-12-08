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
use Spatie\SchemaOrg\SportsTeam;

trait JobPositionSchema
{
    public function jobPositionSchema(array $data = [], array $instance = [])
    {
        $schema = $data['schema'] ?? [];
        $jobPositionArray = $data['schema']['jobPositions'] ?? [];
        $schemaItem = [];
        foreach ($jobPositionArray as $jobPosition) {
            $companyType = match ($jobPosition['companyType']) {
                'Person' => new Person(),
                default => new Organization(),
            };

            $schemaItem[] = (new JobPosting())
                ->name($jobPosition['title'])
                ->title($jobPosition['title'])
                ->description($jobPosition['description'])
                ->validThrough($jobPosition['validThrough'] ?? now())
                ->datePosted($jobPosition['datePosted'] ?? now()->addMonths(3))
                ->employmentType($jobPosition['type'] ?? 'full-type')
                ->hiringOrganization($companyType->name($jobPosition['companyTitle'] ?? __(config('app.name'))))
                ->baseSalary((new MonetaryAmount())
                    ->currency('Rial')
                    ->value((new QuantitativeValue())->unitText($jobPosition['unit'])->value($jobPosition['salary']))
                )
                ->jobLocation((new Place())
                    ->address((new PostalAddress())
                        ->streetAddress($jobPosition['street'])
                        ->addressLocality($jobPosition['city'])
                        ->addressCountry($jobPosition['country'])
                        ->postalCode($jobPosition['zipcode'])

                    )
                );
        }
        if (count($schemaItem) > 1) {
            return (new ItemList())->itemListElement($schemaItem);
        } else {
            return $schemaItem[0];
        }
    }
}
