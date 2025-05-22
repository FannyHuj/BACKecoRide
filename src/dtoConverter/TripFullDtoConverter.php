<?php
namespace App\dtoConverter;

use App\dto\TripFullDto;
use App\dto\UserDtoMin;
use App\dto\CarMinDto;
use App\dto\ReviewDto;
use App\Entity\Trip;
use App\Entity\User;
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
      $carDto->setBrand($entity->getCar()->getBrand());
      $tripDto->setCar($carDto);
  
      // Gérer le conducteur
      $driver = new UserDtoMin();
      $userTripEntity = $entity->getUsers();

      // Trouver l'utilisateur avec le champ 'driver' égal à true
      $driverFound = false;

       $reviews = [];



      $driverFound = false;

        foreach ($userTripEntity as $userTrip) {
            // lister les avis
            
           
            if ($userTrip->getDriver()) {
                $driverFound = true;
                $user = $userTrip->getUser();
                if ($user) {
                    $driver->setId($user->getId());
                    $driver->setLastName($user->getLastName());
                    $driver->setFirstName($user->getFirstName());
                    $driver->setPicture($user->getPicture());
                }
                break; // On sort de la boucle dès qu'on trouve le conducteur
            }
        }
      
      if (!$driverFound) {
          throw new \Exception('No driver found for this trip');
      }
        
         $tripDto->setDriver($driver);
  
      return $tripDto;
  }
  
  }

