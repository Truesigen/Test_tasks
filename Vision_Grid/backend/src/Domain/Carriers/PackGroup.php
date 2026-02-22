<?php

namespace App\Domain\Carriers;

class PackGroup implements Carrier
{
    public function calculatePrice(float $weight): float
    {
        return $weight * 1;
    }

    public function name(): string
    {
        return 'packgroup';
    }
}
