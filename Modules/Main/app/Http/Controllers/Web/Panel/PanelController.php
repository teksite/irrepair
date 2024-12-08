<?php

namespace Modules\Main\Http\Controllers\Web\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PanelController extends Controller
{

    public function index()
    {
        return view('main::pages.panel.index');
    }


}
