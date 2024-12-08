<?php


use Modules\Blog\Models\Post;

return [
    [
        'name' => 'blog',
        'model' => Post::class,
        'columns' => ['title', 'body'],
        'relations' => ['tags'],

    ],

];
