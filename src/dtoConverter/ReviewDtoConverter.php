<?php
namespace App\dtoConverter;

use App\Entity\Review;
use Symfony\Bundle\MakerBundle\Security\UserClassConfiguration;

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

}