<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Concurrency;


Artisan::command('app:clear', function () {
    Concurrency::run([
        fn () => Artisan::call('comment:clear'),
        fn () =>Artisan::call('sitemap:generate'),
        fn () =>Artisan::call('otp:clear'),
        fn () =>Artisan::call('cache:prune-stale-tags'),
        fn () =>Artisan::call('queue:prune-batches --hours=48 --unfinished=300 --cancelled=150'),
        fn () =>Artisan::call('announcement:clear'),
        fn () =>Artisan::call('cache:clear-stale'),
    ]);
})->purpose('clearing unwanted and expired data');
