<?php
namespace App\dtoConverter;

use App\dto\CarDto;
use App\dto\UserDtoMin;
use App\Entity\Car;

class CarDtoConverter {

      public function converterToEntity($dto) {
        
        $car = new Car();
        $car->setModel($dto->getModel());
        $car->setRegistration($dto->getRegistration());
        $car->setEnergy($dto->getEnergy());
        $car->setColor($dto->getColor());
        $car->setFirstRegistrationDate($dto->getFirstRegistrationDate());
        $car->setBrand($dto->getBrand());
     

        return $car;
    }

    public function converterToDto($car) {

        $carDto = new CarDto();

        $carDto->setId($car->getId());
        $carDto->setModel($car->getModel());
        $carDto->setRegistration($car->getRegistration());
        $carDto->setEnergy($car->getEnergy());
        $carDto->setColor($car->getColor());
        $carDto->setFirstRegistrationDate($car->getFirstRegistrationDate());
        $carDto->setBrand($car->getBrand());

        $user=new UserDtoMin();
        $user->setId($user->getId());

        $carDto->setUser($user);
     
    
        return $carDto;
    }
    


}