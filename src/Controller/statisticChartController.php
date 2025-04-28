<?php

namespace App\Controller;

use App\dto\StatisticDto;
use App\services\TripService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class statisticChartController extends AbstractController

{

    #[Route('/api/covoiturages/per-day', methods: ['GET'])]
    
    public function tripsPerDay(TripService $service): JsonResponse
    {

        $statisticDto=$service->getStatisticInfo();

        // Exemple de données statiques
        

        return $this->json([
            'days' => $statisticDto->getDay(),
            'counts' => $statisticDto->getTripsPerDay(),
        ]);
    }

}