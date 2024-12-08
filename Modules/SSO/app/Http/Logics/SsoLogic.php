<?php

namespace Modules\SSO\Http\Logics;

use Modules\Main\Action\FetchServiceData;
use Modules\Main\Action\ServiceResult;
use Modules\Main\Action\ServiceWrapper;
use Modules\Main\Models\Setting;
use Modules\Main\Traits\Trash\HasTrash;
use Illuminate\Support\Arr;
use Modules\SSO\Enums\SsoTypeEnum;


class SsoLogic
{

    public function getSettingsType()
    {
        return app(ServiceWrapper::class)(function (){
            $socialTypes=[];
            foreach (SsoTypeEnum::cases() as $type){
                $socialTypes[$type->value]=$type->value."_authentication";
            }
            return app(FetchServiceData::class)(fn()=> Setting::query()->whereIn('key', $socialTypes))->get()->keyBy(function ($item) {
                return str_replace('_authentication' ,'' ,$item->key );
            })->toArray();
        });
    }
    public function changeSetting(array $inputs)
    {
        return app(ServiceWrapper::class)(function () use ($inputs) {
            return app(FetchServiceData::class)(function () use ($inputs) {
                foreach ($inputs['social'] as $key => $value) {
                    Setting::query()->updateOrCreate(
                        ['key' => $key . '_authentication'],
                        [
                            'value' => ['client_id' => $value['client_id'],  'client_secret_key' => $value['client_secret_key']],
                            'stance' => $value['stance'],
                        ]);
                }
            });
        });
    }


    private function getSocialAuthData(string $type)
    {
        return Setting::where('key', $type . '_authentication')->firstOrCreate(
            ['key' => $type . '_authentication'],
            [
                'value' => json_encode(['client_id' => '', 'client_secret_key' => '',]),
                'stance' => 'off'
            ]
        );
    }

}
