<?php

namespace App\Service;

use App\Domain\Carriers\CarrierFactory;

class ShippingService
{

    private string $currency;

    public function __construct(private readonly CarrierFactory $factory)
    {
        $this->currency = 'EUR';
    }

    public function getCarriers(): array
    {
        return $this->factory->getSupportedCarriers();
    }

    public function calculate(array $data)
    {

        $price = $this->factory->carrier($data['carrier'])->calculatePrice($data['weight']);

        $response = [
            'carrier' => $data['carrier'],
            'weight' => $data['weight'],
            'price' => round($price, 1),
            'currency' => $this->currency,
        ];

        return $response;
    }
}
