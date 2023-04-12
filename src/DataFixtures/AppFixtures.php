<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Starter;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $starter = new Starter();

        $starter->setTitle("Salade césar");
        $starter->setDescription("Laitue romaine, croûtons, parmesan râpé, sauce césar.");
        $starter->setPrice("5,00");

        $manager->persist($starter);
        $manager->flush();
    }
}
