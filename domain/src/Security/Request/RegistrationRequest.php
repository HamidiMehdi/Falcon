<?php

namespace MHamidi\Falcon\Domain\Security\Request;

use MHamidi\Falcon\Domain\Security\Assert\Assertion;
use MHamidi\Falcon\Domain\Security\Gateway\UserGateway;

class RegistrationRequest
{
    private string $firstname;

    private string $lastname;

    private string $email;

    private string $password;

    private string $userFrom;

    public static function create(string $firstname, string $lastname, string $email, string $password, string $userFrom): self
    {
        return new self($firstname, $lastname, $email, $password, $userFrom);
    }

    public function __construct(string $firstname, string $lastname, string $email, string $password, string $userFrom)
    {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->password = $password;
        $this->userFrom = $userFrom;
    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function getLastname(): string
    {
        return $this->lastname;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getUserFrom(): string
    {
        return $this->userFrom;
    }

    public function validate(UserGateway $userGateway): void
    {
        Assertion::notBlank($this->firstname);
        Assertion::notBlank($this->lastname);
        Assertion::notBlank($this->email);
        Assertion::email($this->email);
        Assertion::nonUniqueEmail($this->email, $userGateway);
        Assertion::notBlank($this->password);
        Assertion::minLength($this->password, 8);
        Assertion::notBlank($this->userFrom);
    }
}
