<?php

namespace MHamidi\Filer\Domain\Security\Entity;

class User
{
    /** @var int|null $id */
    private ?int $id;

    /** @var string $firstname */
    private string $firstname;

    /** @var string $lastname */
    private string $lastname;

    /** @var string $email */
    private string $email;

    /** @var string $password */
    private string $password;

    /** @var array $roles */
    private array $roles = [];

    /** @var string $userFrom */
    private string $userFrom;

    /**
     * @param int|null $id
     * @param string $firstname
     * @param string $lastname
     * @param string $email
     * @param string $password
     * @param array $roles
     * @param string $userFrom
     */
    public function __construct(
        ?int $id,
        string $firstname,
        string $lastname,
        string $email,
        string $password,
        array $roles,
        string $userFrom
    )
    {
        $this->id = $id;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->password = $password;
        $this->roles = $roles;
        $this->userFrom = $userFrom;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     */
    public function setFirstname(string $firstname): void
    {
        $this->firstname = $firstname;
    }

    /**
     * @return string
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     */
    public function setLastname(string $lastname): void
    {
        $this->lastname = $lastname;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return array
     */
    public function getRoles(): array
    {
        return $this->roles;
    }

    /**
     * @param array $roles
     */
    public function setRoles(array $roles): void
    {
        $this->roles = $roles;
    }

    /**
     * @return string
     */
    public function getUserFrom(): string
    {
        return $this->userFrom;
    }

    /**
     * @param string $userFrom
     */
    public function setUserFrom(string $userFrom): void
    {
        $this->userFrom = $userFrom;
    }
}