<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class UserFixtures extends Fixture 
{

    public function load(ObjectManager $manager)
    {


        for ($u = 0; $u < 3; $u++) {
            $user = new User;

            $user->setEmail("user$u@mail.com");
            $user->setPassword("password");

            $manager->persist($user);
        }

        $manager->flush();
}
}