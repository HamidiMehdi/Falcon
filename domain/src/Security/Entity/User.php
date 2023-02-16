<?php

namespace MHamidi\Falcon\Domain\Security\Entity;

use DateTimeInterface;
use MHamidi\Falcon\Domain\Security\Enum\UserFromEnum;
use MHamidi\Falcon\Domain\Security\Request\RegistrationRequest;

class User
{
    private ?int $id;

    private string $firstname;

    private string $lastname;

    private string $email;

    private string $password;

    private array $roles = [];

    private string $userFrom;

    private ?string $passwordResetToken = null;

    private ?DateTimeInterface $passwordResetRequestedAt = null;

    public function __construct(
        ?int $id,
        string $firstname,
        string $lastname,
        string $email,
        string $password,
        array $roles,
        string $userFrom,
        ?string $passwordResetToken = null,
        ?DateTimeInterface $passwordResetRequestedAt = null
    )
    {
        $this->id = $id;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->password = $password;
        $this->roles = $roles;
        $this->userFrom = $userFrom;
        $this->passwordResetToken = $passwordResetToken;
        $this->passwordResetRequestedAt = $passwordResetRequestedAt;
    }

    public static function fromRegistration(RegistrationRequest $request): self
    {
        return new self(
            null,
            $request->getFirstname(),
            $request->getLastname(),
            $request->getEmail(),
            password_hash($request->getPassword(), PASSWORD_ARGON2I),
            ['ROLE_USER'],
            $request->getUserFrom()
        );
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): void
    {
        $this->firstname = $firstname;
    }

    public function getLastname(): string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): void
    {
        $this->lastname = $lastname;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function setRoles(array $roles): void
    {
        $this->roles = $roles;
    }

    public function getUserFrom(): string
    {
        return $this->userFrom;
    }

    public function setUserFrom(string $userFrom): void
    {
        $this->userFrom = $userFrom;
    }

    public function getPasswordResetToken(): ?string
    {
        return $this->passwordResetToken;
    }

    public function setPasswordResetToken(?string $passwordResetToken): void
    {
        $this->passwordResetToken = $passwordResetToken;
    }

    public function getPasswordResetRequestedAt(): ?DateTimeInterface
    {
        return $this->passwordResetRequestedAt;
    }

    public function setPasswordResetRequestedAt(?DateTimeInterface $passwordResetRequestedAt): void
    {
        $this->passwordResetRequestedAt = $passwordResetRequestedAt;
    }
}
