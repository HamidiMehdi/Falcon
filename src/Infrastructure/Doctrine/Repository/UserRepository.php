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

    public function getUserByEmail(string $email): ?User
    {
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

    public function register(User $user): void
    {
        $userDoctrine = new UserDoctrine();
        $userDoctrine = $this->hydrateUserDoctrine($userDoctrine, $user);

        $this->_em->persist($userDoctrine);
        $this->_em->flush();
    }

    public function update(User $user): void
    {
        $doctrineUser = $this->find($user->getId());
        if (!$doctrineUser) {
            return;
        }
        $doctrineUser = $this->hydrateUserDoctrine($doctrineUser, $user);

        $this->_em->persist($doctrineUser);
        $this->_em->flush();
    }

    private function hydrateUserDoctrine(UserDoctrine $userDoctrine, User $user): UserDoctrine
    {
        $userDoctrine->setFirstname($user->getFirstname());
        $userDoctrine->setLastname($user->getLastname());
        $userDoctrine->setEmail($user->getEmail());
        $userDoctrine->setPassword($user->getPassword());
        $userDoctrine->setRoles($user->getRoles());
        $userDoctrine->setUserFrom($user->getUserFrom());
        $userDoctrine->setPasswordResetToken($user->getPasswordResetToken());
        $userDoctrine->setPasswordResetRequestedAt($user->getPasswordResetRequestedAt());

        return $userDoctrine;
    }
}