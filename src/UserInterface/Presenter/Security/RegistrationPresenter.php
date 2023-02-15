<?php

namespace App\UserInterface\Presenter;

use App\UserInterface\ViewModel\RegistrationViewModel;
use MHamidi\Falcon\Domain\Security\Presenter\RegistrationPresenterInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use MHamidi\Falcon\Domain\Security\Response\RegistrationResponse;

class RegistrationPresenter implements RegistrationPresenterInterface
{
    private RegistrationViewModel $viewModel;

    private UserProviderInterface $userProvider;

    public function __construct(UserProviderInterface $userProvider)
    {
        $this->userProvider = $userProvider;
    }

    public function present(RegistrationResponse $response): void
    {
        $this->viewModel = new RegistrationViewModel($this->userProvider->loadUserByIdentifier($response->getEmail()));
    }

    public function getViewModel(): RegistrationViewModel
    {
        return $this->viewModel;
    }
}
