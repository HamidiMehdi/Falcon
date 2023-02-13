<?php

namespace MHamidi\Filer\Domain\Security\Presenter;

use MHamidi\Filer\Domain\Security\Response\LoginResponse;

interface LoginPresenterInterface
{
    /**
     * @param LoginResponse $response
     */
    public function present(LoginResponse $response): void;
}
