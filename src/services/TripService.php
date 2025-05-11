<?php
namespace App\services;

use App\Entity\User;
use App\Repository\ReviewRepository;
use App\Repository\TripRepository;
use App\dto\StatisticDto;
use App\Entity\TripsStatusEnum;
use App\Repository\UserRepository;
use App\Entity\UserTrip;
use App\Entity\Trip;
use DateTime;
use Exception;

class TripService {

    private ReviewRepository $reviewRepository;
    private TripRepository $tripRepository;
    private UserRepository $userRepository;
    private EmailService $mailService;

    public function __construct(TripRepository $tripRepository, UserRepository $userRepository,ReviewRepository $reviewRepository,EmailService $mailService)
    {
        $this->reviewRepository = $reviewRepository;
        $this->tripRepository = $tripRepository;
        $this->userRepository = $userRepository;
        $this->mailService=$mailService;
    }

    public function getNotation(User $driver){

        $totalNotes = 0;
        $nbreNote = 0;

        //Récupère tous les trajets du driver
        $trips=$driver->getTrips();

        //Récupère les avis de chaque voyage que le driver a fait
        foreach($trips as $usertrip){
            //récupère les avis du voyage $trip
            $trip=$usertrip->getTrip();
            $reviews=$this->reviewRepository->findByTrip($trip);

            //Pour chaque avis concernant le voyage $trip on récupère la note
          foreach($reviews  as $review)
            
            $totalNotes += $review->getNotation();
            $nbreNote++;
        }
        return $nbreNote > 0 ? (int) round($totalNotes / $nbreNote) : 0;

    }

    public function getStatisticInfo()
        {
            $trips = $this->tripRepository->findAllTrip();

            $statisticDto = new StatisticDto();

            $tripTerminatedNumber = 0;
            $countsByDate = [];

            foreach ($trips as $trip) {
                foreach ($trip->getUsers() as $userTrip) { // Boucle sur CHAQUE UserTrip
                    $date = $userTrip->getBookingDate()->format('Y-m-d');

                    if (!isset($countsByDate[$date])) {
                        $countsByDate[$date] = 0;
                    }
                    $countsByDate[$date]++;
                }

                // Comptage du nombre de trips terminés
                if ($trip->getStatus() == TripsStatusEnum::Done) {
                    $tripTerminatedNumber++;
                }
            }

            // On prépare les deux tableaux séparés : dates et nombres
            $days = array_keys($countsByDate);    // toutes les dates
            $tripsPerDay = array_values($countsByDate); // toutes les quantités

            $statisticDto->setTotalUser(count($trips));
            $statisticDto->setTotalCredit($tripTerminatedNumber * 2);
            $statisticDto->setTripsPerDay($tripsPerDay);
            $statisticDto->setDay($days);

            return $statisticDto;
        }

        public function cancelTrip($tripId,$userId)
        {
            $trip=$this->tripRepository->findTripById($tripId);
            $user=$this->userRepository->findUserById($userId);

             $this->refund($trip,$user);
             $this->sendMailToPassengers($trip, $user);

             foreach($trip->getUsers() as $ut){
                if($ut->getDriver()  && $ut->getUser()->getId()==$user->getId()){
                    $trip->setStaus(TripsStatusEnum::Canceled);
                }
             }

            $trip->getPlaceNumber()+1;
            $this->tripRepository->cancel($tripId);
        }

        public function bookingTrip($tripId,$userId)
        {

            $trip= $this->tripRepository->findTripById($tripId);
            $user=$this->userRepository->findUserById($userId);
   
            if(!$this->checkBookingCondition($trip,$user)){
                throw new Exception("Vous ne pouvez pas réserver le voyage"); 
            }
            
            //Associate User to Trip
            $ut=new UserTrip();
            $ut->setTrip($trip);
            $ut->setUser($user);
            $ut->setDriver(false);
            $ut->setBookingDate(new DateTime());
   
            //gérer les places
            $trip->setPlaceNumber($trip->getPlaceNumber()-1);
            $trip->getUsers()->add($ut);

            //Gestion des crédits
            $user->setCredit($user->getCredit()-$trip->getCreditPrice());
   
            $this->tripRepository->save($trip);

        }


    private function refund($trip,$user){
       
        $user->setCredit($user->getCredit()+$trip->getCreditPrice());
    }

    private function sendMailToPassengers($trip, $user){
        foreach($trip->getUsers() as $ut){
            if($ut->getDriver()!=true  && $ut->getUser()->getId()==$user->getId()){
                $this->mailService->sendEmail("trajet annulé", "Annulation de votre trajet", $ut->getUser()->getEmail());
            }
        }
    }

    private function checkBookingCondition(Trip $trip,User $user){
       
         $placeAvailable=$trip->getPlaceNumber();
         $isAvailablePlace=$placeAvailable>count($trip->getUsers())-1 ? true : false;
         $isEnoughCredit =$trip->getCreditPrice()<$user->getCredit() ? true :false;

         return $isAvailablePlace && $isEnoughCredit;
    }


}
