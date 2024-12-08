<?php

namespace Modules\Main\Http\Controllers\Web\Admin\Appearances;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class IconsController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {

        return [
            new Middleware('can:admin'),
        ];
    }

    public function index()
    {
        return view('main::pages.admin.appearance.icons' );
    }
}
