<?php

namespace App\Http\Services\Contracts;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;


interface GalleryServiceInterface
{
    public function download(string $galleryName, string $siteName, string $galleryUrl, ?string $html = null): void;
    public function getGalleriesList(): Collection;
    public function getGalleriesQuery(): Builder;
}