<?php

namespace App\Validation\Shipping;

use App\Validation\Validator;
use Symfony\Component\Validator\Constraints as Assert;

class CalculateValidation extends Validator
{

    protected function constraints(): Assert\Collection
    {
        return new Assert\Collection(
            [
                'carrier' => [
                    new Assert\NotBlank,
                    new Assert\Type('string'),
                ],
                'weight' => [
                    new Assert\NotBlank,
                    new Assert\Type('numeric'),
                    new Assert\Positive,
                ],
            ],
            allowExtraFields: true
        );
    }
}
