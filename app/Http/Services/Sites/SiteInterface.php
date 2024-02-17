<?php 

namespace App\Http\Services\Sites;

interface SiteInterface
{
    public function getUrlBlocks(): array;
    public function getLeadingzeros(): int;
}