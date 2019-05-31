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

namespace App\Actions\User\RecoveryPassword;

use App\Domain\User\RecoveryPassword\RecoveryPasswordResolver;
use App\Domain\User\RecoveryPassword\RecoveryPasswordType;
use App\Responders\AjaxResponder;
use App\Responders\ViewResponder;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class RecoveryPasswordPost
 *
 * @Route("/recovery", name="recovery_password_post", methods={"POST"})
 */
class RecoveryPasswordPost
{
    /** @var FormFactoryInterface */
    protected $formFactory;

    /** @var RecoveryPasswordResolver */
    protected $recoveryPasswordResolver;

    /**
     * RecoveryPasswordPost constructor.
     *
     * @param FormFactoryInterface     $formFactory
     * @param RecoveryPasswordResolver $recoveryPasswordResolver
     */
    public function __construct(
        FormFactoryInterface $formFactory,
        RecoveryPasswordResolver $recoveryPasswordResolver
    ) {
        $this->formFactory = $formFactory;
        $this->recoveryPasswordResolver = $recoveryPasswordResolver;
    }

    /**
     * @param Request       $request
     * @param ViewResponder $responder
     *
     * @param AjaxResponder $ajaxResponder
     *
     * @return Response
     *
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws NonUniqueResultException
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function __invoke(Request $request, ViewResponder $responder, AjaxResponder $ajaxResponder)
    {
        $form = $this->formFactory->create(RecoveryPasswordType::class)
                                  ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->recoveryPasswordResolver->resolve($form->getData());

            return $ajaxResponder(
                'security/confirm_lost_password.html.twig'
            );
        }


        return $ajaxResponder(
            'security/lost_password.html.twig',
            [
                'form' => $form->createView(),
                'message' => 'error',
            ],
            Response::HTTP_BAD_REQUEST,
            false
        );
    }
}
