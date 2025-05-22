<?php
namespace App\dtoConverter;

use App\dto\ReviewDto;
use App\Entity\Review;
use App\dto\UserDtoMin;
use App\dto\TripFullDto;


class ReviewDtoConverter {

    public function converterToEntity($dto,$user, $trip) {
        
        $review = new Review();
        $review->setComment($dto->getComment());
        $review->setNotation($dto->getNotation());
        $review->setPublish($dto->getPublish());

        $review->setOwner($user);
        $review->setTrip($trip);

        return $review;
    }

    public function convertToDto(Review $review)
    {

        $reviewDto = new ReviewDto();
        $reviewDto->setId($review->getId());
        $reviewDto->setComment($review->getComment());
        $reviewDto->setNotation($review->getNotation());
        $reviewDto->setPublish($review->getPublish());

        $userDtoMin = new UserDtoMin();
        $userDtoMin->setId($review->getOwner()->getId());
        $userDtoMin->setFirstName($review->getOwner()->getFirstName());
        $userDtoMin->setLastName($review->getOwner()->getLastName());
        $userDtoMin->setEmail($review->getOwner()->getEmail());
        $reviewDto->setOwnerId($userDtoMin);

        $reviewDto->setTripID($review->getTrip()->getId());
    

        return $reviewDto;
    }

}