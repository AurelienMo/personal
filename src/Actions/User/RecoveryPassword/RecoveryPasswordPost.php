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

use App\Domain\User\RecoveryPassword\ParamsResponseBuild;
use App\Domain\User\RecoveryPassword\RecoveryPasswordResolver;
use App\Domain\User\RecoveryPassword\RecoveryPasswordType;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Morvan\Bundle\RespondersBundle\Exceptions\TypeDatasNotAllowedException;
use Morvan\Bundle\RespondersBundle\Responders\JsonResponder;
use Morvan\Bundle\RespondersBundle\Responders\ViewResponder;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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

    /** @var ParamsResponseBuild */
    protected $paramsResponseBuild;

    /**
     * RecoveryPasswordPost constructor.
     *
     * @param FormFactoryInterface     $formFactory
     * @param RecoveryPasswordResolver $recoveryPasswordResolver
     * @param ParamsResponseBuild      $paramsResponseBuild
     */
    public function __construct(
        FormFactoryInterface $formFactory,
        RecoveryPasswordResolver $recoveryPasswordResolver,
        ParamsResponseBuild $paramsResponseBuild
    ) {
        $this->formFactory = $formFactory;
        $this->recoveryPasswordResolver = $recoveryPasswordResolver;
        $this->paramsResponseBuild = $paramsResponseBuild;
    }

    /**
     * @param Request       $request
     * @param ViewResponder $responder
     *
     * @param JsonResponder $jsonResponder
     *
     * @return Response
     *
     * @throws NonUniqueResultException
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws TypeDatasNotAllowedException
     */
    public function __invoke(Request $request, ViewResponder $responder, JsonResponder $jsonResponder)
    {
        $form = $this->formFactory->create(RecoveryPasswordType::class)
                                  ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->recoveryPasswordResolver->resolve($form->getData());
            $result = $this->paramsResponseBuild->build('security/confirm_lost_password.html.twig');

            return $jsonResponder(
                $result['datas'],
                $result['statusCode']
            );
        }
        $result = $this->paramsResponseBuild->build('security/lost_password.html.twig', $form);

        return $jsonResponder(
            $result['datas'],
            $result['statusCode']
        );
    }
}
