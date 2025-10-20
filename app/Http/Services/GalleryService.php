<?php

namespace App\Http\Services;

use App\Http\Services\Contracts\GalleryServiceInterface;
use App\Http\Services\Models\Gallery;
use App\Http\Services\Sites\SiteInterface;
use App\Jobs\SaveImages;
use App\Jobs\StoreGallery;
use Illuminate\Bus\Batch;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use File;
use GuzzleHttp\Client;
use Symfony\Component\Finder\SplFileInfo;
use Throwable;

class GalleryService implements GalleryServiceInterface
{
    private const int DELAY = 7;
    private const int BLOCK_SIZE = 30;
    private const int START_NUMBER = 1;
    private const string GALLERIES_PATH = 'images';
    private const DS = DIRECTORY_SEPARATOR;

    public function __construct(private \App\Models\Gallery $gallery)
    {}

    /**
     * @param string $galleryName
     * @param string $siteName site casses in App\Http\Services\Sites
     * @param string $galleryResource web url or html string of the gallery
     * @return void
     */
    public function download(string $galleryName, string $siteName, string $galleryResource): void
    {
        if (filter_var($galleryResource, FILTER_VALIDATE_URL)) {
            $client = new Client();
            $html = $client->request('GET', $galleryResource)->getBody();
        } else {
            $html = $galleryResource;
        }

        $site = $this->getSiteClass($siteName, $html);
        $zeros = $site->getLeadingzeros();
        $start = self::START_NUMBER;
        $urlBlocks = array_chunk($site->getUrls(), self::BLOCK_SIZE);

        $jobs = [];

        foreach($urlBlocks as $block) {
            $jobs[] = new SaveImages(
                $block,
                str_ireplace(' ', '-', $galleryName),
                $start,
                $zeros,
                self::GALLERIES_PATH
            );
            // SaveImages::dispatch($block, $galleryName, $start, $zeros, self::GALLERIES_PATH)->delay(now()->addSeconds(self::DELAY));
            $start += self::BLOCK_SIZE;
        }

        $batch = Bus::batch($jobs)
            ->then(function() use ($galleryName) {
                    $this->store($galleryName);
                }
            )->catch(function (Batch $batch, Throwable $e) {
                    throw $e;
                }
            )->dispatch();
    }

    private function getSiteClass(string $siteName, string $html): SiteInterface
    {
        // TODO change site name
        // $siteName = ucfirst(strtolower($siteName));
        $className = "\\App\\Http\\Services\\Sites\\{$siteName}";

        return new $className($html);
    }

    public function store($name): void
    {
        $relPath = self::GALLERIES_PATH . self::DS . str_ireplace(' ', '-', $name);
        $absPath = Storage::path($relPath);

        StoreGallery::dispatch($name, $relPath, $absPath);
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