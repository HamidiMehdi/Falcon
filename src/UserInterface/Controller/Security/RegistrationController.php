<?php

namespace App\UserInterface\Controller\Security;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

#[Route('/registration', name: 'registration', methods: ['GET|POST'])]
class RegistrationController
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

    public function __invoke(): Response
    {
        return new Response($this->twig->render("security/registration.html.twig", [
            'yoyo' => 'titi'
        ]));
    }
}