<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordHasherInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        for ($u = 0; $u < 3; $u++) {
            $user = new User;

            $user->setEmail("user$u@mail.com");
            $user->setRoles(['ROLE_ADMIN']);
            $password = $this->passwordEncoder->hashPassword($user, "password");
            $user->setPassword($password);

            $manager->persist($user);
        }

        $manager->flush();
    }
}
