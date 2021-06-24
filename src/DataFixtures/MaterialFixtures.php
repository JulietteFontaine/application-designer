<?php

namespace App\DataFixtures;

use App\Entity\Factory;
use App\Entity\Material;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class MaterialFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager)
    {

        $tab_bois = ["Frêne", "Chêne", "Noyer"];
        $tab_fer = ["Acier", "Inox", "Aluminum"];

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
    }

    public function getDependencies()
    {
        return [
            FactoryFixtures::class,
        ];
    }
}