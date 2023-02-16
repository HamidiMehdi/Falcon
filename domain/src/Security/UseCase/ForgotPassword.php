<?php

namespace MHamidi\Falcon\Domain\Security\UseCase;

use DateTimeImmutable;
use MHamidi\Falcon\Domain\Security\Gateway\UserGateway;
use MHamidi\Falcon\Domain\Security\Presenter\ForgotPasswordPresenterInterface;
use MHamidi\Falcon\Domain\Security\Provider\MailProviderInterface;
use MHamidi\Falcon\Domain\Security\Request\ForgotPasswordRequest;
use MHamidi\Falcon\Domain\Security\Response\ForgotPasswordResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\RouterInterface;

class ForgotPassword
{
    private UserGateway $userGateway;

    private RouterInterface $router;

    private MailProviderInterface $mailer;

    public function __construct(
        UserGateway $userGateway,
        RouterInterface $router,
        MailProviderInterface $mailer
        )
    {
        $this->userGateway = $userGateway;
        $this->router = $router;
        $this->mailer = $mailer;
    }

    public function execute(ForgotPasswordRequest $request, ForgotPasswordPresenterInterface $presenter): void
    {
        $request->validate();
        $user = $this->userGateway->getUserByEmail($request->getEmail());
        if ($user) {
            $user->setPasswordResetToken(bin2hex(random_bytes(30)));
            $user->setPasswordResetRequestedAt(new DateTimeImmutable());
            $this->userGateway->update($user);

            $link = $this->router->generate(
                'reset_password',
                [
                    'token' => $user->getPasswordResetToken()
                ],
                UrlGeneratorInterface::ABSOLUTE_URL
            );
            $this->mailer->sendPasswordResetEmail($user, $link);
        }

        $presenter->present(new ForgotPasswordResponse($user));
    }
}
