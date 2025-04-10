<?php

namespace App\Controller;

use App\dtoConverter\TripListDtoConverter;
use App\Repository\TripRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Trip;
use App\Entity\TripsStatusEnum;
use App\Entity\User;
use App\Entity\UserTrip;
use App\Repository\UserTripRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use App\dto\TripFullDto;
use App\dtoConverter\TripFullDtoConverter;
use App\Repository\CarRepository;
use App\Repository\UserRepository;

class TripController extends AbstractController
{
    #[Route('/api/trip', methods:['POST'])]
    public function new (#[MapRequestPayload]  TripFullDto $tripDto, // Le service ANGULAR appelle cette méthode et lui envoie une interface trip Map va transformer cette interface en une entité php $trip
                         TripRepository $tripRepository, CarRepository $carRepository, UserRepository $userRepository):JsonResponse{
                            $convert=new TripFullDtoConverter();

                            $trip=$convert->converterToEntity($tripDto);
                            $car= $carRepository->findCarById($tripDto->getCarId());
                            $user= $userRepository->findUserById($tripDto->getUserId());
                            $trip->setStatus(TripsStatusEnum::Coming->label);
                            $trip->setCar($car);
                           
                            $ut=new UserTrip();
                            $ut->setTrip($trip);
                            $ut->setUser($user);
                            $ut->isDriver(true);

                            $trip->addUser($ut);
                            $tripRepository->save($trip);

            
            return $this->json(['status' => 'success']);

    }



    #[Route('/api/trip/{id}')]
    public function show (TripRepository $repository,$id): JsonResponse{

        $tripDetails= $repository->findTripById($id);

        return $this->json($tripDetails, 200, [], ['json_encode_options' => JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES]);
    }


    #[Route('/api/trip/{id}/addPassenger', methods:['POST'])]
    public function addPassenger ($id, #[MapRequestPayload]  User $user,TripRepository $repository, UserTripRepository $utRepository): JsonResponse{

         $trip= $repository->findTripById($id);

         $ut=new UserTrip();
         $ut->setTrip($trip);
         $ut->setUser($user);
         $ut->setRole('P');

         $trip->placeNumber=$trip->placeNumber-1;
         $trip->users->push($ut);

         $repository-> save($trip);

        return $this->json(['status' => 'success']);
    }


    #[Route('/api/searchTrip', methods:['POST'])]
    public function search (#[MapRequestPayload]  Trip $trip, // Le service ANGULAR appelle cette méthode et lui envoie une interface trip Map va transformer cette interface en une entité php $trip
                         TripRepository $tripRepository):JsonResponse{
         $trips = $tripRepository->search ($trip);

         $convert=new TripListDtoConverter();

         $dtoList = [];

         foreach($trips as $trip){
            array_push($dtoList,$convert->converterToDto($trip));
         }
         
        return $this->json($dtoList, 200, [], ['json_encode_options' => JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES]);

    }
}
