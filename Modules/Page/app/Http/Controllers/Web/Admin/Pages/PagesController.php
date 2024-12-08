<?php

namespace Modules\Page\Http\Controllers\Web\Admin\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Modules\Main\Services\Facade\WebResponse;
use Modules\Page\Http\Logics\PagesLogic;
use Modules\Page\Http\Requests\Admin\PageRequest;
use Modules\Page\Models\Page;

class PagesController extends Controller implements HasMiddleware
{

    public function __construct(public PagesLogic $logic)
    {

    }

    public static function middleware(): array
    {
        return [
            new Middleware('can:page-read'),
            new Middleware('can:page-create', only: ['create', 'store']),
            new Middleware('can:page-edit', only: ['edit', 'update']),
            new Middleware('can:page-delete', only: ['destroy']),
        ];
    }

    public function index()
    {
        $pages = $this->logic->getAllPages()->data;
        $trashCount = $this->logic->trashesCount()->data;
        return view('page::pages.admin.pages.index', compact('pages', 'trashCount'));
    }


    public function create()
    {
        return view('page::pages.admin.pages.create');
    }


    public function store(PageRequest $request): RedirectResponse
    {
        $result = $this->logic->registerPage($request->validated());
        return WebResponse::byResult($result, 'admin.pages.edit')->params($result->data)->go();
    }


    public function show(Page $page)
    {
        return redirect($page->path());
    }


    public function edit(Page $page)
    {
        return view('page::pages.admin.pages.edit', compact('page'));
    }


    public function update(PageRequest $request, Page $page): RedirectResponse
    {
        $result = $this->logic->changePage($request->validated(), $page);
        return WebResponse::redirect()->byResult($result, 'admin.pages.edit')->params($result->data)->go();
    }


    public function destroy(Page $page)
    {
        $result = $this->logic->destroyPage($page);
        return WebResponse::redirect()->byResult($result, 'admin.pages.index')->go();
    }

}
