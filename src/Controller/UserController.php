<?php

namespace App\Controller;

use App\Entity\UserOLD;
use App\Repository\UserRepositoryOLD;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

class UserController extends AbstractController
{
    #[Route('/api/user', methods:['POST'])]
    public function new (#[MapRequestPayload] UserOLD $user,
                         UserRepositoryOLD            $userRepository):JsonResponse{
        $userRepository->save($user);
        return $this->json(['status' => 'success']);


    }
}
