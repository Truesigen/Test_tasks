<?php

namespace App\Domain\Carriers;

class TransCompany implements Carrier
{

    public function calculatePrice(float $weight): float
    {
        return $weight <= 10 ? 20 : 100;
    }

    public function name(): string
    {
        return 'transcompany';
    }
}
