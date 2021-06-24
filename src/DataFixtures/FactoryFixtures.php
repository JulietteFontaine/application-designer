<?php

namespace App\DataFixtures;

use App\Entity\Factory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class FactoryFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager)
    {

        $tab_entreprise = ["BBois", "MetaLo", "pPlastique"];

        // Creation des entreprises
        foreach ($tab_entreprise as $e) {
            $entreprise = new Factory();
            $entreprise->setName($e);
            $manager->persist($entreprise);
        };

        $manager->flush();
}

public function getDependencies()
{
    return [
        UserFixtures::class
    ];
}

}
