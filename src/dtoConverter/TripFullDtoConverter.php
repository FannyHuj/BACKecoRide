<?php
namespace App\dtoConverter;

use App\dto\TripFullDto;
use App\dto\UserDtoMin;
use App\dto\CarMinDto;
use App\Entity\Trip;
use App\Entity\Car;
use DateTime;

class TripFullDtoConverter {

    public function converterToEntity($dto) {
        $trip = new Trip();
        $trip->setDepartDate($dto->getDepartDate());
        $trip->setDepartLocation($dto->getDepartLocation());
        $trip->setArrivalDate($dto->getArrivalDate());
        $trip->setArrivalLocation($dto->getArrivalLocation());
        $trip->setPlaceNumber($dto->getPlaceNumber());
        $trip->setCreditPrice($dto->getCreditPrice());
        $trip->setStatus($dto->getStatus());
        
        return $trip;
    }

    public function converterToDto($entity) {
      $tripDto = new TripFullDto();
      $tripDto->setId($entity->getId());
  
      // Convertir la date de départ en objet DateTime
      $tripDto->setDepartDate($entity->getDepartDate()); 
  
      // Convertir l'heure de départ en objet DateTime
  
      $tripDto->setDepartLocation($entity->getDepartLocation());
  
      // Convertir la date d'arrivée en objet DateTime
      $tripDto->setArrivalDate($entity->getArrivalDate());

  
      $tripDto->setArrivalLocation($entity->getArrivalLocation());
  
      $tripDto->setPlaceNumber($entity->getPlaceNumber());
      $tripDto->setCreditPrice($entity->getCreditPrice());
      $tripDto->setStatus($entity->getStatus());

      
      // Gérer la voiture
      $carDto = new CarMinDto();
      $carDto->setId($entity->getCar()->getId());
      $carDto->setModel($entity->getCar()->getModel());
      $carDto->setEnergy($entity->getCar()->getEnergy());
      $carDto->setColor($entity->getCar()->getColor());
      $tripDto->setCar($carDto);
  
      // Gérer le conducteur
      $driver = new UserDtoMin();
      $userTripEntity = $entity->getUsers();
      
      // Trouver l'utilisateur avec le champ 'driver' égal à true
      $driverFound = false;
      foreach ($userTripEntity as $userTrip) {
          if ($userTrip->getDriver() === true) {
              $userEntity = $userTrip->getUser();
              $driver->setId($userEntity->getId());
              $driver->setLastName($userEntity->getLastName());
              $driver->setFirstName($userEntity->getFirstName());
              $driver->setPicture($userEntity->getPicture());
              $driverFound = true;
              break;
          }
      }
  
      if (!$driverFound) {
          throw new \Exception('No driver found for this trip');
      }
  
      $tripDto->setDriver($driver);
  
      return $tripDto;
  }
  
  }

