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
    protected $html;
    /**
     * @var array
     */
    protected $urls = [];
    /**
     * @var int
     */
    protected $leadingZeros = 0;

    public function __construct(string $html)
    {
        $this->html = $html;

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
        $dom = new Document($this->html);

        return $dom;
    }
}