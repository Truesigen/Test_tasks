<?php

namespace App\Tests\Unit\Carrier;

use App\Domain\Carriers\PackGroup;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PackGroupTest extends TestCase
{
    public function testCalculatePrice()
    {
        $carrier = new PackGroup();

        $this->assertEquals(100, $carrier->calculatePrice(100));
        $this->assertEquals(12.5, $carrier->calculatePrice(12.5));
    }
}
