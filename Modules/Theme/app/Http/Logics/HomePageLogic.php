<?php

namespace Modules\Theme\Http\Logics;

use Modules\Main\Action\FetchServiceData;
use Modules\Main\Action\ServiceResult;
use Modules\Main\Action\ServiceWrapper;
use Modules\Main\Traits\Trash\HasTrash;
use Illuminate\Support\Arr;
use Modules\Theme\Models\ThemeSetting;


class HomePageLogic
{
    const PREFIX = 'homepage_';

    //use HasTrash;
     //const model = Module::class;
    public function changeThemeSetting(array $inputs)
    {
        return app(ServiceWrapper::class)(function () use ($inputs) {
            foreach ($inputs['extra'] ?? [] as $key => $value) {
                ThemeSetting::query()->updateOrCreate(
                    ['key'=>self::PREFIX.$key],
                    ['value'=>$value ?? [] ,'stance'=>'on',]
                );
            }
            cache()->forget('homepage_settings');
            cache()->forever('homepage_settings' , ThemeSetting::query()->where('key','LIKE','home_%')->get()->keyBy('key')->toArray());
        });
    }

}
