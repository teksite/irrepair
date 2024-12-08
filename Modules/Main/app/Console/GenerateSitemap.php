<?php

namespace Modules\Main\Console;

use Illuminate\Console\Command;
use Modules\Main\Http\Logics\SitemapLogic;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class GenerateSitemap extends Command
{

    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     */
    protected $description = 'generate sitemap based on configuration.';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }


    public function handle()
    {
        $sitemap =new SitemapLogic();
        $sitemap->makeSitemapsDir();
        $sitemap->generateSitemaps();
    }


    protected function getArguments(): array
    {
        return [
            ['example', InputArgument::REQUIRED, 'An example argument.'],
        ];
    }


    protected function getOptions(): array
    {
        return [
            ['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null],
        ];
    }
}
