<?php

namespace App\Http\Services\Contracts;

use App\Models\Gallery;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Symfony\Component\Finder\SplFileInfo;


interface GalleryServiceInterface
{
    public function download(string $galleryName, string $siteName, string $galleryUrl, ?string $html = null): void;
    public function getGalleriesList(): Collection;
    public function getGalleriesQuery(): Builder;
    public function getFileInfo(Gallery $gallery, int $index): SplFileInfo;
    public function getFile(SplFileInfo $fileInfo): string;
}