<?php

namespace App\EventListener;

use App\Domain\Carriers\Exceptions\CarrierNotFound;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

#[AsEventListener(event: 'kernel.exception')]
class ExceptionListener
{
    public function __invoke(ExceptionEvent $event): void
    {

        $exception = $event->getThrowable();


        if ($exception instanceof CarrierNotFound) {
            $response = new JsonResponse([
                'error' => $exception->getMessage()
            ], 422);
            $event->setResponse($response);
        }
    }
}
