<?php

namespace App\Controller;

use App\Repository\TripRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Trip;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;


class TripController extends AbstractController
{
    #[Route('/api/trip', methods:['POST','PUT'])]
    public function new (#[MapRequestPayload]  Trip $trip, // Le service ANGULAR appelle cette méthode et lui envoie une interface trip Map va transformer cette interface en une entité php $trip
                         TripRepository $tripRepository):JsonResponse{
            $tripRepository->save($trip);
            return $this->json(['status' => 'success']);

    }



    #[Route('/api/trip/{id}')]
    public function show (TripRepository $repository,$id): JsonResponse{

        $tripDetails= $repository->findTripById($id);

        return $this->json($tripDetails, 200, [], ['json_encode_options' => JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES]);


    }


    #[Route('/api/searchTrip', methods:['POST'])]
    public function search (#[MapRequestPayload]  Trip $trip, // Le service ANGULAR appelle cette méthode et lui envoie une interface trip Map va transformer cette interface en une entité php $trip
                         TripRepository $tripRepository):JsonResponse{
         $trips = $tripRepository->search ($trip);

        return $this->json($trips, 200, [], ['json_encode_options' => JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES]);

    }





}
