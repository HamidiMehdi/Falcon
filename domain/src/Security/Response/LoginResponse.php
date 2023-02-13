<?php

namespace MHamidi\Filer\Domain\Security\Response;

use MHamidi\Filer\Domain\Security\Entity\User;

class LoginResponse
{
    /**
     * @var null|User
     */
    private readonly ?User $user;

    /**
     * @var bool
     */
    private readonly bool $passwordValid;


    public function __construct(?User $user, bool $passwordValid)
    {
        $this->user = $user;
        $this->passwordValid = $passwordValid;
    }

    /**
     * @return User|null
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @return bool
     */
    public function isPasswordValid(): bool
    {
        return $this->passwordValid;
    }
}
