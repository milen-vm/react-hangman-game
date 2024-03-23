<?php

namespace App\Http\Services\Contracts;

use App\Models\Gallery;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Symfony\Component\Finder\SplFileInfo;


interface GalleryServiceInterface
{
    public function download(string $galleryName, string $siteName, string $galleryUrl, ?string $html = null): void;
    public function store(string $name): void;
    public function getGalleriesList(): Collection;
    public function getGalleriesQuery(): Builder;
    public function getFileData(Gallery $gallery, int $index): array;
    public function getFile(string $path): string;
}