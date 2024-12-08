<?php

namespace Modules\Main\Traits\Seo\Structures;

use Illuminate\Support\Facades\Request;
use Modules\Main\Models\SeoGeneral;
use Spatie\SchemaOrg\ContactPoint;
use Spatie\SchemaOrg\Graph;
use Spatie\SchemaOrg\Schema;

trait SiteTypeSchema
{
    public function siteTypeSchema()
    {
        $business = SeoGeneral::query()->firstWhere('title', 'seo_localBusiness');
        $organ = SeoGeneral::query()->firstWhere('title', 'seo_organization');

        if ($business->stance == 'on') {
            return $this->businessSchema($business->value);
        }
        if ($organ->stance == 'on') {
            return $this->organSchema($organ->value);
        }
    }


    public function businessSchema($data)
    {
        $openHours = [];
        foreach ($data['OpeningHoursSpecification'] as $day => $time) {
            if ($time) {
                $opens = explode('-', $time)[0];
                $closes = explode('-', $time)[1];
                if ($opens && $closes) {
                    $openHours[] = [
                        "@type" => "OpeningHoursSpecification",
                        "dayOfWeek" => [$day],
                        "opens" => $opens,
                        "closes" => $closes,
                    ];
                }
            }
        }
        return (new Schema())::localBusiness()
            ->name($data['name'] ??__( config('app.name')))
            ->url(config('app.url'))
            ->identifier($data['id'])
            ->image($data['image'])
            ->telephone($data['telephone'])
            ->address((new Schema())->postalAddress()
                ->streetAddress($data['streetAddress'])
                ->addressLocality($data['addressLocality'])
                ->addressCountry($data['addressCountry'])
                ->postalCode($data['postalCode'])
            )->geo([$data['latitude'] , $data['longitude']])
            ->openingHoursSpecification($openHours);
    }

    private function organSchema($data)
    {
        $contactPoints=[];
        if ($data['contacts']) {
            foreach ($data['contacts'] as $contact) {
                $contactPoints[]=(new ContactPoint())
                    ->telephone($contact['telephone'])
                ->email($contact['email'])
                ->contactType($contact['contactType'])
                ->contactOption(count($contact['contactOption']) > 1 ? $contact['contactOption'] : $contact['contactOption'][0])
                    ->areaServed(count($contact['areaServed']) > 1 ? $contact['areaServed'] : $contact['areaServed'][0] )
                    ->availableLanguage(count($contact['availableLanguage']) > 1 ? $contact['availableLanguage'] : $contact['availableLanguage'][0] )
                ;
            }
        }
        return (new Schema())::organization()
            ->name($data['name'] ?? __(config('app.name')))
            ->description($data['description'] ?? null)
            ->alternateName($data['alt_name'])
            ->logo($data['logo_url'])
            ->sameAs(array_values(array_filter($data['social'] ,fn($item)=>$item )))
            ->contactPoint($contactPoints);
    }
}
