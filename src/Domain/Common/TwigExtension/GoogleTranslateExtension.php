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

namespace App\Domain\Common\TwigExtension;

use Stichoza\GoogleTranslate\GoogleTranslate;
use Symfony\Component\HttpFoundation\RequestStack;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

/**
 * Class GoogleTranslateExtension
 */
class GoogleTranslateExtension extends AbstractExtension
{
    /** @var RequestStack */
    protected $requestStack;

    /**
     * GoogleTranslateExtension constructor.
     *
     * @param RequestStack $requestStack
     */
    public function __construct(
        RequestStack $requestStack
    ) {
        $this->requestStack = $requestStack;
    }

    public function getFilters()
    {
        return [
            new TwigFilter('gtrans', [$this, 'translate']),
        ];
    }

    /**
     * @param string $text
     *
     * @return string|null
     * @throws \ErrorException
     */
    public function translate(string $text)
    {
        if (is_null($this->requestStack->getCurrentRequest())) {
            return $text;
        }

        return GoogleTranslate::trans(
            $text,
            $this->requestStack->getCurrentRequest()->getLocale(),
            'fr'
        );
    }
}
