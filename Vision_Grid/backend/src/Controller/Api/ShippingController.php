<?php

namespace App\Controller\Api;

use App\Service\ShippingService;
use App\Validation\Shipping\CalculateValidation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;


class ShippingController extends AbstractController
{
    public function __construct(public readonly ShippingService $service) {}


    #[Route('/api/shipping/calculate', name: 'shipping_calculate')]
    public function calculate(Request $request, CalculateValidation $validation)
    {

        $validation->validate($request->toArray());

        if ($validation->isFailed()) {
            return $this->json($validation->errors(), 422);
        }

        $response = $this->service->calculate($request->toArray());

        return $this->json($response);
    }
}
