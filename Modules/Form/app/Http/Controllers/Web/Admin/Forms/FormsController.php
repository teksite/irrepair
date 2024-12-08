<?php

namespace Modules\Form\Http\Controllers\Web\Admin\Forms;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Modules\Form\Http\Logics\FormsLogic;
use Modules\Form\Http\Requests\Admin\FormsRequest;
use Modules\Form\Models\Form;
use Modules\Main\Services\Facade\WebResponse;

class FormsController extends Controller implements HasMiddleware
{

    public function __construct(public FormsLogic $logic)
    {

    }

    public static function middleware(): array
    {
        return [
            new Middleware('can:form-read'),
            new Middleware('can:form-create', only: ['create', 'store']),
            new Middleware('can:form-edit', only: ['edit', 'update']),
            new Middleware('can:form-delete', only: ['destroy']),
        ];
    }

    public function index()
    {
        $forms = $this->logic->getAllForms()->data;
        //$trashCount = $this->logic->trashesCount()->data;
        return view('form::pages.admin.forms.index', compact('forms'));
    }


    public function create()
    {
        return view('form::pages.admin.forms.create');
    }


    public function store(FormsRequest $request): RedirectResponse
    {
        $result = $this->logic->registerForm($request->validated());
        return WebResponse::byResult($result, 'admin.forms.edit')->params($result->data)->go();
    }


    public function show(Form $form)
    {
        return redirect($form->path());
    }


    public function edit(Form $form)
    {
        return view('form::pages.admin.forms.edit', compact('form'));
    }


    public function update(FormsRequest $request, Form $form): RedirectResponse
    {
        $result = $this->logic->changeForm($request->validated(), $form);
        return WebResponse::redirect()->byResult($result, 'admin.forms.edit')->params($form)->go();
    }


    public function destroy(Form $form)
    {
        $result = $this->logic->destroyForm($form);
        return WebResponse::redirect()->byResult($result, 'admin.forms.index')->go();
    }

}
