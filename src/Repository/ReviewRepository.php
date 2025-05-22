<?php

namespace App\Repository;

use App\Entity\Review;
use App\Entity\Trip;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Review>
 */
class ReviewRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Review::class);
    }

    public function findByTrip(Trip $trip): array
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.trip = :trip')
            ->setParameter('trip', $trip)
            ->getQuery()
            ->getResult();
    }

    public function save(Review $review){
        $this->getEntityManager()->persist($review);
        $this->getEntityManager()->flush();
    }

    public function findAllReview(){
        return $this->findAll();
    }

    public function findById($id){
        return $this->find($id);
    }

    public function findByUser($user){
         return $this->createQueryBuilder('r')
        ->join('r.trip', 't')
        ->join('t.users', 'ut') 
        ->andWhere('ut.user = :user')
        ->andWhere('ut.driver = true')
        ->andWhere('r.publish = true')
        ->setParameter('user', $user)
        ->getQuery()
        ->getResult();
    }


    //    /**
    //     * @return Review[] Returns an array of Review objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('r.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Review
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
