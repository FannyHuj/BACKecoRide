<?php

namespace App\Controller;

use App\dto\SearchDto;
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
use Symfony\Component\Mailer\MailerInterface;

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
                           
                            $ut=new UserTrip();
                            $ut->setTrip($trip);
                            $ut->setUser($user);
                            $ut->setDriver(true);

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
    public function booking ($id, $userId, TripRepository $repository, UserRepository $userRepository): JsonResponse{

         $trip= $repository->findTripById($id);
         $user=$userRepository->findUserById($userId);

         $ut=new UserTrip();
         $ut->setTrip($trip);
         $ut->setUser($user);
         $ut->setDriver(false);
         $ut->setBookingDate(new DateTime());

         $trip->setPlaceNumber($trip->getPlaceNumber()-1);
         $trip->getUsers()->add($ut);

         $repository-> save($trip);

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

    
    #[Route('/api/cancel/trip/{id}', methods:['PUT'])]
    public function cancel ($id, TripRepository $tripRepository, MailerInterface $mailer):JsonResponse{

        $tripRepository->cancel($id,$mailer);

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
        $emailService->sendEmail("Le trajet est terminé, vous pouvez vous rendre sur votre espace pour noter le trajet","le sujet", "test@example.com");
        return $this->json(['status' => 'success']);
    }


}
