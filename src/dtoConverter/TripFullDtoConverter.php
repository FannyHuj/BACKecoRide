<?php
namespace App\dtoConverter;

use App\dto\TripFullDto;
use App\dto\TripListDto;
use App\dto\UserDtoMin;
use App\dto\CarMinDto;
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
    $trip -> setStatus($dto->getStatus());

    return $trip;

  }

  public function converterToDto($entity){

    $tripDto = new TripFullDto();
    $tripDto -> setId($entity->getId());
    $tripDto -> setDepartDate($entity->getDepartDate());
    $tripDto -> setDepartHour($entity->getDepartHour());
    $tripDto -> setDepartLocation($entity->getDepartLocation());
    $tripDto -> setArrivalDate($entity->getArrivalDate());
    $tripDto -> setArrivalHour($entity->getArrivalHour());
    $tripDto -> setArrivalLocation($entity->getArrivalLocation());
    $tripDto -> setPlaceNumber($entity->getPlaceNumber());
    $tripDto -> setCreditPrice($entity->getCreditPrice());
    $tripDto -> setStatus($entity->getStatus());
    $driver= new UserDtoMin();
    $userTripEntity = $entity->getUsers()->filter(function ($user) {
      return $user->getDriver()== true;
  });
    $userEntity= $userTripEntity->first()->getUser();
    $driver->setId($userEntity->getId());
    $driver->setLastName($userEntity->getLastName());
    $driver->setFirstName($userEntity->getFirstName());
    $driver->setPicture($userEntity->getPicture());
    $tripDto->setDriver($driver);

    $carDto= new CarMinDto();
    $carDto->setId($entity->getCar()->getId());
    $carDto->setModel($entity->getCar()->getModel());
    $carDto->setEnergy($entity->getCar()->getEnergy());
    $carDto->setColor($entity->getCar()->getColor());

    $tripDto->setCar($carDto);
    return $tripDto;

  }

}