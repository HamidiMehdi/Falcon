<?php

namespace MHamidi\Falcon\Domain\Security\Assert;

use Assert\Assertion as BaseAssertion;
use MHamidi\Falcon\Domain\Security\Exception\NonUniqueEmailException;
use MHamidi\Falcon\Domain\Security\Gateway\UserGateway;

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
