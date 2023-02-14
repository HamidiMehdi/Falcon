<?php

namespace App\UserInterface\Controller\Scanner;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

#[Route('/scanner', name: 'scanner', methods: ['GET'])]
class ScannerController
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
        return new Response($this->twig->render("scanner/index.html.twig"));
    }
}