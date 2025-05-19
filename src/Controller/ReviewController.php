<?php

namespace App\Controller;

use App\dto\ReviewDto;
use App\Repository\ReviewRepository;
use App\Repository\UserRepository;
use App\Repository\TripRepository;
use App\dtoConverter\ReviewDtoConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;

class ReviewController extends AbstractController
{
    #[Route('/api/addReview', methods:['POST'])]
    public function new (#[MapRequestPayload]  ReviewDto $reviewDto, 
                         ReviewRepository $reviewRepository, UserRepository $userRepository, TripRepository $tripRepository):JsonResponse{
                            $convert=new ReviewDtoConverter();
                            $user= $userRepository->findUserById($reviewDto->getOwnerId());

                            $trip=$tripRepository -> findTripById($reviewDto->getTripID());

                            $review=$convert->converterToEntity($reviewDto,  $user, $trip);
                            

                            $reviewRepository->save($review);

            
            return $this->json(['status' => 'success']);

}

#[Route('/api/admin/all/reviews', methods: ['GET'])]
public function getAllReviews(ReviewRepository $reviewRepository, ReviewDtoConverter $converter): JsonResponse
{
    $reviews = $reviewRepository->findAll();
    $reviewDtos = [];

    foreach ($reviews as $review) {
        $reviewDtos[] = $converter->convertToDto($review);
    }

    return $this->json($reviewDtos);
}
}
