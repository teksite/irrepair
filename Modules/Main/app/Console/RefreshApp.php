<?php

namespace Modules\Main\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class RefreshApp extends Command
{

    protected $signature = 'app:refresh
                            {--admin=no : need to make a superadmin (yes/no)}
                            {--single=yes : use single files backup files instead of bulk file  (yes/no)}';

    protected $description = 'reset all tables then migrate, seed and restore data';


    public function __construct()
    {
        parent::__construct();
    }


    public function handle()
    {
        $progressbar = $this->output->createProgressBar();
        $progressbar->start();

        $admin = $this->option('admin');
        $single = $this->option('single');
        $db = [
            'username' => env('DB_USERNAME'),
            'password' => env('DB_PASSWORD'),
            'host' => env('DB_HOST'),
            'database' => env('DB_DATABASE')
        ];


        $progressbar->advance(1);
        Artisan::call('migrate:fresh');
        $this->info('migrations are reset successfully!');


        $progressbar->advance(1);
        Artisan::call('config:clear');
        $this->info('configs are cleared successfully!');

        $progressbar->advance(1);
        Artisan::call('route:clear');
        $this->info('routes are cleared successfully!');

        $progressbar->advance(1);
        //Artisan::call('view:clear');
        $this->info('views are cleared successfully!');

        $progressbar->advance(1);
        Artisan::call('cache:clear');
        $this->info('caches are cleared successful!');

        $progressbar->advance(1);
        Artisan::call('responsecache:clear');
        $this->info('response caches are cleared successful!');

        $progressbar->advance(1);



        $progressbar->advance(1);
        if($single==='yes'){
            Artisan::call('migrate');
            $this->info('migrations are refreshed successfully!');

            $progressbar->advance(1);
            Artisan::call("module:seed Main");
            $this->info('modules seeds are refreshed successfully!');

            $progressbar->advance(1);
            Artisan::call('db:seed');
            $this->info('seeds are refreshed successfully!');

            $progressbar->advance(1);

            if(is_dir(storage_path('backups/singles/'))) {
                $files = array_diff(scandir(storage_path('backups/singles/')), array('..', '.'));
                foreach ($files as $file) {
                    $this->info('restoring: ' . $file . '...');

                    $sql = storage_path('backups/singles/' . $file);
                    exec("mysql --user={$db['username']} --password={$db['password']} --host={$db['host']} --database {$db['database']} < $sql",);
                    $progressbar->advance(1);
                    $this->info('restored: ' . $file . ' !');
                }
            }

        }else{

            if(is_dir(storage_path('backups/'))) {
                $files = array_diff(scandir(storage_path('backups/')), array('..', '.'));
                    $file=$files[2];
                    $this->info('restoring: ' . $file . '...');
                    $sql = storage_path('backups/' . $file);
                    exec("mysql --user={$db['username']} --password={$db['password']} --host={$db['host']} --database {$db['database']} < $sql",);
                    $progressbar->advance(1);
                    $this->info('restored: ' . $file . ' !');
            }

        }
        $this->info('data is restored successfully');


        if($admin==='yes') {
            $progressbar->advance(1);
            $this->call('make:superadmin');
        }


        $progressbar->advance(1);
        Artisan::call('config:clear');
        $this->info('configs are cleared successfully!');

        $progressbar->advance(1);
        Artisan::call('route:clear');
        $this->info('routes are cleared successfully!');

        $progressbar->advance(1);
        //Artisan::call('view:clear');
        $this->info('views are cleared successfully!');

        $progressbar->advance(1);
        Artisan::call('cache:clear');
        $this->info('caches are cleared successful!');

        $progressbar->advance(1);

        $progressbar->finish();
        $this->newLine();
        $this->alert('The site is refreshed successfully :)' );
    }




    protected function getArguments(): array
    {
        return [
            ['admin', InputArgument::OPTIONAL, 'make a super admin user.'],
        ];
    }

    protected function getOptions(): array
    {
        return [
            ['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null],
        ];
    }
}
