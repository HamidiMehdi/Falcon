<?php

namespace App\UserInterface\Presenter\Security;

use MHamidi\Falcon\Domain\Security\Presenter\ForgotPasswordPresenterInterface;
use MHamidi\Falcon\Domain\Security\Response\ForgotPasswordResponse;
use Symfony\Component\HttpFoundation\RequestStack;

class ForgotPasswordPresenter implements ForgotPasswordPresenterInterface
{
    private RequestStack $request;

    private array $presenter = [
        'userFound' => false
    ];

    public function __construct(RequestStack $request)
    {
        $this->request = $request;
    }

    public function present(ForgotPasswordResponse $response): void
    {
        if ($response->getUser()) {
            $this->presenter['userFound'] = true;
            return;
        }

        $this->request->getSession()->getFlashBag()->add(
            "danger",
            "L'adresse email fournie n'est lié à aucun compte."
        );
    }

    public function getPresenter(): array
    {
        return $this->presenter;
    }
}
