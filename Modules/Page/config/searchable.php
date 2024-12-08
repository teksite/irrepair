<?php


use Modules\Page\Models\Page;

return [
    [
        'name' => 'pages',
        'model' => Page::class,
        'columns' => ['title', 'body'],
        'relations' => ['tags','meta'],

    ]
];
