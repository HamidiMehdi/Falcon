<?php

namespace MHamidi\Falcon\Domain\Security\Response;

use MHamidi\Falcon\Domain\Security\Entity\User;

class ForgotPasswordResponse
{
    private ?User $user;

    public function __construct(?User $user)
    {
        $this->user = $user;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }
}
