<?php

use Modules\Page\Models\Page;

return [
    'diver' => 'instance',
    'mappables' => [
        [
            'file_name' => 'page_sitemap',
            'single' => [
                'model' => Page::class,
                'driver' => 'instance',

                'image' => [
                    'url_column' => 'featured_image',
                    'description_column' => 'excerpt',
                    'title_column' => 'title',
                ],
                'priority' => 0.8,
                'changeFrequently_column' => 'updated_at',
                'changeFrequently' => 'yearly'


            ],
        ],

    ]

];
