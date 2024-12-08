<?php

namespace Modules\Main\Http\Controllers\Web\Admin\Seo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Modules\Main\Http\Logics\SitemapLogic;
use Modules\Main\Services\Facade\WebResponse;

class SitemapController extends Controller implements HasMiddleware
{
    public function __construct(public SitemapLogic $logic)
    {
    }
    public static function middleware(): array
    {
        return [
            new Middleware('can:seo-edit'),
        ];
    }
    public function index()
    {
        $this->logic->makeSitemapsDir();
        return view('main::pages.admin.seo.sitemap');
    }


    public function generate()
    {
        $result =$this->logic->generateSitemaps();
        return WebResponse::redirect()->byResult($result)->go();
    }
}
