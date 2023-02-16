<?php

namespace App\UserInterface\Controller\Security;

use App\Infrastructure\Security\Guard\WebAuthenticator;
use App\UserInterface\Form\Security\RegistrationType;
use App\UserInterface\Presenter\Security\RegistrationPresenter;
use MHamidi\Falcon\Domain\Security\Enum\UserFromEnum;
use MHamidi\Falcon\Domain\Security\Request\RegistrationRequest;
use MHamidi\Falcon\Domain\Security\UseCase\Registration;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use Twig\Environment;

#[Route('/registration', name: 'registration', methods: ['GET|POST'])]
class RegistrationController
{
    private Environment $twig;

    private FormFactoryInterface $formFactory;

    private UserAuthenticatorInterface $userAuthenticator;

    private WebAuthenticator $authenticator;

    public function __construct(
        Environment $twig,
        FormFactoryInterface $formFactory,
        UserAuthenticatorInterface $userAuthenticator,
        WebAuthenticator $authenticator
    )
    {
        $this->twig = $twig;
        $this->formFactory = $formFactory;
        $this->userAuthenticator = $userAuthenticator;
        $this->authenticator = $authenticator;
    }

    public function __invoke(Request $request, Registration $registration, RegistrationPresenter $presenter): Response
    {
        $form = $this->formFactory->create(RegistrationType::class)->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $registrationRequest = RegistrationRequest::create(
                $form->getData()->getFirstname(),
                $form->getData()->getLastname(),
                $form->getData()->getEmail(),
                $form->getData()->getPassword(),
                UserFromEnum::APP
            );

            $registration->execute($registrationRequest, $presenter);

            return $this->userAuthenticator->authenticateUser(
                $presenter->getUser(),
                $this->authenticator,
                $request
            );
        }

        return new Response($this->twig->render("security/registration.html.twig", [
            'form' => $form->createView()
        ]));
    }
}