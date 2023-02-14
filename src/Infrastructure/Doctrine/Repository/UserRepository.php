<?php

namespace App\Infrastructure\Doctrine\Repository;

use App\Infrastructure\Doctrine\Entity\User as UserDoctrine;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use MHamidi\Falcon\Domain\Security\Gateway\UserGateway;
use MHamidi\Falcon\Domain\Security\Entity\User;

class UserRepository extends ServiceEntityRepository implements UserGateway
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserDoctrine::class);
    }

    /**
     * @param string $email
     * @return User|null
     */
    public function getUserByEmail(string $email): ?User
    {
        /** @var User $user */
        $user = $this->findOneBy(['email' => $email]);

        if (!$user) {
            return null;
        }

        return new User(
            $user->getId(),
            $user->getFirstname(),
            $user->getLastname(),
            $user->getEmail(),
            $user->getPassword(),
            $user->getRoles(),
            $user->getUserFrom()
        );
    }

    public function isEmailUnique(?string $email): bool
    {
        return $this->count(["email" => $email]) === 0;
    }
}