<?php

namespace MHamidi\Filer\Domain\Security\UseCase;

use MHamidi\Filer\Domain\Security\Gateway\UserGateway;
use MHamidi\Filer\Domain\Security\Presenter\LoginPresenterInterface;
use MHamidi\Filer\Domain\Security\Request\LoginRequest;
use MHamidi\Filer\Domain\Security\Response\LoginResponse;

class Login
{
    /** UserGateway $userGateway */
    private UserGateway $userGateway;

    public function __construct(UserGateway $userGateway)
    {
        $this->userGateway = $userGateway;
    }

    public function execute(LoginRequest $request, LoginPresenterInterface $presenter)
    {
        $request->validate();
        $user = $this->userGateway->getUserByEmail($request->getEmail());

        if ($user) {
            $passwordValid = password_verify($request->getPassword(), $user->getPassword());
        }

        $presenter->present(new LoginResponse($user, $passwordValid ?? false));
    }
}
