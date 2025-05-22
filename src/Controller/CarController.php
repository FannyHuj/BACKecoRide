<?php

namespace App\Controller;

use App\dtoConverter\CarDtoConverter;
use App\dto\CarDto;
use App\Repository\CarRepository;
use App\Repository\UserRepository;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class CarController extends AbstractController
{
    #[Route('/api/addNewCar', methods:['POST'])]
    
    public function AddNewCar (#[MapRequestPayload]  CarDto $carDto, CarRepository $carRepository,UserRepository $userRepository,):JsonResponse{

                            $convert=new CarDtoConverter();
                            $car=$convert->converterToEntity($carDto);
                            $user=$userRepository->findUserById($carDto->getDriver()->getId());
                            $car->setUser($user);
                            $carRepository->save($car);

            
            return $this->json(['status' => 'success']);

    }
}
