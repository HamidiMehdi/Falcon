<?php

namespace App\Infrastructure\Validator;

use Symfony\Component\Validator\Constraint;

class UniqueEmail extends Constraint
{
    public string $message = "This email already exists.";
}
