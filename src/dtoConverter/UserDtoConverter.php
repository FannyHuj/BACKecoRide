<?php
namespace App\dtoConverter;

use App\dto\UserDto;
use App\dto\CarMinDto;
use App\Entity\User;

class UserDtoConverter {

    public function converterToEntity($dto) {
        $user = new User();
        $user->setEmail($dto->getEmail());
        $user->setLastName($dto->getLastName());
        $user->setFirstName($dto->getFirstName());
        $user->setPhoneNumber($dto->getPhoneNumber());
        $user->setAddress($dto->getAddress());
        $user->setActive($dto->getActive());

        return $user;
    }

    public function converterToDto($entity) {
        $userDto = new UserDto();
        $userDto->setId($entity->getId());
        $userDto->setEmail($entity->getEmail());
        $userDto->setLastName($entity->getLastName());
        $userDto->setFirstName($entity->getFirstName());
        $userDto->setPhoneNumber($entity->getPhoneNumber());
        $userDto->setAddress($entity->getAddress());
        $userDto->setActive($entity->getActive());
        $userDto->setRoles($entity->getRoles());
    
        $cars = [];
        foreach ($entity->getCars() as $carEntity) {
            $car = new CarMinDto();
            $car->setId($carEntity->getId());
            $car->setModel($carEntity->getModel());
            $car->setEnergy($carEntity->getEnergy());
            $car->setColor($carEntity->getColor());
            $cars[] = $car;
        }
    
        $userDto->setCars($cars); 
    
        return $userDto;
    }
    

}