<?php

namespace Modules\Shop\Http\Logics;

use Modules\Main\Action\FetchServiceData;
use Modules\Main\Action\ServiceResult;
use Modules\Main\Action\ServiceWrapper;
use Modules\Main\Traits\Trash\HasTrash;
use Illuminate\Support\Arr;
use Modules\Shop\Models\Attribute;
use Modules\Shop\Models\AttributeValue;


class AttributeValuesLogic
{
     //use HasTrash;
    const model = Attribute::class;

    public function getAllValues(Attribute $attribute)
    {
        return app(ServiceWrapper::class)(function () use ($attribute) {
            return app(FetchServiceData::class)($attribute->values() ,['value', 'created_at']);
        });
    }

    public function registerValue(array $inputs, Attribute $attribute): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($attribute,$inputs) {
            return $attribute->values()->create($inputs);
        });
    }

    public function changeValue(array $inputs, AttributeValue $value)
    {
        return app(ServiceWrapper::class)(function () use ($inputs, $value) {
            $value->update($inputs);
            return $value;
        });
    }

    public function destroyValue(AttributeValue $value)
    {
        return app(ServiceWrapper::class)(fn()=>$value->delete());
    }

}
