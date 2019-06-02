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

use App\Domain\User\RecoveryPassword\RecoveryPasswordType;
use Morvan\Bundle\RespondersBundle\Responders\ViewResponder;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class RecoveryPasswordGet
 *
 * @Route("/recovery", name="recovery_password_get", methods={"GET"})
 */
class RecoveryPasswordGet
{
    /** @var FormFactoryInterface */
    protected $formFactory;

    /**
     * RecoveryPasswordGet constructor.
     *
     * @param FormFactoryInterface $formFactory
     */
    public function __construct(
        FormFactoryInterface $formFactory
    ) {
        $this->formFactory = $formFactory;
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
        $form = $this->formFactory->create(RecoveryPasswordType::class);

        return $responder(
            'security/lost_password.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }
}
