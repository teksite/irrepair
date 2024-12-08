<?php

namespace Modules\Main\Http\Logics;

use Illuminate\Support\Facades\Artisan;
use Modules\Main\Action\FetchServiceData;
use Modules\Main\Action\ServiceResult;
use Modules\Main\Action\ServiceWrapper;
use Modules\Main\Traits\Trash;
use Illuminate\Support\Arr;
use Spatie\ResponseCache\Facades\ResponseCache;


class CachesLogic
{
    public function cacheTypes()
    {
        return app(ServiceWrapper::class)(function (){

            return ['cache','view','config','route','event','optimize','response'];
        },hasTransaction:false);

    }

    public function saveCache(array $input): ServiceResult
    {
        return app(ServiceWrapper::class)(fn() => Artisan::call($input['type'] . ":cache"),hasTransaction:false);
    }

    public function destroyCache(array $input)
    {
        if (in_array($input['type'], ['cache', 'view', 'config', 'route', 'event','optimize'])) {
            return app(ServiceWrapper::class)(fn() => Artisan::call($input['type'] . ":clear") ,hasTransaction:false);
        }

       if($input['type'] ==='response'){
           return app(ServiceWrapper::class)(fn() => ResponseCache::clear() ,hasTransaction:false);
       }


    }

}
