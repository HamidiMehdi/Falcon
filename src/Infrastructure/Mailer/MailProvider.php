<?php

namespace App\Infrastructure\Mailer;

use MHamidi\Falcon\Domain\Security\Entity\User;
use MHamidi\Falcon\Domain\Security\Provider\MailProviderInterface;

class MailProvider implements MailProviderInterface
{
    public function sendPasswordResetEmail(User $user, string $link): void
    {
        // send email
    }
}
