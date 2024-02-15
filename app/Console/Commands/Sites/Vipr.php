<?php

namespace App\Console\Commands\Sites;

class Vipr extends ImxVipr implements SiteInterface
{
    protected function checkLink($link): bool
    {
        $rel = $link->getAttribute('rel');
        $href = $link->getAttribute('href');

        return $link->has('img') && str_contains($href, 'https') && $rel === 'nofollow';
    }

    protected function createUrl(string $url): string
    {
        return str_replace('/th/', '/i/', $url);
    }
}
