<?php

namespace App\Tests\Unit\Carrier;

use App\Domain\Carriers\TransCompany;
use PHPUnit\Framework\TestCase;

class TransCompanyTest extends TestCase
{
    public function testCalculatePrice()
    {
        $carrier = new TransCompany();

        $this->assertEquals(100, $carrier->calculatePrice(11.5));
        $this->assertEquals(20, $carrier->calculatePrice(5.5));
    }
}
