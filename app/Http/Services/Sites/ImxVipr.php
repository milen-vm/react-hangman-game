<?php

namespace App\Http\Services\Sites;

use DiDom\Document;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;
use function PHPUnit\Framework\isNull;

abstract class ImxVipr extends Site
{
    protected function setUrlBlocks(): void
    {
        $dom = $this->getDOM();
        $links = $dom->find('a:has(img)');
        $urls = [];

        foreach($links as $link) {
            $condition = $this->checkLink($link);

            if ($condition) {
                $thumb = $this->getThumb($link);

                if(is_null($thumb->getAttribute('src'))) {

                    throw new \Exception($link->getAttribute('href'));
                    // continue;
                }
                
                $url = $this->createUrl($thumb->getAttribute('src'));
                $urls[] = $url;
            }

            if (count($urls) === $this->blockSize) {
                $this->urlBlocks[] = $urls;
                $urls = [];
            }
        }

        if (count($urls)) {
            $this->urlBlocks[] = $urls;
        }
    }

    public function getLeadingzeros(): int
    {
        return $this->leadingZeros;
    }

    abstract protected function checkLink($link): bool;

    abstract protected function createUrl(string $url): string;

    protected function getThumb($link)
    {
        $item = $link->find('img');
        if (is_array($item) && $item) {

            return $item[0];
        }

        return $item;
    }

    public function getUrlBlocks(): array
    {
        return $this->urlBlocks;
    }
}