<?php

namespace Modules\Main\Http\Controllers\Web\Admin\Seo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Modules\Main\Http\Logics\SeoRobotLogic;
use Modules\Main\Http\Requests\Admin\UpdateRobotFileRequest;
use Modules\Main\Services\Facade\WebResponse;

class RoboTDotTxtController extends Controller implements HasMiddleware
{
    public function __construct(public SeoRobotLogic $logic)
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
        $results = $this->logic->getFileRobotContent();
        $content=$results->data;

        return view('main::pages.admin.seo.robot',compact('content'));
    }


    public function update(UpdateRobotFileRequest $request)
    {
        $result = $this->logic->changeFileRobotContent($request->validated());
        return WebResponse::redirect()->byResult($result, 'admin.seo.robot.edit')->params($result->data)->go();
    }


}
