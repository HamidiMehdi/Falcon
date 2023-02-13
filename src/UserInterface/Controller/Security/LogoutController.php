<?php

namespace App\UserInterface\Controller\Security;

use Symfony\Component\Routing\Annotation\Route;

#[Route('/logout', name: 'logout', methods: ['GET'])]
class LogoutController
{
    public function __invoke(): void
    {
    }

}