<?php

declare(strict_types=1);

/*
 * This file is part of personal
 *
 * (c) Aurelien Morvan <morvan.aurelien@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Domain\User\Authentication;

use App\Repository\UserRepository;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;

/**
 * Class LoginFormAuthenticator
 */
class LoginFormAuthenticator extends AbstractFormLoginAuthenticator
{
    /** @var FormFactoryInterface */
    protected $formFactory;

    /** @var UserRepository */
    protected $userRepository;

    /** @var UserPasswordEncoderInterface */
    protected $passwordEncoder;

    /** @var UrlGeneratorInterface */
    protected $urlGenerator;

    /** @var SessionInterface */
    protected $session;

    /**
     * LoginFormAuthenticator constructor.
     *
     * @param FormFactoryInterface         $formFactory
     * @param UserRepository               $userRepository
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param UrlGeneratorInterface        $urlGenerator
     * @param SessionInterface             $session
     */
    public function __construct(
        FormFactoryInterface $formFactory,
        UserRepository $userRepository,
        UserPasswordEncoderInterface $passwordEncoder,
        UrlGeneratorInterface $urlGenerator,
        SessionInterface $session
    ) {
        $this->formFactory = $formFactory;
        $this->userRepository = $userRepository;
        $this->passwordEncoder = $passwordEncoder;
        $this->urlGenerator = $urlGenerator;
        $this->session = $session;
    }

    /**
     * @param Request $request
     *
     * @return bool
     */
    public function supports(Request $request)
    {
        return $request->isMethod('POST') && $request->attributes->get('_route') === 'security_login';
    }

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function getCredentials(Request $request)
    {
        $form = $this->formFactory->create(LoginType::class)
            ->handleRequest($request);

        return $form->getData();
    }

    /**
     * @param LoginDTO              $credentials
     * @param UserProviderInterface $userProvider
     *
     * @return UserInterface
     *
     * @throws NonUniqueResultException
     */
    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        $user = !\is_null($credentials->getUsername()) ?
            $this->userRepository->loadUserByUsername($credentials->getUsername()) :
            null;

        if (\is_null($user)) {
            throw new CustomUserMessageAuthenticationException('error.invalid_identifier');
        }

        return $user;
    }

    /**
     * @param LoginDTO      $credentials
     * @param UserInterface $user
     *
     * @return bool
     *
     * @codeCoverageIgnore
     */
    public function checkCredentials($credentials, UserInterface $user)
    {
        if (\is_null($credentials->getPassword()) ||
            !$this->passwordEncoder->isPasswordValid($user, $credentials->getPassword())
        ) {
            throw new CustomUserMessageAuthenticationException('error.invalid_identifier');
        }

        return true;
    }

    /**
     * @param Request        $request
     * @param TokenInterface $token
     * @param string         $providerKey
     *
     * @return RedirectResponse
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        return new RedirectResponse(
            $this->urlGenerator->generate('homepage')
        );
    }

    /**
     * @return string
     */
    protected function getLoginUrl()
    {
        return $this->urlGenerator->generate('security_login');
    }

    /**
     * @param Request                      $request
     * @param AuthenticationException|null $authException
     *
     * @return RedirectResponse
     */
    public function start(
        Request $request,
        AuthenticationException $authException = null
    ) {
        $this->session->getFlashBag()->add('danger', 'error.user_must_be_connected');

        return new RedirectResponse($this->urlGenerator->generate('homepage'));
    }
}
