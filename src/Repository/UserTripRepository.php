<?php

namespace App\Repository;

use App\Entity\Review;
use App\Entity\UserTrip;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Review>
 */
class UserTripRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Review::class);
    }


    public function add(UserTrip $ut): void
    {

        $this->getEntityManager()->persist($ut);
        $this->getEntityManager()->flush();
    }

    public function findByUser(User $user): void
    {

        $this->findBy(['user' => $user]);
        $this->getEntityManager()->flush();
    }
    


}