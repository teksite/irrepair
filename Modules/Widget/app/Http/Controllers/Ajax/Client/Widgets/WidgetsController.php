<?php

namespace Modules\Widget\Http\Controllers\Ajax\Client\Widgets;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Widget\Http\Logics\WidgetsLogic;
use Modules\Widget\Http\Requests\WidgetApiRequest;

class WidgetsController extends Controller
{

    public function __construct(public WidgetsLogic $logic)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function parser(WidgetApiRequest $request)
    {
        return $this->logic->paring($request->validated())->data;
    }
}
