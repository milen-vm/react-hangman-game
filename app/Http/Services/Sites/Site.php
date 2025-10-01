<?php

namespace App\Http\Services\Sites;

use DiDom\Document;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;

abstract class Site
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

    abstract protected function setUrlBlocks();

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

    protected function getDOM()
    {
        $html = $this->getHtml();
        $dom = new Document($html);

        return $dom;
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
}