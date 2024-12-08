<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Modules\Main\Models\Permission;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
//        $this->app->usePublicPath(base_path('public_html'));

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        $this->gatesDefinitions();
        $this->trashResource();

    }
    public function gatesDefinitions(): void
    {
        if (Schema::hasTable('permissions') && Schema::hasTable('permissions')) {
            if (!cache()->has('allPermissionsGates')) cache()->forever('allPermissionsGates', Permission::query()->select('title' ,'id')->get());
            $permissions = Permission::query()->select('title' ,'id')->get();//cache()->get('allPermissionsGates');
            foreach ($permissions as $permission) {
                Gate::define($permission->title, function ($user) use ($permission) {
                    return $user->hasPermission($permission->title);
                });
            }
        }
    }

    public function trashResource()
    {
        Route::macro('trashResource', function ($name, $controller, $options = []) {
            $actions = [
                'index'   => ['get', '/trash', 'index'],
                'undo'    => ['patch', '/trash/{id}', 'undo'],
                'prune'   => ['delete', '/trash/{id}', 'prune'],
                'restore' => ['patch', '/trash', 'restore'],
                'flush'   => ['delete', '/trash', 'flush'],
            ];

            Route::group($options, function () use ($name, $controller, $actions) {
                foreach ($actions as $action => [$method, $uri, $methodController]) {
                    Route::$method("$name$uri", "$controller@$methodController")->name("$name.trash.$action");
                }
            });
        });


    }
}
