<?php

namespace App\Http\Services\Contracts;


interface GalleryServiceInterface
{
    public function download(string $galleryName, string $siteName, string $galleryUrl, ?string $html = null): void;
}