<?php 

namespace App\Http\Services\Sites;

interface SiteInterface
{
    public function getUrls(): array;
    public function getLeadingzeros(): int;
}