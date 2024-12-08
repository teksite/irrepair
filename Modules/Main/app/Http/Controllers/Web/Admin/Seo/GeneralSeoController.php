<?php

namespace Modules\Main\Http\Controllers\Web\Admin\Seo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Modules\Main\Http\Logics\SeoGeneralLogic;
use Modules\Main\Http\Requests\Admin\UpdateGeneralSeoRequest;
use Modules\Main\Services\Facade\WebResponse;

class GeneralSeoController extends Controller implements HasMiddleware
{
    public function __construct(public SeoGeneralLogic $logic)
    {
    }

    public static function middleware(): array
    {
        return [
            new Middleware('can:seo-edit'),
        ];
    }

    public function edit()
    {
        if (!isset(request()->type) || !in_array(request()->type, ['seo_general', 'seo_organization', 'seo_localBusiness'])) abort(404);

        $result = $this->logic->getGeneralSeo(request()->type);
        $seo = $result->data;

        return view('main::pages.admin.seo.general', compact('seo'));
    }


    public function update(UpdateGeneralSeoRequest $request)
    {
        $result = $this->logic->changeGeneralSeo($request->validated());
        return WebResponse::redirect()->byResult($result)->go();
    }

}
