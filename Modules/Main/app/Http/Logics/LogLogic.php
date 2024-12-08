<?php

namespace Modules\Main\Http\Logics;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Modules\Main\Action\FetchServiceData;
use Modules\Main\Action\ServiceResult;
use Modules\Main\Action\ServiceWrapper;
use Modules\Main\Traits\Trash;
use Illuminate\Support\Arr;



class LogLogic
{
    public function getLogFiles()
    {
        return app(ServiceWrapper::class)(function (){
                $files = Storage::drive('storage')->allFiles('logs');
            foreach ($files as $path) {
                if(File::extension($path) ==='log') $allMedia[] = File::name($path);
            }
            return $allMedia ?? [];

        },hasTransaction:false);

   }
   public function getLogContent(string $name='laravel')
    {
        return app(ServiceWrapper::class)(function () use ($name) {
                $path=storage_path("logs".DIRECTORY_SEPARATOR.$name.".log");
                if(file_exists($path)) return File::get(storage_path("logs/$name.log"));
                return null;
        },hasTransaction:false);

   }

    public function clearFile(string $name)
    {
        return app(ServiceWrapper::class)(function () use ($name) {
            $path=storage_path("logs".DIRECTORY_SEPARATOR.$name.".log");
            if(file_exists($path)) file_put_contents(storage_path("logs/$name.log"), "");
        },hasTransaction:false);
    }
}
