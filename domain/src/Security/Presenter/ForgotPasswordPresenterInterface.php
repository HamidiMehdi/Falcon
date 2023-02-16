<?php

namespace MHamidi\Falcon\Domain\Security\Presenter;

use MHamidi\Falcon\Domain\Security\Response\ForgotPasswordResponse;

interface ForgotPasswordPresenterInterface
{
    public function present(ForgotPasswordResponse $response): void;
}
