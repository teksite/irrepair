<?php

namespace Modules\Main\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Modules\Announcement\Console\ClearAnnouncement;
use Modules\Main\Console\ClearOtpCommand;
use Modules\Main\Console\ClearStaleCache;
use Modules\Main\Console\GenerateSitemap;
use Modules\Main\Console\MakeAdministratorUser;
use Modules\Main\Console\MakeApiRequest;
use Modules\Main\Console\MakeDeleteResourceController;
use Modules\Main\Console\MakeLogicCommand;
use Modules\Main\Console\RefreshApp;
use Nwidart\Modules\Facades\Module;
use Nwidart\Modules\Json;
use Nwidart\Modules\Traits\PathNamespace;

class MainServiceProvider extends ServiceProvider
{
    use PathNamespace;

    protected string $name = 'Main';

    protected string $nameLower = 'main';

    /**
     * Boot the application events.
     */
    public function boot(): void
    {
        $this->registerCommands();
        $this->registerCommandSchedules();
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->loadMigrationsFrom(module_path($this->name, 'database/migrations'));


    }

    /**
     * Register the service provider.
     */
    public function register(): void
    {
        $this->app->register(EventServiceProvider::class);
        $this->app->register(ResponseProvider::class);
        $this->app->register(MacroProvider::class);
        $this->app->register(RouteServiceProvider::class);


    }

    /**
     * Register commands in the format of Command::class
     */
    protected function registerCommands(): void
    {
        $this->commands([
            MakeLogicCommand::class,
            RefreshApp::class,
            MakeAdministratorUser::class,
            MakeApiRequest::class,
            MakeDeleteResourceController::class,
            ClearOtpCommand::class,
            GenerateSitemap::class,
            ClearAnnouncement::class,
            ClearStaleCache::class,
        ]);
    }

    /**
     * Register command Schedules.
     */
    protected function registerCommandSchedules(): void
    {
        // $this->app->booted(function () {
        //     $schedule = $this->app->make(Schedule::class);
        //     $schedule->command('inspire')->hourly();
        // });
    }

    /**
     * Register translations.
     */
    public function registerTranslations(): void
    {
        $langPath = resource_path('lang/modules/' . $this->nameLower);

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, $this->nameLower);
            $this->loadJsonTranslationsFrom($langPath);
        } else {
            $this->loadTranslationsFrom(module_path($this->name, 'lang'), $this->nameLower);
            $this->loadJsonTranslationsFrom(module_path($this->name, 'lang'));
        }
    }

    /**
     * Register config.
     */
    protected function registerConfig(): void
    {
        $this->publishes([module_path($this->name, 'config/config.php') => config_path($this->nameLower . '.php')], 'config');
        $this->mergeConfigFrom(module_path($this->name, 'config/config.php'), $this->nameLower);


        foreach (Module::all() as $module){
            $modulePath=$module->getPath();
            $moduleName=$module->getName();
            $moduleLowerName=$module->getLowerName();
            $seoConfigPath=$modulePath."/config/sitemapable.php";
            $searchConfigPath=$modulePath."/config/searchable.php";
            $templateConfigPath=$modulePath."/config/templatable.php";

            if(file_exists($seoConfigPath)){
                $this->mergeConfigFrom(module_path($moduleName , 'config/sitemapable.php'), "sitemapable.$moduleLowerName" );
            }
            if(file_exists($searchConfigPath)){
                $this->mergeConfigFrom( module_path($moduleName , 'config/searchable.php'), "searchable.$moduleLowerName" );
            }
            if(file_exists($templateConfigPath)){
                $this->mergeConfigFrom( module_path($moduleName , 'config/templatable.php'), "templatable.$moduleLowerName" );
            }
        }

    }

    /**
     * Register views.
     */
    public function registerViews(): void
    {
        $viewPath = resource_path('views/modules/' . $this->nameLower);
        $sourcePath = module_path($this->name, 'resources/views');

        $this->publishes([$sourcePath => $viewPath], ['views', $this->nameLower . '-module-views']);

        $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(), [$sourcePath]), $this->nameLower);

//        $componentNamespace = $this->module_namespace($this->name, $this->app_path(config('modules.paths.generator.component-class.path')));
//        Blade::componentNamespace($componentNamespace, $this->nameLower);


        $componentNamespace = str_replace('/', '\\', config('modules.namespace') . '\\' . $this->name . '\\' . ltrim(config('modules.paths.generator.component-class.path'), config('modules.paths.app_folder', '')));
        Blade::componentNamespace($componentNamespace, $this->nameLower);
    }

    /**
     * Get the services provided by the provider.
     */
    public function provides(): array
    {
        return [
        ];
    }

    private function getPublishableViewPaths(): array
    {
        $paths = [];
        foreach (config('view.paths') as $path) {
            if (is_dir($path . '/modules/' . $this->nameLower)) {
                $paths[] = $path . '/modules/' . $this->nameLower;
            }
        }

        return $paths;
    }


}
