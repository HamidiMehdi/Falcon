<?php

namespace MHamidi\Falcon\Domain\Security\Response;

class RegistrationResponse
{
    private string $email;

    public function __construct(string $email)
    {
        $this->email = $email;
    }
    
    public function getEmail(): string
    {
        return $this->email;
    }
}
