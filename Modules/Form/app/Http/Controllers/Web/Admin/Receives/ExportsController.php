<?php

namespace Modules\Form\Http\Controllers\Web\Admin\Receives;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Modules\Form\Http\Logics\ExportsLogic;
use Modules\Form\Http\Requests\Admin\ExportInboxRequest;
use Modules\Form\Models\Form;

class ExportsController extends Controller implements HasMiddleware
{
    public function __construct(public ExportsLogic $logic)
    {
    }

    public static function middleware(): array
    {
        return [
            new Middleware('can:form-receive-export'),
        ];
    }


    public function index()
    {
        $forms=Form::all();
        return view('form::pages.admin.export.index', compact('forms'));
    }


    public function export(ExportInboxRequest $request)
    {
        $services = $this->logic->export($request->validated());
        return $services->data;
    }
}
