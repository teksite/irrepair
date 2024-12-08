<?php

namespace Modules\Main\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ClearStaleCache extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'cache:clear-stale';

    /**
     * The console command description.
     */
    protected $description = 'clear expired cache from DB (if mysql driver is set for caches)';

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

       DB::table('cache')->where('expiration', '<', now()->timestamp)->delete();

    }

    /**
     * Get the console command arguments.
     */
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
