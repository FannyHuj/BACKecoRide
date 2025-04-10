<?php
namespace App\dtoConverter;

use App\dto\TripListDto;
use App\Entity\Trip;

class TripFullDtoConverter {

  public function converterToEntity($dto){

    $trip = new Trip();
    $trip -> setDepartDate($dto->getDepartDate());
    $trip -> setDepartHour($dto->getDepartHour());
    $trip -> setDepartLocation($dto->getDepartLocation());
    $trip -> setArrivalDate($dto->getArrivalDate());
    $trip -> setArrivalHour($dto->getArrivalHour());
    $trip -> setArrivalLocation($dto->getArrivalLocation());
    $trip -> setPlaceNumber($dto->getPlaceNumber());
    $trip -> setCreditPrice($dto->getCreditPrice());

    return $trip;

  }

}