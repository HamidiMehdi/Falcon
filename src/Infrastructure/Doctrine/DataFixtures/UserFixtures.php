<?php

namespace App\Infrastructure\Doctrine\DataFixtures;

use App\Infrastructure\Doctrine\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        /** User $user */
        $user = new User();
        $user->setFirstname('Mehdi');
        $user->setLastname('HAMIDI');
        $user->setEmail('mehdi@test.com');
        $user->setPassword($this->passwordHasher->hashPassword($user, 'azerty'));
        $user->setRoles(['ROLE_USER']);
        $user->setUserFrom('APP');

        $manager->persist($user);
        $manager->flush();
    }
}
