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

namespace App\Actions\Security\Authentication;

use App\Domain\User\Authentication\LoginType;
use App\Responders\ViewResponder;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class Login
 *
 * @Route("/login", name="security_login")
 */
class Login
{
    /** @var FormFactoryInterface */
    protected $formFactory;

    /** @var AuthenticationUtils */
    protected $authenticationUtils;

    /**
     * Login constructor.
     *
     * @param FormFactoryInterface $formFactory
     * @param AuthenticationUtils  $authenticationUtils
     */
    public function __construct(
        FormFactoryInterface $formFactory,
        AuthenticationUtils $authenticationUtils
    ) {
        $this->formFactory = $formFactory;
        $this->authenticationUtils = $authenticationUtils;
    }

    /**
     * @param ViewResponder $responder
     *
     * @return Response
     *
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function __invoke(ViewResponder $responder)
    {
        $form = $this->formFactory->create(LoginType::class);

        return $responder(
            'security/authentication/login.html.twig',
            [
                'form' => $form->createView(),
                'error' => $this->authenticationUtils->getLastAuthenticationError(),
            ]
        );
    }
}
