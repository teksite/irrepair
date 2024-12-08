<?php

namespace Modules\Main\Http\Controllers\Web\Admin\Seo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OtherSeoController extends Controller
{
    public function index()
    {
        return view('main::pages.admin.seo.other');

    }
}
