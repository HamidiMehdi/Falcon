<?php

namespace App\UserInterface\Controller\Filer;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

#[Route('/filer', name: 'filer', methods: ['GET'])]
class FilerController
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
        return new Response($this->twig->render("filer/index.html.twig"));
    }
}