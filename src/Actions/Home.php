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

use App\Responders\ViewResponder;
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
        return $responder(
            'core/home.html.twig'
        );
    }
}
