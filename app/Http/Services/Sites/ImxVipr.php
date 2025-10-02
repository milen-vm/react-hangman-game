<?php

namespace App\Http\Services\Sites;

abstract class ImxVipr extends Site
{

    abstract protected function checkLink($link): bool;

    abstract protected function createUrl(string $url): string;

    protected function setUrls(): void
    {
        $dom = $this->getDOM();
        $links = $dom->find('a:has(img)');

        foreach($links as $link) {
            $condition = $this->checkLink($link);

            if ($condition) {
                $thumb = $this->getThumb($link);

                if(is_null($thumb->getAttribute('src'))) {

                    throw new \Exception($link->getAttribute('href'));
                    // continue;
                }
                
                $url = $this->createUrl($thumb->getAttribute('src'));
                $this->urls[] = $url;
            }
        }
    }

    protected function getThumb($link)
    {
        $item = $link->find('img');
        if (is_array($item) && $item) {

            return $item[0];
        }

        return $item;
    }
}