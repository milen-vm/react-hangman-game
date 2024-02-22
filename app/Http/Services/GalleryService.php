<?php

namespace App\Http\Services;

use App\Http\Services\Contracts\GalleryServiceInterface;
use App\Http\Services\Sites\SiteInterface;
use App\Jobs\SaveImages;
use Illuminate\Support\Facades\Storage;

class GalleryService implements GalleryServiceInterface
{
    private const DELAY = 7;
    private const BLOCK_SIZE = 15;
    private const START_NUMBER = 1;
    private const HTML_FILE = 'images/gallery.html';

    public function download(string $galleryName, string $siteName, ?string $galleryUrl = self::HTML_FILE, ?string $html = null): void
    {
        $galleryUrl = $galleryUrl ?? self::HTML_FILE;
        $this->setGallery($galleryUrl, $html);
        $site = $this->getSiteClass($siteName, $galleryUrl);
        $zeros = $site->getLeadingzeros();
        $start = self::START_NUMBER;
        $urlBlocks = $site->getUrlBlocks();

        foreach($urlBlocks as $block) {
            SaveImages::dispatch($block, $galleryName, $start, $zeros)->delay(now()->addSeconds(self::DELAY));
            $start += self::BLOCK_SIZE;
        }
    }

    private function setGallery(string $galleryUrl, ?string $html): void
    {
        if (filter_var($galleryUrl, FILTER_VALIDATE_URL)) {
            return;
        }

        if ($html) {
            Storage::disk('local')->put($galleryUrl, $html);
        }
    }

    private function getSiteClass(string $siteName, string $galleryUrl): SiteInterface
    {
        $siteName = ucfirst(strtolower($siteName));
        $className = "\\App\\Http\\Services\\Sites\\{$siteName}";

        return new $className($galleryUrl, self::BLOCK_SIZE);
    }
}