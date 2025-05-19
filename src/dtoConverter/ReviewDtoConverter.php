<?php
namespace App\dtoConverter;

use App\dto\ReviewDto;
use App\Entity\Review;


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
    

        return $reviewDto;
    }

}