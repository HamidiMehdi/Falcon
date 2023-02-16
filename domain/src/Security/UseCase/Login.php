<?php

namespace MHamidi\Falcon\Domain\Security\UseCase;

use MHamidi\Falcon\Domain\Security\Gateway\UserGateway;
use MHamidi\Falcon\Domain\Security\Presenter\LoginPresenterInterface;
use MHamidi\Falcon\Domain\Security\Request\LoginRequest;
use MHamidi\Falcon\Domain\Security\Response\LoginResponse;

class Login
{
    private UserGateway $userGateway;

    public function __construct(UserGateway $userGateway)
    {
        $this->userGateway = $userGateway;
    }

    public function execute(LoginRequest $request, LoginPresenterInterface $presenter): void
    {
        $request->validate();
        $user = $this->userGateway->getUserByEmail($request->getEmail());
        if ($user) {
            $passwordValid = password_verify($request->getPassword(), $user->getPassword());
        }
        
        $presenter->present(new LoginResponse($user, $passwordValid ?? false));
    }
}
