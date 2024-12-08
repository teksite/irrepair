<?php

namespace Modules\Page\Http\Controllers\Web\Client\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Modules\Page\Models\Page;

class PagesController extends Controller
{
    public function show(Page $page): \Illuminate\Contracts\View\View
    {
        $seo = $page->generateSeo();
        $extra=$page->meta->keyBy('key')->map(function ($item) {
           return $item->value;
        })->toArray();
        return View::first(["pages.pages.templates.$page->template", 'pages.pages.show'], compact('page' ,'extra' ,'seo'));
    }
}
