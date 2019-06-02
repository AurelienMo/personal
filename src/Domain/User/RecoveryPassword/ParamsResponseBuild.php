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

namespace App\Domain\User\RecoveryPassword;

use Symfony\Component\Form\FormInterface;
use Twig\Environment;

/**
 * Class ParamsResponseBuild
 */
class ParamsResponseBuild
{
    /** @var Environment */
    protected $templating;

    /**
     * ParamsResponseBuild constructor.
     *
     * @param Environment $templating
     */
    public function __construct(
        Environment $templating
    ) {
        $this->templating = $templating;
    }

    public function build(string $template, FormInterface $form = null)
    {
        return [
            'datas' => [
                'html' => is_null($form) ?
                    $this->templating->render($template) :
                    $this->templating->render($template, ['form' => $form->createView()]),
                'message' => is_null($form) ? 'error' : 'success',
            ],
            'statusCode' => is_null($form) ? 200 : 400
        ];
    }
}
