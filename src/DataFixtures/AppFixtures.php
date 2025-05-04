<?php

namespace App\DataFixtures;

use App\Entity\EnergyEnum;
use App\Entity\TripsStatusEnum;
use App\Entity\User;
use App\Entity\Trip;
use App\Entity\Car;
use App\Entity\Brand;
use App\Entity\UserTrip;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $userPasswordHasher;

    public function __construct(UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->userPasswordHasher = $userPasswordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        // Création d'un user "normal"
        $user = new User();
        $user->setEmail("user@ecoride.com");
        $user->setRoles(["ROLE_USER"]);
        $user->setFirstName("Sébastien");
        $user->setLastName("Philippot");
        $user->setPassword($this->userPasswordHasher->hashPassword($user, "password"));
        $user->setCredit(20);
        $user->setActive(true);
        $manager->persist($user);

        $alice = new User();
        $alice->setEmail("alice@ecoride.com");
        $alice->setRoles(["ROLE_USER"]);
        $alice->setPassword($this->userPasswordHasher->hashPassword($user, "password"));
        $alice->setCredit(20);
        $alice->setActive(true);
        $alice->setFirstName("Tom");
        $alice->setLastName("Rider");
        $manager->persist($alice);

        $bob = new User();
        $bob->setEmail("bob@ecoride.com");
        $bob->setRoles(["ROLE_USER"]);
        $bob->setPassword($this->userPasswordHasher->hashPassword($user, "password"));
        $bob->setCredit(20);
        $bob->setActive(true);
        $bob->setFirstName("Judith");
        $bob->setLastName("Grimes");
        $manager->persist($bob);

        // Création d'un user admin
        $userAdmin = new User();
        $userAdmin->setEmail("admin@ecoride.com");
        $userAdmin->setRoles(["ROLE_ADMIN"]);
        $userAdmin->setPassword($this->userPasswordHasher->hashPassword($userAdmin, "password"));
        $userAdmin->setCredit(20);
        $userAdmin->setActive(true);
        $userAdmin->setFirstName("Carl");
        $userAdmin->setLastName("Meyer");
        $manager->persist($userAdmin);

        // Création d'un user employe
        $userEmployee = new User();
        $userEmployee->setEmail("employe1@ecoride.com");
        $userEmployee->setRoles(["ROLE_EMPLOYE"]);
        $userEmployee->setPassword($this->userPasswordHasher->hashPassword($userEmployee, "password"));
        $userEmployee->setCredit(20);
        $userEmployee->setActive(true);
        $userEmployee->setFirstName("Stefan");
        $userEmployee->setLastName("Job");
        $manager->persist($userEmployee);

        // Création d'un user employe
        $userEmployee = new User();
        $userEmployee->setEmail("employe2@ecoride.com");
        $userEmployee->setRoles(["ROLE_EMPLOYE"]);
        $userEmployee->setPassword($this->userPasswordHasher->hashPassword($userEmployee, "password"));
        $userEmployee->setCredit(20);
        $userEmployee->setActive(true);
        $userEmployee->setFirstName("Enzo");
        $userEmployee->setLastName("Forbes");
        $manager->persist($userEmployee);


        // Création d'une marque
        $peugeot = new Brand();
        $peugeot->setLibelle('Peugeot');
        $manager->persist($peugeot);

        $citroen = new Brand();
        $citroen->setLibelle('Citroen');
        $manager->persist($citroen);

        $bmw = new Brand();
        $bmw->setLibelle('BMW');
        $manager->persist($bmw);

        // Création de voitures
        $cars = [];
        
        $car = new Car();
        $car->setUser($user);
        $car->setBrand($peugeot);
        $car->setModel('206');
        $car->setRegistration('AA-123-AA');
        $car->setEnergy(EnergyEnum::GASOLINE);
        $car->setColor('Noir');
        $car->setFirstRegistrationDate('2020-01-01');
        $manager->persist($car);

        $cars[]=$car;

        $C6 = new Car();
        $C6->setUser($bob);
        $C6->setBrand($citroen);
        $C6->setModel('C6');
        $C6->setRegistration('AA-456-AA');
        $C6 ->setEnergy(EnergyEnum::GASOLINE);
        $C6 ->setColor('Noir');
        $C6 ->setFirstRegistrationDate('2020-01-01');
        $manager->persist($C6);
        $cars[]=$C6;

        $IX1 = new Car();
        $IX1->setUser($alice);
        $IX1 ->setBrand($bmw);
        $IX1->setModel('C6');
        $IX1->setRegistration('AA-456-AA');
        $IX1->setEnergy(EnergyEnum::GASOLINE);
        $IX1 ->setColor('Noir');
        $IX1 ->setFirstRegistrationDate('2020-01-01');
        $manager->persist($IX1);
        $cars[]=$IX1;

        // Création de 10 trips précis
        $trips = [];

        for ($i = 1; $i < 10; $i++) {
            $trip = new Trip();
            $trip->setCar($cars[$i % count($cars)]); // Tourne entre les voitures
            $trip  ->setDepartDate(new \DateTime("2025-05-0{$i} 08:00:00"));
            $trip ->setDepartLocation("VilleDépart{$i}");
            $trip ->setArrivalDate(new \DateTime("2025-05-0{$i}"));
            $trip  ->setArrivalLocation("VilleArrivée{$i}");
            $trip ->setStatus(TripsStatusEnum::Coming);
            $trip ->setPlaceNumber(4);
            $trip ->setCreditPrice(10 * $i); // Ex: Trip 1 = 10 crédits, Trip 2 = 20 crédits, etc.
            $manager->persist($trip);
            $trips[] = $trip;
        }

        // Création de UserTrip (conducteurs + passagers)
        foreach ($trips as $trip) {
            // Conducteur
            $driver = $trip->getCar()->getUser();
            $userTripDriver = new UserTrip();
            $userTripDriver->setUser($driver)
                ->setTrip($trip)
                ->setDriver(true)
                ->setBookingDate($trip->getDepartDate());
            $manager->persist($userTripDriver);       
        }
        $manager->flush();
    }
}
