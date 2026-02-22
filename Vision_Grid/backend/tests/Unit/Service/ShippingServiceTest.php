<?php

namespace App\Tests\Unit\Service;

use PHPUnit\Framework\TestCase;
use App\Service\ShippingService;
use App\Domain\Carriers\CarrierFactory;
use App\Domain\Carriers\Carrier;
use App\Domain\Carriers\Exceptions\CarrierNotFound as ExceptionsCarrierNotFound;

class ShippingServiceTest extends TestCase
{
    public function testGetCarriersReturnsSupportedCarriers(): void
    {
        $factoryMock = $this->createMock(CarrierFactory::class);
        $factoryMock
            ->expects($this->once())
            ->method('getSupportedCarriers')
            ->willReturn(['packgroup', 'transcompany']);

        $service = new ShippingService($factoryMock);

        $result = $service->getCarriers();

        $this->assertEquals(['packgroup', 'transcompany'], $result);
    }

    public function testCalculateReturnsCorrectResponse(): void
    {
        $carrierMock = $this->createMock(Carrier::class);
        $carrierMock
            ->expects($this->once())
            ->method('calculatePrice')
            ->with(10)
            ->willReturn(10.0);

        $factoryMock = $this->createMock(CarrierFactory::class);
        $factoryMock
            ->expects($this->once())
            ->method('carrier')
            ->with('packgroup')
            ->willReturn($carrierMock);

        $service = new ShippingService($factoryMock);

        $data = [
            'carrier' => 'packgroup',
            'weight' => 10
        ];

        $expected = [
            'carrier' => 'packgroup',
            'weight' => 10,
            'price' => 10,
            'currency' => 'EUR',
        ];

        $result = $service->calculate($data);

        $this->assertEquals($expected, $result);
    }

    public function testCalculateThrowsExceptionForUnknownCarrier(): void
    {
        $factoryMock = $this->createMock(CarrierFactory::class);
        $factoryMock
            ->expects($this->once())
            ->method('carrier')
            ->with('unknown')
            ->willThrowException(new ExceptionsCarrierNotFound('Unsupported carrier'));

        $service = new ShippingService($factoryMock);

        $this->expectException(ExceptionsCarrierNotFound::class);
        $this->expectExceptionMessage('Unsupported carrier');

        $service->calculate([
            'carrier' => 'unknown',
            'weight' => 5
        ]);
    }
}
