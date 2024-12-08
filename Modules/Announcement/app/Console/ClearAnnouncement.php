<?php

namespace Modules\Announcement\Console;

use Illuminate\Console\Command;
use Modules\Announcement\Models\Announcement;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ClearAnnouncement extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'announcement:clear';

    /**
     * The console command description.
     */
    protected $description = 'clear old announcements';


    public function __construct()
    {
        parent::__construct();
    }


    public function handle()
    {
        Announcement::query()->where('pinned',true)->whereDate('created_at','<=',now()->subMonths(6))->forceDelete();
        Announcement::query()->where('pinned',false)->whereDate('created_at','<=',now()->subMonths(3))->forceDelete();
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
