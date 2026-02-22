<?php

namespace App\Domain\Carriers;

use App\Domain\Carriers\Exceptions\CarrierNotFound;

class CarrierFactory
{
    private array $carrierMap;

    public function __construct(
        private iterable $carriers
    ) {
        foreach ($carriers as $carrier) {
            $this->carrierMap[$carrier->name()] = $carrier;
        }
    }

    public function carrier(string $name): Carrier
    {
        if (array_key_exists($name, $this->carrierMap) && isset($this->carrierMap[$name])) {
            return $this->carrierMap[$name];
        }

        throw new CarrierNotFound('Unsupported carrier');
    }

    public function getSupportedCarriers(): array
    {
        return array_keys($this->carrierMap);
    }
}
