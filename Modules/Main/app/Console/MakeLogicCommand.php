<?php

namespace Modules\Main\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class MakeLogicCommand extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'module:make-logic {class} {Module}';

    /**
     * The console command description.
     */
    protected $description = 'creating a service class to implement logic process in controllers';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $module = $this->argument('Module');

        $class = $this->argument('class');

        $className = class_basename($class);
       $namespace = str_replace('/', '\\', dirname($class));
       $namespace = $namespace == '.' ? '': '/'.$namespace;

       $directory = base_path('Modules/'.$module.'/app/Http/Logics/' . $namespace );
       if (!File::exists($directory))  File::makeDirectory($directory, 0755, true);

       $filePath = $directory  . $className . '.php';

       if (File::exists($filePath)) {
           $this->error("service class already exists in $directory !");
           return;
       }


       // Read the stub file
       $stub = $this->getStub();


       // Replace placeholders with actual values
       $stub = str_replace('{{ Namespace }}', $namespace, $stub);
       $stub = str_replace('{{ Module }}', $module, $stub);
       $stub = str_replace('{{ class }}', $className, $stub);

       // Write the controller file
       File::put($filePath, $stub);

       $this->info("the service created successfully at $filePath");
 }

 protected function getStub()
 {
       $stubPath=module_path('Main', 'resources/stubs/service-class.stub');
       return File::get($stubPath);

    }

    protected function getArguments(): array
    {
        return [
            ['example', InputArgument::REQUIRED, 'An example argument.'],
        ];
    }

    /**
     * Get the console command options.
     */
    protected function getOptions(): array
    {
        return [
            ['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null],
        ];
    }
}
