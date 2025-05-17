<?php

namespace App\Controller;

use App\dto\SearchDto;
use App\dto\FiltersSearchDto;
use App\dtoConverter\TripListDtoConverter;
use App\Repository\TripRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\UserTrip;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\dto\TripFullDto;
use App\dtoConverter\TripFullDtoConverter;
use App\Repository\CarRepository;
use App\Repository\UserRepository;
use App\services\TripService;
use App\services\EmailService;
use DateTime;
use App\Entity\TripsStatusEnum;

class TripController extends AbstractController
{
    #[Route('/api/trip', methods:['POST'])]
    public function new (#[MapRequestPayload]  TripFullDto $tripDto, // Le service ANGULAR appelle cette méthode et lui envoie une interface trip Map va transformer cette interface en une entité php $trip
                         TripRepository $tripRepository, CarRepository $carRepository, UserRepository $userRepository):JsonResponse{
                            $convert=new TripFullDtoConverter();

                            $trip=$convert->converterToEntity($tripDto);
                            $car= $carRepository->findCarById($tripDto->getCar()->getId());
                            $user= $userRepository->findUserById($tripDto->getDriver()->getId());
                            $trip->setCar($car);
                            $trip->setStatus(TripsStatusEnum::Coming);
                           
                            $ut=new UserTrip();
                            $ut->setTrip($trip);
                            $ut->setUser($user);
                            $ut->setDriver(true);
                            $ut->setBookingDate(new DateTime());

                            $trip->addUser($ut);
                            $tripRepository->save($trip);

            
            return $this->json(['status' => 'success']);

    }


    #[Route('/api/trip/{id}')]
    public function show (TripRepository $repository,$id): JsonResponse{

        $trip= $repository->findTripById($id);
        $convert=new TripFullDtoConverter();
       
        $tripDto=$convert->converterToDto($trip);
        return $this->json($tripDto, 200, [], ['json_encode_options' => JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES]);
    }


    #[Route('/api/booking/trip/{id}/user/{userId}', methods:['POST'])]
    public function booking ($id, $userId, TripService $service): JsonResponse{

        $service->bookingTrip($id,$userId);

        return $this->json(['status' => 'success']);
    }


    #[Route('/api/searchTrip', methods:['POST'])]
    public function search (#[MapRequestPayload]  SearchDto $searchDto, // Le service ANGULAR appelle cette méthode et lui envoie une interface trip Map va transformer cette interface en une entité php $trip
                         TripRepository $tripRepository,TripService $tripService):JsonResponse{
         $trips = $tripRepository->search ($searchDto);

         $convert=new TripListDtoConverter($tripService);

         $dtoList = [];

         foreach($trips as $trip){
            array_push($dtoList,$convert->converterToDto($trip));
         }
         
        return $this->json($dtoList, 200, [], ['json_encode_options' => JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES]);

    }

    #[Route('/api/searchTripFilter', methods:['POST'])]
    public function filterSearch (#[MapRequestPayload]  FiltersSearchDto $filtersSearchDto, // Le service ANGULAR appelle cette méthode et lui envoie une interface trip Map va transformer cette interface en une entité php $trip
                         TripRepository $tripRepository,TripService $tripService):JsonResponse{
         $trips = $tripRepository->searchFilters ($filtersSearchDto);

         $convert=new TripListDtoConverter($tripService);

         $dtoList = [];

         foreach($trips as $trip){
            array_push($dtoList,$convert->converterToDto($trip));
         }
         
        return $this->json($dtoList, 200, [], ['json_encode_options' => JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES]);

    }

    
    #[Route('/api/cancel/trip/{id}/user/{userId}', methods:['PUT'])]
    public function cancel ($id, $userId,TripService $tripService):JsonResponse{

        $tripService->cancelTrip($id,$userId);
        
        return $this->json(['status' => 'success']);
    }

    #[Route('/api/removePassenger/trip/{tripId}/user/{id}', methods: ['PUT'])]
    public function removePassenger(int $tripId, int $id, TripRepository $tripRepository): JsonResponse
    {
        $tripRepository->removePassenger($tripId, $id);
    
        return $this->json(['status' => 'success']);
    }

    #[Route('/api/admin/TripHistoric')]
    public function showHistoric (TripRepository $repository, TripService $tripService): JsonResponse{

        $trips= $repository->findAllTrip();

        $convert=new TripListDtoConverter($tripService);
        $dtoList = [];

        foreach($trips as $trip){
            array_push($dtoList, $convert->converterToDto($trip));
        }

        return $this->json($dtoList, 200, [], ['json_encode_options' => JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES]);
    }

    #[Route('/api/findByUser/{userId}')]
    public function findTripByUser (TripRepository $repository,UserRepository $userRepository, TripService $tripService,int $userId): JsonResponse{

        $user=$userRepository->findUserById($userId);
        $trips= $repository->findTripsByUser($user);
        $convert=new TripListDtoConverter($tripService);
        $dtoList = [];

        foreach($trips as $trip){
            array_push($dtoList, $convert->converterToDto($trip));
        }

        return $this->json($dtoList, 200, [], ['json_encode_options' => JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES]);
    }

    #[Route('/api/terminate/{tripId}')]
    public function terminateTrip (TripRepository $repository,EmailService $emailService,int $tripId): JsonResponse{
        $repository-> terminateTrip($tripId);
        $content=

        "<html>
        <head>
        <title>EcoRide</title>
        </head>
        <body>
        <p>Le voyage est annulé.</p>
        </body>
        </html>";

        $emailService->sendEmail($content,"le sujet", "test@example.com");



        
        return $this->json(['status' => 'success']);
    }

    #[Route('/api/start/trip/{id}', methods:['PUT'])]
    public function startTrip ($id,TripRepository $repository):JsonResponse{

        $repository-> startTrip($id);
        return $this->json(['status' => 'success']);
  
    }


}
