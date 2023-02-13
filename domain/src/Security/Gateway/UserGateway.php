<?php

namespace MHamidi\Filer\Domain\Security\Gateway;

use MHamidi\Filer\Domain\Security\Entity\User;

interface UserGateway
{
    public function getUserByEmail(string $email): ?User;

    public function isEmailUnique(?string $email): bool;

}