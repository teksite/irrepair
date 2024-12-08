<?php

namespace Modules\Main\Http\Controllers\Web\Admin\Appearances;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FilesManagerController extends Controller
{
    public function index()
    {
        return view('main::pages.admin.appearance.filemanager');
    }
}
