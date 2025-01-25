<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Trip;
use Symfony\Component\HttpFoundation\JsonResponse;

class TripController extends AbstractController
{
    #[Route('/trip', methods:['POST'])]
    public function new (#[MapRequestPayload] Trip $trip):JsonResponse{
        return $this->json(['status' => 'succes']);
    }
}
