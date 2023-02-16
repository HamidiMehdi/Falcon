<?php

namespace App\UserInterface\Controller\Security;

use App\UserInterface\Form\Security\ForgotPasswordType;
use App\UserInterface\Presenter\Security\ForgotPasswordPresenter;
use MHamidi\Falcon\Domain\Security\Request\ForgotPasswordRequest;
use MHamidi\Falcon\Domain\Security\UseCase\ForgotPassword;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

#[Route('/forgot-password', name: 'forgot_password', methods: ['GET|POST'])]
class ForgotPasswordController
{
    private Environment $twig;

    private FormFactoryInterface $formFactory;

    public function __construct(Environment $twig, FormFactoryInterface $formFactory)
    {
        $this->twig = $twig;
        $this->formFactory = $formFactory;
    }

    public function __invoke(Request $request, ForgotPassword $forgotPassword, ForgotPasswordPresenter $presenter): Response
    {
        $form = $this->formFactory->create(ForgotPasswordType::class)->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $forgotPasswordRequest = ForgotPasswordRequest::create($form->getData()->getEmail());
            $forgotPassword->execute($forgotPasswordRequest, $presenter);
        }

        return new Response($this->twig->render('security/forgot_password.html.twig', [
            'form' => $form->createView(),
            'presenter' => $presenter->getPresenter()
        ]));
    }
}
