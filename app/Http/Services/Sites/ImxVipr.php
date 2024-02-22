<?php

namespace App\Http\Services\Sites;

use DiDom\Document;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;

abstract class ImxVipr
{
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
    /**
     * @var int
     */
    protected $leadingZeros = 0;

    public function __construct(string $galeryUrl, int $blockSize)
    {
        $this->galeryUrl = $galeryUrl;
        $this->blockSize = $blockSize;

        $this->setUrlBlocks();
        $this->setLeadingzeros();
    }

    protected function setUrlBlocks(): void
    {
        $html = $this->getHtml();
        $dom = new Document($html);
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

    protected function getHtml(): string
    {
        if (Storage::disk('local')->exists($this->galeryUrl)) {
            
            return Storage::disk('local')->get($this->galeryUrl);
        }

        $client = new Client();
        $html = $client->request('GET', $this->galeryUrl)->getBody();

        return $html->getContents();
    }

    protected function setLeadingzeros(): void
    {
        $blocksCount = count($this->urlBlocks);
        if ($blocksCount === 0) {
            $this->leadingZeros = 0;

            return;
        }

        $count = ($blocksCount - 1) * $this->blockSize + count($this->urlBlocks[$blocksCount - 1]);
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