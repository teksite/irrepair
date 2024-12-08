<?php

namespace Modules\Main\Providers;


use Illuminate\Support\ServiceProvider;
use Modules\Main\Services\Builder\OtpBuilder;
use Modules\Main\Services\Builder\WebResponseBuilder;
use Modules\Main\Services\Builder\ApiResponseBuilder;

class ResponseProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('WebResponse',fn()=> new WebResponseBuilder());
        $this->app->singleton('ApiResponse',fn()=> new ApiResponseBuilder());
        $this->app->singleton('Otp',fn()=> new OtpBuilder());
    }

    public function boot()
    {

    }
}
