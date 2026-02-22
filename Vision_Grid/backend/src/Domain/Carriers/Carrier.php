<?php

namespace App\Domain\Carriers;

interface Carrier
{
    public function calculatePrice(float $weight): float;

    public function name(): string;
}
