<?php

namespace Modules\Form\Http\Controllers\Web\Admin\Receives;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Modules\Form\Http\Logics\FormsLogic;
use Modules\Form\Http\Logics\InboxesLogic;
use Modules\Form\Http\Requests\Admin\FormsRequest;
use Modules\Form\Http\Requests\Admin\InboxRequest;
use Modules\Form\Models\Form;
use Modules\Form\Models\FormInbox;
use Modules\Main\Services\Facade\WebResponse;

class InboxesController extends Controller implements HasMiddleware
{

    public function __construct(public InboxesLogic $logic)
    {

    }

    public static function middleware(): array
    {
        return [
            new Middleware('can:form-receive-read'),
            new Middleware('can:form-receive-create', only: ['create', 'store']),
            new Middleware('can:form-receive-edit', only: ['edit', 'update']),
            new Middleware('can:form-receive-delete', only: ['destroy']),
        ];
    }

    public function index(Request $request)
    {
        $trashCount = $this->logic->trashesCount()->data;

        if ($id = $request->form) {
            $form = Form::findOrFail($id);
            $inboxes = $this->logic->getAllInboxesByForm($form)->data;
            return view('form::pages.admin.inboxes.index', compact('inboxes', 'trashCount' ,'form'));

        } else {
            $inboxes = $this->logic->getAllInboxes()->data;
            return view('form::pages.admin.inboxes.index', compact('inboxes', 'trashCount'));

        }
    }


    public function create()
    {
        abort(404);
    }


    public function store(Request $request): RedirectResponse
    {
        abort(404);
    }


    public function show(FormInbox $inbox)
    {
        if(is_null($inbox->read_at)){
            $inbox->user_id = auth()->id();
            $inbox->read_at = now();
            $inbox->save();
        }
        return view('form::pages.admin.inboxes.show', compact('inbox'));
    }


    public function edit(FormInbox $inbox)
    {
        return view('form::pages.admin.inboxes.edit', compact('inbox'));
    }


    public function update(InboxRequest $request, FormInbox $inbox): RedirectResponse
    {
        $result = $this->logic->changeInbox($request->validated(), $inbox);
        return WebResponse::redirect()->byResult($result)->params($result->data)->go();
    }


    public function destroy(FormInbox $inbox)
    {
        $result = $this->logic->destroyInbox($inbox);
        return WebResponse::redirect()->byResult($result, 'admin.forms.inboxes.index')->go();
    }

}
