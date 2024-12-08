<?php

namespace Modules\Main\Http\Controllers\Web\Admin\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class InformationController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            new Middleware('can:setting-edit'),
        ];
    }

    public function index()
    {
        return view('main::pages.admin.settings.information' );
    }
}
