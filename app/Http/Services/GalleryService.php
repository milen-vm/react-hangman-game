<?php

namespace App\Http\Services;

use App\Http\Services\Contracts\GalleryServiceInterface;
use App\Http\Services\Models\Gallery;
use App\Http\Services\Sites\SiteInterface;
use App\Jobs\SaveImages;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use File;
use Symfony\Component\Finder\SplFileInfo;

class GalleryService implements GalleryServiceInterface
{
    private const DELAY = 7;
    private const BLOCK_SIZE = 15;
    private const START_NUMBER = 1;
    private const HTML_FILE = 'images/gallery.html';
    private const GALLERIES_PATH = 'images';
    private const DS = DIRECTORY_SEPARATOR;

    public function __construct(private \App\Models\Gallery $gallery)
    {
    }

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

    public function getGalleriesList(): Collection
    {
        $list = Storage::disk('local')->directories(self::GALLERIES_PATH);
        $galleries = [];

        foreach($list as $item) {
            $absPath = Storage::path($item);
            [$size, $count, $modifiedAt] = $this->getGalleryData($absPath);

            $galleries[] = new Gallery(
                str_replace('-', ' ', basename($item)),
                $item,
                $absPath,
                $count,
                $size,
                $modifiedAt
            );

            // $this->gallery::create([
            //     'name' => str_replace('-', ' ', basename($item)),
            //     'rel_path' => $item,
            //     'abs_path' => $absPath,
            //     'count' => $count,
            //     'size' => $size,
            //     'created_at' => $modifiedAt,
            // ]);
        }

        return collect($galleries);
    }

    public function getGalleriesQuery(): Builder
    {
        return $this->gallery::query();
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
            // round($size / 1048576, 2),
            $size,
            count($files),
            filemtime($path . self::DS . '.'),
        ];
    }

    public function getFileData(\App\Models\Gallery $gallery, int $index): array
    {
        $filesData = Cache::rememberForever($gallery->rel_path, function () use ($gallery) {
            $filesInfo = File::files($gallery->abs_path);
            $filesData = [];
            foreach($filesInfo as $file) {
                if ($file->getType() !== 'file') {
                    continue;
                }

                $filesData[] = [
                    'ext' => $file->getExtension(),
                    'path' => $file->getRealPath(),
                ];
            }

            return $filesData;
        });

        if (!isset($filesData[$index])) {
            throw new \Exception('Invalid file index');
        }

        return $filesData[$index];
    }

    public function getFile(string $path): string
    {
        $file = File::get($path);
        if (!$file) {
            throw new \Exception('Invalid file');
        }

        return $file;
    }
}