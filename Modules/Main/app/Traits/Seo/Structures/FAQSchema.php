<?php

namespace Modules\Main\Traits\Seo\Structures;

use Illuminate\Support\Facades\Request;
use Spatie\SchemaOrg\Answer;
use Spatie\SchemaOrg\FAQPage;
use Spatie\SchemaOrg\Graph;
use Spatie\SchemaOrg\Organization;
use Spatie\SchemaOrg\Person;
use Spatie\SchemaOrg\Question;
use Spatie\SchemaOrg\Schema;

trait FAQSchema
{
    public function faqSchema(array $data = [], array $instance = [])
    {
        $schema= $data['schema'] ?? [];
        if(isset($schema['faq'])) {
            $faqs = $schema['faq'];
            $items=[];
            foreach ($faqs as $faq){
                $items[]=(new Question())->name($faq['question'])->acceptedAnswer((new Answer())->name(strip_tags($faq['answer']))->text(strip_tags($faq['answer'])));
            }
            return (new Schema())::fAQPage()
                ->name($schema['title'] ?? $data['title'] ?? $instance['title'])
                ->text($schema['title'] ?? $data['title'] ?? $instance['title'])
                ->mainEntity($items);
        }


    }
}
