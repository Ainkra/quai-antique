<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Customer;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user = new Customer();

        $user->setEmail("john@doe.com");
        $user->setRoles([]);
        $user->setPassword("$2y$13$7o1Cg54JTv6STykbm4VGueRXaflBnt6XikRMktkKhrQZ.RYKGXMIq");
        $user->setGuestNumber(1);
        $user->setAllergies("Aucune");

        $manager->persist($user);
        $manager->flush();
    }
}
