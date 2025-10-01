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
    protected $urls = [];
    /**
     * @var int
     */
    protected $leadingZeros = 0;

    public function __construct(string $galeryUrl)
    {
        $this->galeryUrl = $galeryUrl;

        $this->setUrls();
        $this->setLeadingzeros();
    }

    abstract protected function setUrls();

    public function getLeadingzeros(): int
    {
        return $this->leadingZeros;
    }

    public function getUrls(): array
    {
        return $this->urls;
    }

    protected function setLeadingzeros(): void
    {
        $count = count($this->urls);
        if ($count === 0) {
            $this->leadingZeros = 0;

            return;
        }

        $this->leadingZeros = strlen(strval($count));
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