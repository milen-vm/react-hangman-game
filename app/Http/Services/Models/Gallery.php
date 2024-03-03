<?php

namespace App\Http\Services\Models;

use Illuminate\Support\Carbon;

class Gallery
{
    private const string DATE_FORMAT = 'd M Y';

    private string $modifiedAtStr;
    private array $filterBy = [
        'name', 'relPath', 'count', 'size', 'modifiedAtStr', 
    ];

    public function __construct(
        public string $name,
        public string $relPath,
        public string $absPath,
        public int $count,
        public float $size,
        public int $modifiedAt
    ) {
        $this->setDate();
    }

    public function getDate(): string
    {
        return $this->modifiedAtStr;
    }

    private function setDate(): void
    {
        $this->modifiedAtStr = Carbon::createFromTimestamp($this->modifiedAt)->format(self::DATE_FORMAT);
    }

    public function getFormatedDate(string $format): string
    {
        if ($format === self::DATE_FORMAT) {

            return $this->modifiedAtStr;
        }

        return Carbon::createFromTimestamp($this->modifiedAt)->format($format);
    }

    public function filterByProps(string $search): bool
    {
        foreach ($this->filterBy as $prop) {
            $item = (string) $this->{$prop};
            if (str_contains($item, $search)) {

                return true;
            }
        }

        return false;
    }
}