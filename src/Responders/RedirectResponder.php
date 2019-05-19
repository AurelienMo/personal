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

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Class RedirectResponder
 */
class RedirectResponder
{
    /** @var UrlGeneratorInterface */
    protected $urlGenerator;

    /**
     * RedirectResponder constructor.
     *
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(
        UrlGeneratorInterface $urlGenerator
    ) {
        $this->urlGenerator = $urlGenerator;
    }

    public function __invoke(
        string $routeName,
        array $paramsRoute = []
    ) {
        return new RedirectResponse(
            $this->urlGenerator->generate($routeName, $paramsRoute)
        );
    }
}
