<?php

namespace App\Http\Services;

use App\Http\Services\Contracts\GalleryServiceInterface;
use App\Http\Services\Sites\SiteInterface;
use App\Jobs\SaveImages;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use File;

class GalleryService implements GalleryServiceInterface
{
    private const DELAY = 7;
    private const BLOCK_SIZE = 15;
    private const START_NUMBER = 1;
    private const HTML_FILE = 'images/gallery.html';
    private const GALLERIES_PATH = 'images';
    private const DS = DIRECTORY_SEPARATOR;

    public function download(string $galleryName, string $siteName, ?string $galleryUrl = self::HTML_FILE, ?string $html = null): void
    {
        $galleryUrl = $galleryUrl ?? self::HTML_FILE;
        $this->setGallery($galleryUrl, $html);
        $site = $this->getSiteClass($siteName, $galleryUrl);
        $zeros = $site->getLeadingzeros();
        $start = self::START_NUMBER;
        $urlBlocks = $site->getUrlBlocks();

        foreach($urlBlocks as $block) {
            SaveImages::dispatch($block, $galleryName, $start, $zeros, self::GALLERIES_PATH)->delay(now()->addSeconds(self::DELAY));
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

    public function getGalleriesList(): array
    {
        $list = Storage::disk('local')->directories(self::GALLERIES_PATH);
        $galleries = [];

        foreach($list as $item) {
            [$size, $count, $modifiedAt] = $this->getGalleryData(Storage::path($item));

            $galleries[] = [
                'dir' => $item,
                'name' => basename($item),
                'count' => $count,
                'size' => $size,
                'modified_at' => $modifiedAt,
            ];
        }
        // dd(Storage::path($item));
        return $galleries;
    }

    private function getGalleryData(string $path): array
    {
        $size = 0;
        $files = File::allFiles($path);

        foreach($files as $file) {
            $size += $file->getSize();
        }

        // $modifed = Carbon::createFromTimestamp(
        //     filemtime($path . self::DS . '.')
        // )->format('d M Y');

        return [
            round($size / 1048576, 2),
            count($files),
            filemtime($path . self::DS . '.'),
        ];
    }
}