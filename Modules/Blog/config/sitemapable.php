<?php


use Modules\Blog\Models\Post;


return [
    'diver' => 'instance',
    'mappables' => [
        [
            'file_name' => 'post_sitemap',
            'single' => [
                'model' => Post::class,
                'driver' => 'instance',
//          'video'=>[
//              'url_column'=>'video',
//              'description_column'=>'description',
//              'title_column'=>'title',
//              'cover_column'=>'cover',
//          ],
                'image' => [
                    'url_column' => 'featured_image',
                    'description_column' => 'excerpt',
                    'title_column' => 'title',
                ],
                'priority' => 0.7,
                'changeFrequently_column' => 'updated_at',
                'changeFrequently' => 'monthly'


            ],
            'bulk' => [
                'route' => 'posts.index',
                //'url'=>'/blog'
                'priority' => 0.6,
                'changeFrequently' => 'weekly'
            ],

        ],

    ]

];
