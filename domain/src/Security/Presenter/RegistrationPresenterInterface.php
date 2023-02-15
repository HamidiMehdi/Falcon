<?php

namespace MHamidi\Falcon\Domain\Security\Presenter;

use MHamidi\Falcon\Domain\Security\Response\RegistrationResponse;

interface RegistrationPresenterInterface
{
    public function present(RegistrationResponse $response): void;
}
