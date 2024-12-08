<?php

namespace Modules\Main\Http\Logics;

use Illuminate\Support\Facades\File;
use Modules\Main\Action\FetchServiceData;
use Modules\Main\Action\ServiceResult;
use Modules\Main\Action\ServiceWrapper;
use Modules\Main\Traits\Trash\HasTrash;
use Illuminate\Support\Arr;



class SeoRobotLogic
{
    public function getFileRobotContent()
    {
        return app(ServiceWrapper::class)(function () {

            if (!file_exists(public_path("robots.txt"))) fopen(public_path("robots.txt"), "w");
            $filename = public_path("robots.txt");
            return  File::get($filename);
        });
    }

    public function changeFileRobotContent(array $inputs)
    {
        return app(ServiceWrapper::class)(function () use ($inputs) {
            $filename = public_path("robots.txt");
            file_put_contents($filename, $inputs['content']);
            return  File::get($filename);
        });
    }

}
