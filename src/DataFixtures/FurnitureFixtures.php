<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Material;
use App\Entity\Furniture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class FurnitureFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager)
    {

        $tab_meuble = [
            "Petit meuble",
            "Joli meuble",
            "Meuble tordu",
            "Meuble de meuble",
            "Meuble effet cassé",
            "Meuble stable",
        ];

        $tab_type = ["Armoire", "Etagère"];

        // Recupération du repo Matières
        $repoMaterial = $manager
            ->getRepository(Material::class)
            ->findAll();

        // Recupération du repo Matières
        $repoUser = $manager
            ->getRepository(User::class)
            ->findAll();

        //boucle sur les les user du repo
        foreach ($repoUser as $u) {

            // init de 5 à 10 meubles pour chaque user
            for ($f = 0; $f < mt_rand(5, 10); $f++) {
                $furniture = new Furniture();
                $furniture->setName($tab_meuble[rand(0, count($tab_meuble) - 1)]);

                // 3 materiel par meubles
                $i = 0;
                while ($i < 3) {
                    $furniture->addMaterial($repoMaterial[rand(0, count($repoMaterial) - 1)]);
                    $i++;
                }

                $furniture->setType($tab_type[rand(0, 2 - 1)]);
                $furniture->setUser($u);

                $manager->persist($furniture);
            }
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            MaterialFixtures::class
        ];
    }
}
