<?php

namespace App\Console\Commands\Sites;

use DiDom\Document;
use GuzzleHttp\Client;

abstract class ImxVipr
{
    /**
     * @var \GuzzleHttp\Client
     */
    protected $client;
    /**
     * @var string
     */
    protected $galeryUrl;
    /**
     * @var int
     */
    protected $blockSize;
    /**
     * @var array
     */
    protected $urlBlocks = [];

    protected $leadingZeros = 0;

    public function __construct(string $galeryUrl, int $blockSize)
    {
        $this->client = new Client();
        $this->galeryUrl = $galeryUrl;
        $this->blockSize = $blockSize;

        $this->setUrlBlocks();
        $this->setLeadingzeros();
    }

    protected function setUrlBlocks()
    {
        $html = $this->client->request('GET', $this->galeryUrl)->getBody();
        $dom = new Document($html->getContents());
        $links = $dom->find('a:has(img)');
        $urls = [];

        foreach($links as $link) {
            $condition = $this->checkLink($link);

            if ($condition) {
                $thumb = $this->getThumb($link);
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

    protected function setLeadingzeros()
    {
        $fullBlocks = count($this->urlBlocks) - 1;
        $count = $fullBlocks * $this->blockSize + count($this->urlBlocks[$fullBlocks]);

        $this->leadingZeros = strlen(strval($count));
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