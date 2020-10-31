<?php
declare(strict_types=1);


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

interface HomeInterface
{
    public function api(): ?array;

    public function filterArray(array $array,string $startDate,string $endDate): ?array;

}
