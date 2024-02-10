<?php 

namespace App\Console\Commands\Sites;

interface SiteInterface
{
    public function getUrlBlocks(): array;
    public function getLeadingzeros(): int;
}