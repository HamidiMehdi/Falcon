<?php

namespace MHamidi\Falcon\Domain\Security\Request;

use MHamidi\Falcon\Domain\Security\Assert\Assertion;

class ForgotPasswordRequest
{
    private string $email;

    public static function create(string $email): self
    {
        return new self($email);
    }

    public function __construct(string $email)
    {
        $this->email = $email;
    }

    public function getEmail(): string
    {
        return $this->email;
    }


    public function validate(): void
    {
        Assertion::notBlank($this->email);
        Assertion::email($this->email);
    }
}
