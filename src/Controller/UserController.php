<?php

namespace App\Controller;

use App\dto\SignInDto;
use App\dtoConverter\UserDtoConverter;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use App\dtoConverter\SignInDtoConverter;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserController extends AbstractController
{

    #[Route('/newUser', methods:['POST'])] 
    public function new( #[MapRequestPayload] SignInDto $signInDto,UserRepository $userRepository,UserPasswordHasherInterface $passwordHasher): JsonResponse {
    
        $converter = new SignInDtoConverter(); 
        $newUser = $converter->converterToEntity($signInDto);
        $hashedPassword = $passwordHasher->hashPassword($newUser, $newUser->getPassword());
        $newUser->setPassword($hashedPassword);

        $userRepository->save($newUser);

        return $this->json(['status' => 'success']);
    }
    

    #[Route('/api/user/{email}')]
    public function getMail ($email,UserRepository $userRepository):JsonResponse{
        $user = $userRepository->findUserByEmail($email);
        $convert=new UserDtoConverter();
        return $this->json($convert->converterToDto($user));
    }
    

    #[Route('/api/getAllUsers')]
    public function getAllUsers (UserRepository $userRepository): JsonResponse{

        $users= $userRepository->findAllUsers();

        $convert=new UserDtoConverter();
        $dtoList = [];

        foreach($users as $user){
            array_push($dtoList, $convert->converterToDto($user));
        }

        return $this->json($dtoList, 200, [], ['json_encode_options' => JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES]);
    }

    #[Route('/api/user/{id}')]
    public function show (UserRepository $repository,$id): JsonResponse{

        $user= $repository->findUserById($id);
        $convert=new UserDtoConverter();
       
        $userDto=$convert->converterToDto($user);
        return $this->json($userDto, 200, [], ['json_encode_options' => JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES]);
    }

    #[Route('/api/user/suspending/{id}', methods: ['PUT'])]
    public function suspendingMember($id, UserRepository $userRepository): JsonResponse {
    $user = $userRepository->findUserById($id);

    $convert=new UserDtoConverter();

    $userDto=$convert->converterToDto($user);
    $user->setActive(false);
    $userRepository->save($user);

    return $this->json($userDto, 200, [], ['json_encode_options' => JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES]);
    }

    #[Route('/api/user/reactivate/{id}', methods: ['PUT'])]
    public function reactivateMember($id, UserRepository $userRepository): JsonResponse {
    $user = $userRepository->findUserById($id);

    $convert=new UserDtoConverter();

    $userDto=$convert->converterToDto($user);
    $user->setActive(true);
    $userRepository->save($user);

    return $this->json($userDto, 200, [], ['json_encode_options' => JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES]);
}

}
