<?php

namespace Modules\Main\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Nwidart\Modules\Facades\Module;

class RouteServiceProvider extends ServiceProvider
{
    protected string $name = 'Main';

    /**
     * Called before routes are registered.
     *
     * Register any model bindings or pattern based filters.
     */
    public function boot(): void
    {
        parent::boot();


    }

    /**
     * Define the routes for the application.
     */
    public function map(): void
    {
        $this->mapClientRoutes();
        $this->mapAuthRoutes();
        $this->mapAdminRoutes();
        $this->mapPanelRoute();
    }


    protected function mapAuthRoutes(): void
    {
        $prefix = config('sitesetting.auth_prefix');
        $this->mapping(path: '/routes/auth/web.php' ,prefix: $prefix.'/' , name: 'auth.',middleware: ['web']);
        $this->mapping(path: '/routes/auth/ajax.php' ,prefix: '/ajax/'.$prefix.'/' , name: 'auth.ajax.',middleware: ['web']);
        $this->mapping(path: '/routes/auth/api.php' ,prefix: '/api/'.$prefix.'/' , name: 'auth.api.',middleware: ['api']);

    }
    protected function mapAdminRoutes(): void
    {
        $prefix = config('sitesetting.admin_prefix');

        $this->mapping(path: '/routes/admin/web.php' ,prefix: $prefix , name: 'admin.' ,middleware: ['web', 'auth','verified', 'can:admin','auth.session','doNotCacheResponse']);
        $this->mapping(path: '/routes/admin/ajax.php' ,prefix: $prefix.'/ajax/' , name: 'admin.ajax.',middleware: ['web', 'auth','verified', 'can:admin','auth.session','doNotCacheResponse']);
        $this->mapping(path: '/routes/admin/api.php' ,prefix: $prefix.'/api/' , name: 'admin.api.',middleware: ['api','doNotCacheResponse']);

    }
    protected function mapPanelRoute(): void
    {
        $prefix = config('sitesetting.panel_prefix');
        $this->mapping(path: '/routes/panel/web.php' ,prefix: $prefix , name: 'panel.' ,middleware: ['web', 'auth','verified', 'can:client-panel' ,'auth.session' , 'doNotCacheResponse']);
        $this->mapping(path: '/routes/panel/ajax.php' ,prefix: $prefix.'/ajax/' , name: 'panel.ajax.' ,middleware: ['web', 'auth','verified', 'can:client-panel' ,'auth.session']);
        $this->mapping(path: '/routes/panel/api.php' ,prefix: $prefix.'/api/' , name: 'panel.api.');

    }

    protected function mapClientRoutes(): void
    {
        Route::middleware('web')->group(module_path($this->name, '/routes/web.php'));

        //  $this->mapping(path: '/routes/web.php' ,prefix: '' , name: '' ,middleware: ['web',]);
        $this->mapping(path: '/routes/ajax.php' ,prefix: 'ajax' , name: 'ajax.',middleware: ['web',]);

    }



    private function mapping(string $path ,?string $prefix=null,?string $name=null, array $middleware =[]): void
    {

        foreach (Module::all() as $module){
            $modulePath=$module->getPath();
            $moduleName=$module->getName();
            $adminRouteFile=$modulePath.$path;
            if(file_exists($adminRouteFile)){
               Route::middleware($middleware)->prefix($prefix)->name($name)->group(module_path($moduleName, $path));
            }
        }
    }
}
