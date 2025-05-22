<?php

namespace App\Controller;

use App\dto\DriverPreferencesDto;
use App\dtoConverter\DriverPreferencesDtoConverter;
use App\Repository\DriverPreferencesRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;


class DriverPreferencesController extends AbstractController
{

   

    #[Route('/api/preferences/driver/{userId}', methods: ['POST'])]
    public function driverPreferences(#[MapRequestPayload] DriverPreferencesDto $dto, UserRepository $userRepository,DriverPreferencesRepository $driverPreferencesRepository,$userId): JsonResponse
    {
        $driverPreferencesDtoConverter = new DriverPreferencesDtoConverter();
        $preferences = $driverPreferencesDtoConverter->converterToEntity($dto);

        $user = $userRepository->findUserById($userId);
        $user->setDriverPreferences($preferences);
        $driverPreferencesRepository->save($preferences);

        return new JsonResponse($driverPreferencesDtoConverter->converterToDto($preferences), 201);
    }

}