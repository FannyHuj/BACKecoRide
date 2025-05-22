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
        if($dto->getPicture() != null){
            $newUser->setPicture($dto->getPicture());
        }

        $userRole=$dto->getRoles();

        $roles = $newUser->getRoles();
        $roles[] =reset($userRole);
        $newUser->setRoles($roles);


        return $newUser;
    }

 
    


}