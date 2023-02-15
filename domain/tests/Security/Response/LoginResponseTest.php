<?php

namespace MHamidi\Falcon\Domain\Tests\Response;

use MHamidi\Falcon\Domain\Security\Entity\User;
use MHamidi\Falcon\Domain\Security\Enum\UserFromEnum;
use MHamidi\Falcon\Domain\Security\Response\LoginResponse;
use PHPUnit\Framework\TestCase;

class LoginResponseTest extends TestCase
{
    public function testLoginResponseWithUser(): void
    {
        $loginResponse = new LoginResponse($this->getEntity(), true);

        $this->assertInstanceOf(User::class, $this->getEntity());
        $this->assertIsBool($loginResponse->isPasswordValid());
    }

    public function testLoginResponseWithoutUser(): void
    {
        $loginResponse = new LoginResponse(null, false);

        $this->assertNull($loginResponse->getUser());
        $this->assertIsBool($loginResponse->isPasswordValid());
    }

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