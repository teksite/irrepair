<?php

namespace Modules\Main\Http\Controllers\Web\Admin\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Modules\Main\Http\Logics\LogLogic;
use Modules\Main\Services\Facade\WebResponse;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class LogsController extends Controller implements HasMiddleware
{
    public array $files = [];

    public function __construct(public LogLogic $logic)
    {
        $this->files = $this->logic->getLogFiles()->data;
    }

    public static function middleware(): array
    {
        return [
            new Middleware('can:setting-edit'),
        ];
    }


    public function index()
    {
        $files = $this->files;
        $name = request()->get('log', 'laravel');
        $validation = Validator::make(request()->all(), [
            'log' => ['required', 'string', Rule::in($this->files)],
        ]);
        if ($validation->fails()) abort(404);

        $content = $this->logic->getLogContent($name)->data ?? '';

        return view('main::pages.admin.settings.logs', compact('content', 'files', 'content', 'name'));
    }


    public function clear(Request $request): RedirectResponse
    {
        $validation = Validator::make($request->all(), [
            'log' => ['required', 'string', Rule::in($this->files)],
        ]);
        if ($validation->fails()) abort(404);
        $result = $this->logic->clearFile($request->get('log'));
        return WebResponse::redirect()->byResult($result)->go();
    }
}
