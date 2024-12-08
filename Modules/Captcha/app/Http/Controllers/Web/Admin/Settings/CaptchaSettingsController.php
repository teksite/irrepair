<?php

namespace Modules\Captcha\Http\Controllers\Web\Admin\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Modules\Captcha\Http\Logics\CaptchaLogic;
use Modules\Captcha\Http\Requests\Admin\CaptchaSettingRequest;
use Modules\Main\Models\Setting;
use Modules\Main\Services\Facade\WebResponse;

class CaptchaSettingsController extends Controller implements HasMiddleware
{

    public function __construct(public CaptchaLogic $logic)
    {
    }

    public static function middleware(): array
    {
        return [
            new Middleware('can:setting-edit'),
        ];
    }

    public function edit()
    {
        $result = $this->logic->getCaptchaData();
        $data=$result->data;

        return view('captcha::pages.admin.setting.edit', compact('data'));
    }


    public function update(Request $request): RedirectResponse
    {
        $result = $this->logic->updateSettings($request->toArray());
        return WebResponse::redirect()->byResult($result)->go();
    }
}
