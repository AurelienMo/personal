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

namespace App\Actions;

use App\Domain\FormContact\ContactFormType;
use App\Domain\FormContact\FormHandler;
use Morvan\Bundle\RespondersBundle\Responders\RedirectResponder;
use Morvan\Bundle\RespondersBundle\Responders\ViewResponder;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class Home
 *
 * @Route("/", name="homepage")
 */
class Home
{
    /** @var FormFactoryInterface */
    protected $formFactory;

    /** @var FormHandler */
    protected $formHandler;

    /**
     * Home constructor.
     *
     * @param FormFactoryInterface $formFactory
     * @param FormHandler          $formHandler
     */
    public function __construct(
        FormFactoryInterface $formFactory,
        FormHandler $formHandler
    ) {
        $this->formFactory = $formFactory;
        $this->formHandler = $formHandler;
    }

    /**
     * @param Request           $request
     * @param ViewResponder     $viewResponder
     * @param RedirectResponder $redirectResponder
     *
     * @return Response
     *
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function __invoke(Request $request, ViewResponder $viewResponder, RedirectResponder $redirectResponder)
    {
        $form = $this->formFactory->create(ContactFormType::class)
                                  ->handleRequest($request);

        if ($this->formHandler->handle($form)) {
            return $redirectResponder('homepage');
        }

        return $viewResponder(
            'core/home.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }
}
