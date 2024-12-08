<?php

namespace Modules\Theme\Http\Controllers\Web\Admin\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Main\Services\Facade\WebResponse;
use Modules\Theme\Http\Logics\HomePageLogic;
use Modules\Theme\Http\Requests\Admin\HomepageRequest;
use Modules\Theme\Models\ThemeSetting;

class HomeController extends Controller
{
    public function __construct(public HomePageLogic $logic)
    {
    }

    public function edit()
    {

        $items=ThemeSetting::query()->where('key','LIKE','home_%')->get()->keyBy('key')->toArray();
        return view('theme::pages.admin.home.edit',compact('items'));
    }

    public function update(HomepageRequest $request)
    {
        $result = $this->logic->changeThemeSetting($request->validated());
        return WebResponse::redirect()->byResult($result)->go();
    }
}
