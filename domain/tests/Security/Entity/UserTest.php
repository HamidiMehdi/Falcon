<?php

namespace MHamidi\Falcon\Domain\Tests\Entity;

use MHamidi\Falcon\Domain\Security\Entity\User;
use MHamidi\Falcon\Domain\Security\Enum\UserFromEnum;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserTest extends KernelTestCase
{

    public function getEntity() : User
    {
        return new User(
            1,
            'Mehdi',
            'HAMIDI',
            'm.hamidi@test.com',
            'azerty',
            ['ROLE_USER'],
            UserFromEnum::APP
        );
    }
}