<?php

namespace App\Console\Commands;

use App\Http\Services\GalleryService;
use Illuminate\Console\Command;

class SiteImg extends Command
{
    /**
     * The name and signature of the console command.
     * site: https://vipr.im or https://imx.to
     *
     * @var string
     */
    protected $signature = 'app:site-img {galeryUrl} {galleryName} {site}';

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
        $galleryName = $this->argument('galleryName');
        $siteName = $this->argument('site');


        $galleryService = new GalleryService();
        $galleryService->download($galleryName, $siteName, $galeryUrl);
    }

    // php artisan app:site-img "images/gal.html" "name" "site"
}
