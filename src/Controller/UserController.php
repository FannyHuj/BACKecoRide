<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

class UserController extends AbstractController
{
    #[Route('/api/user', methods:['POST'])]
    public function new (#[MapRequestPayload] User $user,UserRepository $userRepository):JsonResponse{
        $userRepository->save($user);
        return $this->json(['status' => 'success']);
    }

    #[Route('/api/userMail')]
    public function getMail (#[MapRequestPayload]  User $user):JsonResponse{
        $user = $this->getUser();
        return $this->json($user);
    }
}
