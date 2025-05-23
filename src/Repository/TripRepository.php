<?php

namespace App\Repository;

use App\dto\SearchDto;
use App\dto\FiltersSearchDto;
use App\Entity\EnergyEnum;
use App\Entity\Trip;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\TripsStatusEnum;


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

    public function countTrips(){
        return $this->createQueryBuilder('trip')
            ->select('COUNT(trip.id)')
            ->andWhere('trip.status = :status')
            ->setParameter('status', TripsStatusEnum::Done)
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function search(SearchDto $searchDto){

        $qb = $this->createQueryBuilder('trip')
            -> where('trip.placeNumber >= :placeNumber')
            -> andWhere('trip.departLocation = :departLocation')
            -> andWhere('trip.arrivalLocation = :arrivalLocation')
            -> andWhere('trip.departDate >= :departDate')
            -> andWhere('trip.status=:status')
            ->setParameter ('departLocation', $searchDto->getDepartLocation())
            ->setParameter('placeNumber', $searchDto->getPlaceNumber())
            ->setParameter('arrivalLocation', $searchDto->getArrivalLocation())
            ->setParameter ('departDate', $searchDto->getDepartDate())
            ->setParameter ('status', TripsStatusEnum::Coming);

        if($searchDto->getIsEcologic()){
            $qb->join('trip.car', 'car')
                ->andWhere('car.energy = :electricCar OR car.energy = :hybridCar')
                ->setParameter('electricCar', EnergyEnum::ELECTRIC)
                ->setParameter('hybridCar', EnergyEnum::HYBRID);
           
        }
        if($searchDto->getCreditPrice()>0){
            $qb->andWhere('trip.creditPrice <= :creditPrice')
                ->setParameter('creditPrice', $searchDto->getCreditPrice());
        }
        if($searchDto->getNotation()>0){
            $qb->join('trip.driver', 'driver')
                ->andWhere('driver.notation >= :notation')
                ->setParameter('notation', $searchDto->getNotation());
            
        }

        $query = $qb->getQuery();
        return $query->execute();
    }

    public function searchFilters(FiltersSearchDto $filtersSearchDto){

        $qbf = $this->createQueryBuilder('trip')
            -> where('trip.duration <= :duration')
            -> andWhere('trip.maxPrice <= :maxPrice')
            -> andWhere('trip.rating <= :rating')
            -> andWhere('trip.electricCar = :true')
            ->setParameter ('departLocation', $filtersSearchDto->getDuration())
            ->setParameter('placeNumber', $filtersSearchDto->getMaxPrice())
            ->setParameter('arrivalLocation', $filtersSearchDto->getRating())
            ->setParameter ('departDate', $filtersSearchDto->getElectricCar());

        $query = $qbf->getQuery();
        return $query->execute();
    }

    public function cancel ($id){
        $trip=$this->findTripById($id);
        $trip->setStatus(TripsStatusEnum::Canceled);
        $this->getEntityManager()->flush();

       
    }

    public function removePassenger($tripId, $userId){
        $trip=$this->findTripById($tripId);
        $userTripAssociated = $trip->getUsers()->filter(function ($userTrip) use ($userId) {
            return $userTrip->getUser()->getId()== $userId;
        });
        $trip->getUsers()->remove($userTripAssociated);
        $this->getEntityManager()->flush();
    }

    public function findAllTrip(){
        return $this->findAll();
    }

    public function totalCredit(){
        
    }

    public function tripsPerDay(){

    }

    public function creditsPerDay(){
        
    }

    public function findTripsByUser(User $user): array
    {
        return $this->createQueryBuilder('trip')
            ->innerJoin('trip.users', 'ut')
            ->andWhere('ut.user = :user')
            ->setParameter('user', $user)
            ->getQuery()
            ->getResult();
    }

    public function terminateTrip(int $tripId){
        $trip= $this->findTripById($tripId);
        $trip->setStatus(TripsStatusEnum::Done);
        $this->getEntityManager()->flush();
    }

    public function startTrip(int $tripId){
        $trip= $this->findTripById($tripId);
        $trip->setStatus(TripsStatusEnum::InProgress);
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

