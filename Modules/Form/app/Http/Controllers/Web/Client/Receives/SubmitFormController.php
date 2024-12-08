<?php

namespace Modules\Form\Http\Controllers\Web\Client\Receives;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Form\Http\Logics\InboxesLogic;
use Modules\Form\Http\Requests\Client\ReceiveRequest;
use Modules\Main\Services\Facade\WebResponse;

class SubmitFormController extends Controller
{
    public function __construct(public InboxesLogic $logic)
    {

    }

    public function store(ReceiveRequest $request)
    {
        $result = $this->logic->registerNewFormRequest($request->validated());
        return WebResponse::redirect()->byResult($result)->go();
    }
}
