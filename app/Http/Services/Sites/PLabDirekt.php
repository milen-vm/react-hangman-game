<?php

namespace App\Http\Services\Sites;

class PLabDirekt extends Site implements SiteInterface
{

    protected function setUrls()
    {
        $dom = $this->getDOM();
        $links = $dom->find('img.postImg');

        foreach($links as $link) {
            $this->urls[] = $link->getAttribute('src');
        }
    }
}