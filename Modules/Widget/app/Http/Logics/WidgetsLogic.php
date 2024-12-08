<?php

namespace Modules\Widget\Http\Logics;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Modules\Main\Action\FetchServiceData;
use Modules\Main\Action\ServiceResult;
use Modules\Main\Action\ServiceWrapper;
use Illuminate\Support\Arr;
use Modules\Main\Traits\Trash\HasTrash;
use Modules\Widget\Models\Widget;


class WidgetsLogic
{
     use HasTrash;
     const model = Widget::class;
     public function getAllWidgets()
    {
        return app(ServiceWrapper::class)(function () {
            return app(FetchServiceData::class)(Widget::class ,['title','label']);
        });
    }

    public function registerWidget(array $inputs): ServiceResult
    {
        $inputs['label']='widget_'.Str::random(3).rand(123,987);
        return app(ServiceWrapper::class)(fn() => Widget::query()->create($inputs));
    }

    public function changeWidget(array $inputs, Widget $widget)
    {
        return app(ServiceWrapper::class)(fn()=>$widget->update($inputs));
    }

    public function destroyWidget(Widget $widget)
    {
        return app(ServiceWrapper::class)(function () use ($widget) {
            $widget->delete();
        });
    }

    public function paring(array $inputs)
    {
        return app(ServiceWrapper::class )(function () use ($inputs) {
            $label=$inputs['attributes']['label'];
            return  View::exists("widgets.$label") ? view("widgets.$label" ,compact('inputs'))->render() : Widget::firstWhere('label',$label)?->body;
        },handler:false);
    }
}
