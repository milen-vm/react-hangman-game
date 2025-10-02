<?php

namespace App\Http\Services\Sites;

class Imx extends ImxVipr implements SiteInterface
{
    protected function checkLink($link): bool
    {
        $href = $link->getAttribute('href');

        return $link->has('img') && str_contains($href, 'https');
    }

    protected function createUrl(string $url): string
    {
        return str_replace('//t/', '//i/', $url);
        // return str_replace('/upload/small/', '/u/i/', $url);
    }
}
