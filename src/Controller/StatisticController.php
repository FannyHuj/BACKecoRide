<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use App\services\TripService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StatisticController extends AbstractController
{

#[Route('/api/trip/statistic', methods: ['GET'])]
    
    public function tripsPerDay(TripService $service): JsonResponse
    {

        $statisticDto=$service->getStatisticInfo();

        
        
        return $this->json($statisticDto, 200, [], ['json_encode_options' => JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES]);
    }

     #[Route('/api/trip/totalInfo', methods: ['GET'])]
    
    public function totalInfo(TripService $service): JsonResponse
    {

        $statisticDto=$service->getTotalInfo();

        
        
        return $this->json($statisticDto, 200, [], ['json_encode_options' => JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES]);
    }
}