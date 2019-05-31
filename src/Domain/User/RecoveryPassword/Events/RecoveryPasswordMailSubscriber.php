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

namespace App\Domain\User\RecoveryPassword\Events;

use App\Domain\Common\Subscribers\AbstractMailSubscriber;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * Class RecoveryPasswordMailSubscriber
 */
class RecoveryPasswordMailSubscriber extends AbstractMailSubscriber
{
    const SUBJECT_MAIL = '';

    public static function getSubscribedEvents()
    {
        return [
            RecoveryPasswordMailEvent::RECOVERY_PASSWORD_MAIL => 'onRecoveryPassword',
        ];
    }

    public function onRecoveryPassword(RecoveryPasswordMailEvent $event)
    {
        $this->mailHelper->send(
            $this->paramsMailApp,
            [
                'email' => $event->getUser()->getEmail(),
                'name' => sprintf(
                    '%s %s',
                    $event->getUser()->getFirstname(),
                    $event->getUser()->getLastname()
                ),
            ],
            $this->translator->trans(self::SUBJECT_MAIL),
            'mails/recovery_password.html.twig',
            [
                'user' => $event->getUser(),
            ]
        );
    }
}
