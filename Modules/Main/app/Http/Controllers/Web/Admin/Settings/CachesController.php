<?php

namespace Modules\Main\Http\Controllers\Web\Admin\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Modules\Main\Http\Logics\CachesLogic;
use Modules\Main\Services\Facade\WebResponse;

class CachesController extends Controller implements HasMiddleware
{


    public function __construct(public CachesLogic $logic)
    {
    }

    public static function middleware(): array
    {
        return [
            new Middleware('can:setting-edit'),
        ];
    }
    public function index()
    {
        $types=$this->logic->cacheTypes()->data;
        return view('main::pages.admin.settings.caches',compact('types'));
    }


    public function store(Request $request)
    {
        $validated = $this->validating($request);
        $result = $this->logic->saveCache($validated);
        return WebResponse::redirect()->byResult($result)->go();
    }

    public function destroy(Request $request)
    {
        $validated = $this->validating($request);
        $result = $this->logic->destroyCache($validated);
        return WebResponse::redirect()->byResult($result)->go();
    }

    private function validating($request)
    {
        $validation=Validator::make($request->all(),[
            'type'=>['required','string',Rule::in($this->logic->cacheTypes()->data)],
        ]);
        if ($validation->fails()) abort(404);

        return $validation->validated();
    }
}
