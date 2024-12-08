<?php

namespace Modules\Comment\Console;

use Illuminate\Console\Command;
use Modules\Comment\Models\Comment;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class RemoveCommand extends Command
{

    protected $signature = 'comment:clear';


    protected $description = 'Command description.';


    public function __construct()
    {
        parent::__construct();
    }


    public function handle()
    {
        Comment::onlyTrashed()->where('created_at', '<' , now()->subMonth())->forceDelete();
        Comment::query()->where('confirmed',  0)->where('created_at', '<' , now()->subWeeks(2))->delete();
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
