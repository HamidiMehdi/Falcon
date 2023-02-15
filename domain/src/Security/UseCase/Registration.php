<?php

namespace MHamidi\Falcon\Domain\Security\UseCase;

use MHamidi\Falcon\Domain\Security\Entity\User;
use MHamidi\Falcon\Domain\Security\Gateway\UserGateway;
use MHamidi\Falcon\Domain\Security\Presenter\RegistrationPresenterInterface;
use MHamidi\Falcon\Domain\Security\Request\RegistrationRequest;
use MHamidi\Falcon\Domain\Security\Response\RegistrationResponse;

class Registration
{
    /** UserGateway $userGateway */
    private UserGateway $userGateway;

    public function __construct(UserGateway $userGateway)
    {
        $this->userGateway = $userGateway;
    }

    public function execute(RegistrationRequest $request, RegistrationPresenterInterface $presenter)
    {
        $request->validate($this->userGateway);
        $user = User::fromRegistration($request);
        $this->userGateway->register($user);
        $presenter->present(new RegistrationResponse($user->getEmail()));
    }
}
