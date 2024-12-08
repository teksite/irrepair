<?php

namespace Modules\SSO\Http\Controllers\Web\Admin\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Modules\Main\Services\Facade\WebResponse;
use Modules\SSO\Http\Logics\SsoLogic;
use Modules\SSO\Http\Requests\Admin\SettingRequest;

class SsoController extends Controller implements HasMiddleware
{
    public function __construct(public SsoLogic $logic)
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
        $data=$this->logic->getSettingsType()->data ?? [];
        return view('sso::pages.admin.setting.edit' , compact('data'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SettingRequest $request): RedirectResponse
    {
        $result = $this->logic->changeSetting($request->validated());
        return WebResponse::redirect()->byResult($result)->go();
    }


}
