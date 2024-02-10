<?php

namespace App\Console\Commands;

use App\Jobs\SaveImages;
use DiDom\Document;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class SiteImg extends Command
{
    private const DELAY = 15;
    private const BLOCK_SIZE = 20;

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
        $start = 1;

        foreach($site->getUrlBlocks() as $block) {
            SaveImages::dispatch($block, $baseName, $start, $zeros)->delay(now()->addSeconds(self::DELAY));
            $start += self::BLOCK_SIZE;
        }

        // $client = new Client();
        // $html = $client->request('GET', $galeryUrl)->getBody();

        // $dom = new Document($html->getContents());
        // $links = $dom->find('a:has(img)');
        // $urls = [];
        // $start = 1;
        // $block = 20;
        // $delay = 15;
        // $zeros = strlen(strval(count($links)));

        // foreach($links as $link) {
        //     $condition = $this->siteCondition($site, $link);

        //     if ($condition) {
        //         $thumb = $this->siteThumb($link);

        //         $url = $this->siteUrl($site, $thumb->getAttribute('src'));
        //         $urls[] = $url;
        //     }

        //     if (count($urls) === $block) {
        //         SaveImages::dispatch($urls, $baseName, $start, $zeros)->delay(now()->addSeconds($delay));
        //         $start += $block;
        //         $urls = [];
        //     }
        // }

        // if (count($urls)) {
        //     SaveImages::dispatch($urls, $baseName, $start, $zeros)->delay(now()->addSeconds($delay));
        // }
    }

    private function siteCondition(string $site, $link): bool
    {
        $href = $link->getAttribute('href');

        if ($site === 'imx') {

            return $link->has('img') && str_contains($href, 'https');
        }

        if ($site === 'vipr') {
            $rel = $link->getAttribute('rel');

            return $link->has('img') && str_contains($href, 'https') && $rel === 'nofollow';
        }

        return false;
    }

    private function siteUrl(string $site, string $url): string
    {
        if ($site === 'imx') {

            return str_replace('/t/', '/i/', $url);
        }

        if ($site === 'vipr') {

            return str_replace('/th/', '/i/', $url);
        }

        if ($site === 'imagebam') {
            
        }

        throw new \Exception('Invalid site argument: ' . $site);
    }

    private function siteThumb($link)
    {
        $item = $link->find('img');
        if (is_array($item) && $item) {

            return $item[0];
        }

        return $item;
    }

    // php artisan queue:work
    // php artisan queue:restart
    // php artisan queue:listen
}
