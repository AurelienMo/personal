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

namespace App\Responders;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class AjaxResponder
 */
class AjaxResponder
{
    /** @var Environment */
    protected $templating;

    /**
     * AjaxResponder constructor.
     *
     * @param Environment $templating
     */
    public function __construct(
        Environment $templating
    ) {
        $this->templating = $templating;
    }

    /**
     * @param string $template
     * @param array  $paramsTemplate
     * @param int    $statusCode
     * @param bool   $isSuccess
     *
     * @return JsonResponse
     *
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function __invoke(
        string $template,
        array $paramsTemplate = [],
        int $statusCode = Response::HTTP_OK,
        bool $isSuccess = true
    ) {
        return new JsonResponse(
            [
                'html' => $this->templating->render($template, $paramsTemplate),
                'message' => $isSuccess ? 'success' : 'errror'
            ],
            $statusCode
        );
    }
}
