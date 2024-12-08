<?php

namespace Modules\RestrictIP\Http\Controllers\Web\Admin\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class RestrictIpsController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            new Middleware('can:permission-read'),
        ];
    }
    public function index()
    {
        return view('restrictip::pages.admin.setting.index');
    }


    public function create()
    {
        return view('restrictip::create');
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        return view('restrictip::show');
    }


    public function edit($id)
    {
        return view('restrictip::edit');
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }

}
