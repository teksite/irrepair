<?php

namespace Modules\Main\Console;

use Illuminate\Console\Command;
use Modules\Main\Models\OneTimePassword;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ClearOtpCommand extends Command
{

    protected $signature = 'otp:clear';


    protected $description = 'clear expired otp ';


    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {

       $count = OneTimePassword::query()->where('expired_at' ,'<' ,now())->count();
       OneTimePassword::query()->where('expired_at' ,'<' ,now())->delete();
       $this->info("$count codes were expired and deleted successfully");
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
