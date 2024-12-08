<?php

namespace Modules\Captcha\Http\Logics;

use Modules\Main\Action\FetchServiceData;
use Modules\Main\Action\ServiceResult;
use Modules\Main\Action\ServiceWrapper;
use Modules\Main\Models\Setting;
use Modules\Main\Traits\Trash\HasTrash;
use Illuminate\Support\Arr;



class CaptchaLogic
{
     //use HasTrash;
     //const model = Module::class;

    public function getCaptchaData()
    {
        return app(ServiceWrapper::class)(function () {
            return Setting::query()->where('key','LIKE' , "%_captcha")->get()->keyBy('key')->toArray() ?? [];
        });
    }
    public function updateSettings(array $inputs)
    {
        return app(ServiceWrapper::class)(function () use ($inputs) {
            $data=array_values($inputs['captcha'])[0];
            $captchaRaw=Setting::query()->updateOrCreate(
                ['key'=>array_key_first($inputs['captcha'])],
                [
                    'value'=>$data['data'] ?? [],
                    'stance'=>$data['stance'],
                ]
            );
        });
    }

}
