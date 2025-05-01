<?php

namespace App\Controller;

use App\dto\StatisticDto;
use App\services\TripService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class statisticChartController extends AbstractController

{

    #[Route('/api/covoiturages/trip-per-day', methods: ['GET'])]
    
    public function tripsPerDay(TripService $service): JsonResponse
    {

        $statisticDto=$service->getStatisticInfo();

        // Exemple de données statiques
        
        return $this->json($statisticDto, 200, [], ['json_encode_options' => JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES]);
    }

}