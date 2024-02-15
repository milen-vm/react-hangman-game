<?php

namespace App\Console\Commands;

use App\Jobs\SaveImages;
use Illuminate\Console\Command;

class SiteImg extends Command
{
    private const DELAY = 7;
    private const BLOCK_SIZE = 15;
    private const START_NUMBER = 1;

    /**
     * The name and signature of the console command.
     * site: https://vipr.im or https://imx.to
     *
     * @var string
     */
    protected $signature = 'app:site-img {galeryUrl} {baseName} {site}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $galeryUrl = $this->argument('galeryUrl');
        $baseName = $this->argument('baseName');

        $siteName = ucfirst($this->argument('site'));
        $className = "\\App\\Console\\Commands\\Sites\\{$siteName}";

        /**
         * @var $site \App\Console\Commands\Sites\SiteInterface
         */
        $site = new $className($galeryUrl, self::BLOCK_SIZE);
        $zeros = $site->getLeadingzeros();
        $start = self::START_NUMBER;

        foreach($site->getUrlBlocks() as $block) {
            SaveImages::dispatch($block, $baseName, $start, $zeros)->delay(now()->addSeconds(self::DELAY));
            $start += self::BLOCK_SIZE;
        }
    }

    // php artisan queue:work
    // php artisan queue:restart
    // php artisan queue:listen
}
