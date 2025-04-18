<?php

namespace App\Repository;

use App\Entity\Trip;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\TripsStatusEnum;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

/**
 * @extends ServiceEntityRepository<Trip>
 */
class TripRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Trip::class);
    }

    public function save(Trip $trip){
        $this->getEntityManager()->persist($trip);
        $this->getEntityManager()->flush();
    }

    public function remove(Trip $trip){
        $this->getEntityManager()->remove($trip);
        $this->getEntityManager()->flush();
    }

    public function findAllTrips(){
        return $this->findAll();
    }
    public function findTripById($id){

        return $this->find($id);
    }

    public function search(Trip $trip){

        $qb = $this->createQueryBuilder('trip')
            -> where('trip.placeNumber >= :placeNumber')
            -> andWhere('trip.departLocation = :departLocation')
            -> andWhere('trip.arrivalLocation = :arrivalLocation')
            -> andWhere('trip.departDate = :departDate')
            ->setParameter ('departLocation', $trip->getDepartLocation())
            ->setParameter('placeNumber', $trip->getPlaceNumber())
            ->setParameter('arrivalLocation', $trip->getArrivalLocation())
            ->setParameter ('departDate', $trip->getDepartDate());

        $query = $qb->getQuery();
        return $query->execute();
    }

    public function cancel ($id, MailerInterface $mailer){
        $trip=$this->findTripById($id);
        $trip->setStatus(TripsStatusEnum::Canceled);
        $this->getEntityManager()->flush();

        $email = (new Email())
       ->from('didierdeschamps@example.com')
       ->to('hujman.fanny@gmail.com')
       ->subject('Coupe du monde')
       ->text('vous êtes invité à la prochaine coupe du monde');
   $mailer->send($email);
    }

    public function removePassenger($tripId, $userId){
        $trip=$this->findTripById($tripId);
        $userTripAssociated = $trip->getUsers()->filter(function ($userTrip) use ($userId) {
            return $userTrip->getUser()->getId()== $userId;
        });
        $trip->getUsers()->remove($userTripAssociated);
        $this->getEntityManager()->flush();
    }
}

    //    /**
    //     * @return Trip[] Returns an array of Trip objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('t.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Trip
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

