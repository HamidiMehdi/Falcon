<?php

namespace MHamidi\Falcon\Domain\Security\Provider;

use MHamidi\Falcon\Domain\Security\Entity\User;

interface MailProviderInterface
{
    public function sendPasswordResetEmail(User $user, string $link): void;
}
