<?php

namespace App\UserInterface\Presenter\Security;

use MHamidi\Falcon\Domain\Security\Presenter\RegistrationPresenterInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use MHamidi\Falcon\Domain\Security\Response\RegistrationResponse;
use Symfony\Component\Security\Core\User\UserInterface;

class RegistrationPresenter implements RegistrationPresenterInterface
{
    private UserInterface $user;

    private UserProviderInterface $userProvider;

    public function __construct(UserProviderInterface $userProvider)
    {
        $this->userProvider = $userProvider;
    }

    public function present(RegistrationResponse $response): void
    {
        $this->user = $this->userProvider->loadUserByIdentifier($response->getEmail());
    }

    public function getUser(): UserInterface
    {
        return $this->user;
    }
}
