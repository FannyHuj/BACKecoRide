<?php
namespace App\dtoConverter;

use App\dto\TripListDto;
use App\Entity\Trip;

class TripListDtoConverter {

  public function converterToEntity($dto){

        $trip = new Trip();
        $trip -> setDepartDate($dto->getDepartDate());
        $trip -> setDepartHour($dto->getDepartHour());
        $trip -> setArrivalHour($dto->getArrivalHour());

        return $trip;
    }

    public function converterToDto($trip){


        $driver=$this->getDriver($trip);
        $tripListDto = new TripListDto();
        $tripListDto -> setDepartDate($trip->getDepartDate());
        $tripListDto -> setDepartHour($trip->getDepartHour());
        $tripListDto -> setArrivalHour($trip->getArrivalHour());
        $tripListDto -> setCreditPrice($trip->getcreditPrice());
        $tripListDto -> setDriverFirstName($driver->getFirstName());
        $tripListDto -> setNotation(  $this->getDriverNotation($driver));
      
        return $tripListDto;
    }


    private function getDriver($trip){
        foreach($trip->getUsers() as $userTrip){
            if($userTrip->isDriver()){ 
                return $userTrip->getUser();
            }
        }
    }

    private function getDriverNotation( $user): int
{
    $totalNotes = 0;
    $nbreNote = 0;

    foreach ($user->getTrips() as $userTrip) {
        if ($userTrip->isDriver()) {
            $trip = $userTrip->getTrip();
            foreach ($trip->getUsers() as $passengerTrip) {
                foreach ($passengerTrip->getUser()->getReview() as $review) {
                    if ($review->getTrip() === $trip) {
                        $totalNotes += $review->getNotation();
                        $nbreNote++;
                    }
                }
            }
        }
    }

    return $nbreNote > 0 ? (int) round($totalNotes / $nbreNote) : 0;
}
}