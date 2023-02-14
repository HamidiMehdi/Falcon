<?php

namespace MHamidi\Falcon\Domain\Security\Gateway;

use MHamidi\Falcon\Domain\Security\Entity\User;

interface UserGateway
{
    public function getUserByEmail(string $email): ?User;

    public function isEmailUnique(?string $email): bool;

}