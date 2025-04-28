<?php
namespace App\services;

use App\Entity\User;
use App\Repository\ReviewRepository;
use App\Repository\TripRepository;
use App\dto\StatisticDto;
use App\Entity\TripsStatusEnum;

class TripService {

    private ReviewRepository $reviewRepository;
    private TripRepository $tripRepository;

    public function __construct(TripRepository $tripRepository,ReviewRepository $reviewRepository)
    {
        $this->reviewRepository = $reviewRepository;
        $this->tripRepository = $tripRepository;
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



}
