<?php

namespace App\Infrastructure\Security\Provider;

use App\Infrastructure\Doctrine\Entity\User;
use App\Infrastructure\Doctrine\Repository\UserRepository;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class UserProvider implements UserProviderInterface
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function loadUserByIdentifier(string $identifier): UserInterface
    {
        return $this->getUserByUsername($identifier);
    }

    public function refreshUser(UserInterface $user)
    {
        return $this->getUserByUsername($user->getUserIdentifier());
    }

    private function getUserByUsername(string $identifier): ?UserInterface
    {
        $user = $this->userRepository->findOneBy(['email' => $identifier]);

        return $user;
    }

    public function supportsClass(string $class)
    {
        return $class === User::class;
    }
}
