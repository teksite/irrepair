<?php

namespace Modules\Main\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Nwidart\Modules\Facades\Module;
use Nwidart\Modules\Json;

class MacroProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     */
    public function register(): void
    {
        //
    }

    /**
     * Get the services provided by the provider.
     */
    public function provides(): array
    {
        return [];
    }

    public function boot()
    {
        $this->moduleMacro();
        //$this->trashResource();
    }

    public function moduleMacro()
    {
        Module::macro('isInstalled', function (string $name) {
            return Module::find($name);
        });
        Module::macro('isEnable', function (string $name) {
            return in_array($name, array_keys(Module::getByStatus(1)));
        });
        Module::macro('isAvailable', function (string $name) {
            return Module::find($name) && in_array($name, array_keys(Module::getByStatus(1)));
        });
        Module::macro('info', function (string $name) {
            return (new Json(module_path($name, 'module.json')))->getAttributes();

        });
        Module::macro('getInfo', function (string $name, null|string $item = null) {
            return $this->info($name)[$item] ?? null;
        });
        Module::macro('canDisable', function (string $name) {
            return $this->getInfo($name, 'canDisable') || is_null($this->getInfo($name, 'canDisable'));

        });
        Module::macro('canDelete', function (string $name) {
            return $this->getInfo($name, 'canDelete') == true || is_null($this->getInfo($name, 'canDelete'));

        });

        Module::macro('getMenu', function (string $place, $position , mixed $data=[]) {
            $views = [];
            foreach (Module::all() as $module) {
                $moduleName = $module->getLowerName();
                $viewFile = "$moduleName::layouts.$place.partials.$position";
                if (View::exists($viewFile)) {
                    $views[] = view($viewFile ,$data)->render();
                }
            }
            return (implode("\n", $views));
        });
    }

//    public function trashResource()
//    {
//        Route::macro('trashResource', function ($name, $controller, $options = []) {
//            Route::group($options, function () use ($name, $controller) {
//                Route::get("/$name/trash", $controller . '@index')->name("$name.trash.index");
//                Route::patch("/$name/trash/{id}", $controller . '@undo')->name("$name.trash.undo");
//                Route::delete("/$name/trash/{id}", $controller . '@prune')->name("$name.trash.prune");
//                Route::patch("/$name/trash", $controller . '@restore')->name("$name.trash.restore");
//                Route::delete("/$name/trash", $controller . '@flush')->name("$name.trash.flush");
//            });
//        });
//
//
//    }

}
