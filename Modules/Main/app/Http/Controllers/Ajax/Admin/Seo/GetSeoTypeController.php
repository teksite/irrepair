<?php

namespace Modules\Main\Http\Controllers\Ajax\Admin\Seo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Modules\Main\Http\Logics\SeoTypesLogic;
use Modules\Main\Http\Requests\Admin\GetSeoTypeRequest;
use Modules\Main\Services\Facade\ApiResponse;

class GetSeoTypeController extends Controller
{


    public function __construct(public SeoTypesLogic $logic)
    {
    }

    public function get(GetSeoTypeRequest $request)
    {
        $result = $this->logic->getView($request->validated());
        return ApiResponse::response()->byResult($result)->reply();

    }

}
