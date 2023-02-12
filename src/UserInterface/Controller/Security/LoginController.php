<?php

namespace App\UserInterface\Controller\Security;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Twig\Environment;

#[Route('/login', name: 'login', methods: ['GET|POST'])]
class LoginController
{
    /** @var Environment $twig */
    private Environment $twig;

    /**
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function __invoke(AuthenticationUtils $authenticationUtils): Response
    {
        return new Response($this->twig->render("security/login.html.twig", [
            'au' => $authenticationUtils
        ]));
    }
}