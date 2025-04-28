<?php
namespace App\dtoConverter;

use App\dto\CarDto;
use App\dto\TripListDto;
use App\dto\UserDtoMin;
use App\Entity\Trip;
use App\dto\CarMinDto;
use App\Services\TripService;

class TripListDtoConverter {

    private TripService $tripService;

    public function __construct(TripService $tripService)
    {
        $this->tripService = $tripService;
    }

  public function converterToEntity($dto){

        $trip = new Trip();
        $trip -> setDepartDate($dto->getDepartDate());

        return $trip;
    }

    public function converterToDto($trip){

        $driver=$this->getDriver($trip);

        $tripListDto = new TripListDto();
        $tripListDto -> setId($trip->getId());
        $tripListDto -> setDepartDate($trip->getDepartDate());
        $tripListDto -> setArrivalDate($trip->getArrivalDate());
        $tripListDto -> setCreditPrice($trip->getcreditPrice());
        $tripListDto -> setPlaceNumber($trip->getPlaceNumber());
        $tripListDto -> setDepartLocation($trip-> getDepartLocation());
        $tripListDto -> setArrivalLocation($trip-> getArrivalLocation());

        $user=new UserDtoMin();
        $user -> setFirstName($driver->getFirstName());
        $user -> setLastName($driver->getLastName());
        $user -> setPicture($driver->getPicture());
        $user->setNotation($this->tripService->getNotation($driver));

        $car=new CarMinDto();
        $car -> setId($trip->getCar()-> getId());
        $car -> setModel($trip->getCar()-> getModel());
        $car -> setEnergy($trip->getCar()-> getEnergy());
        $car -> setColor($trip->getCar()-> getColor());

        $tripListDto->setCar($car);
        $tripListDto->setUser($user);

      
        return $tripListDto;
    }


    private function getDriver($trip){
        foreach($trip->getUsers() as $userTrip){
            if($userTrip->getDriver()){ 
                return $userTrip->getUser();
            }
        }
    }

    private function getDriverNotation($trip): int
{
    $totalNotes = 0;
    $nbreNote = 0;

    foreach ($trip->getUser() as $userTrip) {
        if ($userTrip->getDriver()) {
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