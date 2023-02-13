<?php

namespace MHamidi\Filer\Domain\Security\Assert;

use Assert\Assertion as BaseAssertion;
use MHamidi\Filer\Domain\Security\Exception\NonUniqueEmailException;
use MHamidi\Filer\Domain\Security\Gateway\UserGateway;

class Assertion extends BaseAssertion
{
    public const EXISTING_EMAIL = 500;

    public static function nonUniqueEmail(string $email, UserGateway $userGateway): void
    {
        if (!$userGateway->isEmailUnique($email)) {
            throw new NonUniqueEmailException("This email already exists !", self::EXISTING_EMAIL);
        }
    }
}
