<?php

namespace Modules\Widget\Http\Controllers\Web\Admin\Widgets;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Modules\Main\Services\Facade\WebResponse;
use Modules\Widget\Http\Logics\WidgetsLogic;
use Modules\Widget\Http\Requests\Admin\WidgetRequest;
use Modules\Widget\Models\Widget;

class WidgetsController extends Controller implements HasMiddleware
{
    public function __construct(public WidgetsLogic $logic)
    {
    }
    public static function middleware(): array
    {
        return [
            new Middleware('can:widget-read'),
            new Middleware('can:widget-create', only: ['create', 'store']),
            new Middleware('can:widget-edit', only: ['edit', 'update']),
            new Middleware('can:widget-delete', only: ['destroy']),
        ];
    }
    public function index()
    {
        $widgets = $this->logic->getAllWidgets()->data;
        $trash = $this->logic->trashesCount();
        $trashCount = $trash->data;
        return view('widget::pages.admin.widgets.index', compact('widgets' ,'trashCount'));
    }

    public function create()
    {
        return view('widget::pages.admin.widgets.create');
    }

    public function store(WidgetRequest $request): RedirectResponse
    {
        $result = $this->logic->registerWidget($request->validated());
        return WebResponse::byResult($result, 'admin.widgets.edit')->params($result->data)->go();
    }

    public function show(Widget $widget)
    {
        abort (404);
    }


    public function edit(Widget $widget)
    {
        return view('widget::pages.admin.widgets.edit',compact('widget'));
    }


    public function update(WidgetRequest $request, Widget $widget)
    {
        $result = $this->logic->changeWidget($request->validated(), $widget);
        return WebResponse::redirect()->byResult($result, 'admin.widgets.edit')->params($widget)->go();
    }

    public function destroy(Widget $widget)
    {
        $result = $this->logic->destroyWidget($widget);
        return WebResponse::redirect()->byResult($result, 'admin.widgets.index')->go();
    }
}
