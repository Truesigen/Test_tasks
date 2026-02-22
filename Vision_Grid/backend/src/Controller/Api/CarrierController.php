<?php

namespace App\Controller\Api;

use App\Service\ShippingService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

class CarrierController extends AbstractController
{
    public function __construct(public readonly ShippingService $service) {}

    #[Route('/api/carriers', name: 'carriers', methods: 'GET')]
    public function index()
    {
        $carriers = $this->service->getCarriers();
        return $this->json($carriers);
    }
}
