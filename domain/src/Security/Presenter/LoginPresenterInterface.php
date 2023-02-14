<?php

namespace MHamidi\Falcon\Domain\Security\Presenter;

use MHamidi\Falcon\Domain\Security\Response\LoginResponse;

interface LoginPresenterInterface
{
    /**
     * @param LoginResponse $response
     */
    public function present(LoginResponse $response): void;
}
