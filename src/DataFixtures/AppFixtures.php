<?php

namespace App\DataFixtures;

use App\Entity\Factory;
use App\Entity\Furniture;
use App\Entity\Material;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {

        $tab_entreprise = ["BBois", "MetaLo", "pPlastique"];

        $tab_bois = ["Frêne", "Chêne", "Noyer"];
        $tab_fer = ["Acier", "Inox", "Aluminum"];

        // Creation des entreprises
        foreach ($tab_entreprise as $e) {
            $entreprise = new Factory();
            $entreprise->setName($e);
            $manager->persist($entreprise);
        };

        $manager->flush();

        // Recupération du repo Entreprise
        $repoEntreprise = $manager
            ->getRepository(Factory::class)
            ->findAll();

        // Creation des diff. matières et association aux entreprises existantes
        foreach ($repoEntreprise as $e) {

            if ($e->getName() == "pPlastique") {

                $plastique = new Material();
                $plastique->setName("Plastique");
                $plastique->setType("Plastique");
                $plastique->setFactory($e);
                $manager->persist($plastique);
            } elseif ($e->getName() == "BBois") {
                foreach ($tab_bois as $b) {

                    $matiere_bois = new Material();
                    $matiere_bois->setName($b);
                    $matiere_bois->setType("Bois");
                    $matiere_bois->setFactory($e);

                    $manager->persist($matiere_bois);
                }
            } else {
                foreach ($tab_fer as $f) {

                    $matiere_fer = new Material();
                    $matiere_fer->setName($f);
                    $matiere_fer->setType("Fer");
                    $matiere_fer->setFactory($e);

                    $manager->persist($matiere_fer);
                }
            }
        }

        $manager->flush();

        $tab_meuble = [
            "Petit meuble",
            "Joli meuble",
            "Meuble tordu",
            "Meuble de meuble",
            "Meuble effet cassé",
            "Meuble stable",
        ];

        // Recupération du repo Matières
        $repoMaterial = $manager
            ->getRepository(Material::class)
            ->findAll();

        // Creation des meubles et association des meubles aux diff. matière
        $count = 0;
        while ($count < 6) {
            $furniture = new Furniture();
            
            $furniture->setName($tab_meuble[rand(0, count($tab_meuble) - 1)]);
            $furniture->addMaterial($repoMaterial[rand(0, count($repoMaterial) - 1)]);
            $furniture->setType('armoire');

            $manager->persist($furniture);
            $count++;
        }

        $count = 0;
        while($count < 6) {
        $furniture = new Furniture();
        $furniture->setName($tab_meuble[rand(0, count($tab_meuble) - 1)]);
        $furniture->addMaterial($repoMaterial[rand(0, 3 - 1)]);
        $furniture->setType('etagère');
        $manager->persist($furniture);
        $count++;
        }

        $manager->flush();
    }
}