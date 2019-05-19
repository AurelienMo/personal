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

namespace App\Domain\Common\Utils;

use Swift_Mailer;
use Swift_Message;
use Twig\Environment;

/**
 * Class MailHelper
 */
class MailHelper
{
    /** @var Swift_Mailer */
    protected $mailer;

    /** @var Environment */
    protected $templating;

    /**
     * MailHelper constructor.
     *
     * @param Swift_Mailer $mailer
     * @param Environment  $templating
     */
    public function __construct(
        Swift_Mailer $mailer,
        Environment $templating
    ) {
        $this->mailer = $mailer;
        $this->templating = $templating;
    }

    public function send(
        array $from,
        array $to,
        string $subject,
        string $template,
        array $paramsTemplate = []
    ) {
        $message = new Swift_Message();
        $message
            ->setSubject($subject)
            ->setFrom($from['email'], $from['name'])
            ->setTo($to['email'], $to['name'])
            ->setBody(
                $this->templating->render($template, $paramsTemplate),
                'text/html'
            );

        $this->mailer->send($message);
    }
}
