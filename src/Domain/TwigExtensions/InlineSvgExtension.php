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

namespace App\Domain\TwigExtensions;

use Twig\Extension\AbstractExtension;
use Twig_SimpleFunction;

/**
 * Class InlineSvgExtension
 */
class InlineSvgExtension extends AbstractExtension
{
    /** @var string */
    private $webRootDir;

    /**
     * @param string $webRootDir
     */
    public function __construct(string $webRootDir)
    {
        $this->webRootDir = $webRootDir;
    }

    public function getFunctions()
    {
        return [
            new Twig_SimpleFunction('inline_svg', [$this, 'getInlineSvg'], ['is_safe' => ['html']]),
        ];
    }

    /**
     * @param string $svgUri
     * @return string
     * @throws \Exception
     */
    public function getInlineSvg(string $svgUri): string
    {
        try {
            $xmlString = file_get_contents($this->webRootDir.$svgUri);
            if (!$xmlString) {
                throw new \RuntimeException('SVG file not found : '.$svgUri);
            }
            $xml = new \SimpleXMLElement($xmlString);
            $dom = dom_import_simplexml($xml);
            if (!$dom) {
                throw new \RuntimeException('Unable to parse svg dom : '.$svgUri);
            }

            return $dom->ownerDocument->saveXML($dom->ownerDocument->documentElement);
        } catch (\Throwable $e) {
            dump($e);
            throw new \Exception('Not a valid svg! ', 0, $e);
        }
    }
}
