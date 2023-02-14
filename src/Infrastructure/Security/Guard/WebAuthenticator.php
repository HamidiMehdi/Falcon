<?php

namespace App\Infrastructure\Security\Guard;

use MHamidi\Falcon\Domain\Security\Presenter\LoginPresenterInterface;
use MHamidi\Falcon\Domain\Security\Request\LoginRequest;
use MHamidi\Falcon\Domain\Security\Response\LoginResponse;
use MHamidi\Falcon\Domain\Security\UseCase\Login;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\CsrfTokenBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Authenticator\Token\PostAuthenticationToken;

class WebAuthenticator extends AbstractAuthenticator implements LoginPresenterInterface
{
    const LAST_EMAIL = 'LAST_EMAIL';
    const BAD_CREDENTIALS = 'BAD_CREDENTIALS';

    /** Login $login */
    private Login $login;

    /** UrlGeneratorInterface $urlGenerator */
    private UrlGeneratorInterface $urlGenerator;

    /** LoginResponse $response */
    private LoginResponse $response;


    public function __construct(Login $login, UrlGeneratorInterface $urlGenerator)
    {
        $this->login = $login;
        $this->urlGenerator = $urlGenerator;
    }

    public function present(LoginResponse $response): void
    {
        $this->response = $response;
    }

    public function supports(Request $request): ?bool
    {
        return $request->attributes->get('_route') === 'login' && $request->isMethod(Request::METHOD_POST);
    }

    public function authenticate(Request $request): Passport
    {
        $email = $request->request->get('_email');
        $password = $request->request->get('_password');
        $csrfToken = $request->request->get('_csrf_token');

        $request->getSession()->set(self::LAST_EMAIL, $email);

        $this->login->execute(LoginRequest::create($email, $password), $this);
        if (!$this->response->getUser() || !$this->response->isPasswordValid())
        {
            throw new CustomUserMessageAuthenticationException('Invalid credentials');
        }

        return new Passport(
            new UserBadge($email),
            new PasswordCredentials($password),
            [
                new CsrfTokenBadge('login_form', $csrfToken),
                //new RememberMeBadge()
            ]
        );
    }

    public function createToken(Passport $passport, string $firewallName): TokenInterface
    {
        return new PostAuthenticationToken($passport->getUser(), $firewallName, $passport->getUser()->getRoles());
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        $request->getSession()->remove(self::LAST_EMAIL);
        $request->getSession()->remove(self::BAD_CREDENTIALS);
        return new RedirectResponse($this->urlGenerator->generate('scanner'));
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        $request->getSession()->set(self::BAD_CREDENTIALS, $exception->getMessage());
        return new RedirectResponse($this->urlGenerator->generate('login'));
    }
}
