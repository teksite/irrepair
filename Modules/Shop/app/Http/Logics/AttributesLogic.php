<?php

namespace Modules\Shop\Http\Logics;

use Modules\Main\Action\FetchServiceData;
use Modules\Main\Action\ServiceResult;
use Modules\Main\Action\ServiceWrapper;
use Modules\Main\Traits\Trash\HasTrash;
use Illuminate\Support\Arr;
use Modules\Shop\Models\Attribute;


class AttributesLogic
{
     //use HasTrash;
     const model = Attribute::class;

    public function getAllAttributes()
    {
        return app(ServiceWrapper::class)(function () {
            return app(FetchServiceData::class)(Attribute::class ,['title', 'created_at']);
        });
    }

    public function registerAttribute(array $inputs): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($inputs) {
            return Attribute::query()->create($inputs);

        });
    }

    public function changeAttribute(array $inputs, Attribute $attribute)
    {
        return app(ServiceWrapper::class)(function () use ($inputs, $attribute) {

            $attribute->update($inputs);

            return $attribute;
        });
    }

    public function destroyAttribute(Attribute $attribute)
    {
        return app(ServiceWrapper::class)(fn()=>$attribute->delete());
    }


}
