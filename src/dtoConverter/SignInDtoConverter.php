<?php
namespace App\dtoConverter;

use App\Entity\User;
use App\dto\SignInDto;

class SignInDtoConverter {

    public function converterToEntity(SignInDto $dto) {

        $newUser = new User();
        $newUser->setFirstName($dto->getFirstName());
        $newUser->setLastName($dto->getLastName());
        $newUser->setEmail($dto->getEmail());
        $newUser->setPassword($dto->getPassword());
        $newUser->setAddress($dto->getAddress());
        $newUser->setCredit(20);
        $newUser->setBirthDate($dto->getBirthDate());
        $newUser->setPhoneNumber($dto->getPhoneNumber());

        $roles = $newUser->getRoles();
        $roles[] = 'ROLE_USER';
        $newUser->setRoles($roles);


        return $newUser;
    }

    public function converterToDto($entity) {

        $newUserDto = new SignInDto();
        $newUserDto->setFirstName($entity->getFirstName());
        $newUserDto->setLastName($entity->getLastName());
        $newUserDto->setEmail($entity->getEmail());
        $newUserDto->setPassword($entity->getPassword());
        $newUserDto->setAddress($entity->getAddress());
        $newUserDto->setCredit($entity->getCredit());
        $newUserDto->setBirthDate($entity->getBirthDate()); 
        $newUserDto->setPhoneNumber($entity->getPhoneNumber());
        $newUserDto->setRoles($entity->getRoles());
    
        return $newUserDto;
    }
    


}