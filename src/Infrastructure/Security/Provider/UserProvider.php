<?php

namespace App\Infrastructure\Security\Provider;

use App\Infrastructure\Doctrine\Entity\User;
use MHamidi\Filer\Domain\Security\Gateway\UserGateway;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class UserProvider implements UserProviderInterface
{
    /** @var UserGateway $userGateway */
    private UserGateway $userGateway;

    public function __construct(UserGateway $userGateway)
    {
        $this->userGateway = $userGateway;
    }

    public function refreshUser(UserInterface $user)
    {
        // TODO: Implement refreshUser() method.
    }

    public function supportsClass(string $class)
    {
        // TODO: Implement supportsClass() method.
    }

    public function loadUserByIdentifier(string $identifier): UserInterface
    {
        // TODO: Implement loadUserByIdentifier() method.
    }

    private function getUserByUsername(string $username): User
    {
        $user = $this->userGateway->getUserByEmail($username);
        if (!$user) {
            throw new UsernameNotFoundException();
        }

        return new User($participant);
    }
}