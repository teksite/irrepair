<?php

namespace Modules\Main\Http\Logics;

use Modules\Main\Action\FetchServiceData;
use Modules\Main\Action\ServiceResult;
use Modules\Main\Action\ServiceWrapper;
use Modules\Main\Models\SeoGeneral;
use Modules\Main\Traits\Trash\HasTrash;
use Illuminate\Support\Arr;



class SeoGeneralLogic
{
    public function getGeneralSeo(string $type ,?array $value=null , ?string $stance='off')
    {
        return app(ServiceWrapper::class)(fn() =>SeoGeneral::query()->firstOrCreate(['key' => $type],['value' => $value ,'stance' => $stance]));
    }

    public function changeGeneralSeo(array $inputs)
    {
        return app(ServiceWrapper::class)(function () use ($inputs) {
            $general = SeoGeneral::query()->firstWhere('key',  $inputs['key']);
            $general->update([
                'stance'=>$inputs['stance'],
                'value'=>$inputs['web'],
            ]);
        });
    }

    public function changeOtherSeo(array $inputs)
    {
        return app(ServiceWrapper::class)(function () use ($inputs) {
            $general = SeoGeneral::query()->firstWhere('key',  $inputs['key']);
            $general->update([
                'stance'=>$inputs['stance'] ?? 'on',
                'value'=>$inputs['seo']['schema'],
            ]);
        });
    }
    public function getOtherSeo(string $key)
    {
        return app(ServiceWrapper::class)(fn() => SeoGeneral::query()->firstWhere('key',  $key)?->value ?? []);
    }

}
