<?php

namespace Modules\Main\Traits\Fetch;

use Illuminate\Database\Eloquent\Model;
use Modules\Blog\Models\Category;
use Modules\Main\Action\FetchServiceData;
use Modules\Main\Action\ServiceWrapper;

trait FetchData
{
    public function fetchData(Model|string $model , array $keyword=['title'],$paginate=-1)
    {
        return app(ServiceWrapper::class)(function () use ($paginate, $model,$keyword) {
            return app(FetchServiceData::class)($model, $keyword ,paginating:$paginate ,only:['id' ,'title']);
        });
    }
}
