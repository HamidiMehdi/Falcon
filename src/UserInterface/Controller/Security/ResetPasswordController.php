<?php

namespace App\UserInterface\Controller\Security;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

#[Route('/reset-password/{token}', name: 'reset_password', methods: ['GET|POST'])]
class ResetPasswordController
{
    private Environment $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function __invoke(): Response
    {
        return new Response($this->twig->render("security/reset_password.html.twig"));
    }
}