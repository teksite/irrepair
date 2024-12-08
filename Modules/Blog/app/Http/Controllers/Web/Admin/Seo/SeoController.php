<?php

namespace Modules\Blog\Http\Controllers\Web\Admin\Seo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Modules\Blog\Http\Requests\Admin\SeoBlogRequest;
use Modules\Main\Http\Logics\SeoGeneralLogic;
use Modules\Main\Http\Requests\Admin\SeoOtherGeneralRequest;
use Modules\Main\Http\Requests\Admin\UpdateGeneralSeoRequest;
use Modules\Main\Models\SeoGeneral;
use Modules\Main\Models\SeoModel;
use Modules\Main\Services\Facade\WebResponse;

class SeoController extends Controller implements HasMiddleware
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
        $result = $this->logic->getGeneralSeo('blog_index',null ,'on');
        $schema= $result->data->value;
        return view('blog::pages.admin.seo.general', compact('schema'));
    }


    public function update(SeoOtherGeneralRequest $request)
    {
        $result = $this->logic->changeOtherSeo($request->validated());
        return WebResponse::redirect()->byResult($result)->go();
    }

}
