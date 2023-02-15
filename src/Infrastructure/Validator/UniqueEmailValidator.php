<?php

namespace App\Infrastructure\Validator;

use MHamidi\Falcon\Domain\Security\Gateway\UserGateway;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class UniqueEmailValidator extends ConstraintValidator
{
    private UserGateway $userGateway;

    public function __construct(UserGateway $userGateway)
    {
        $this->userGateway = $userGateway;
    }

    public function validate($value, Constraint $constraint)
    {
        if (!$this->userGateway->isEmailUnique($value)) {
            $this->context->buildViolation($constraint->message)->addViolation();
        }
    }
}
