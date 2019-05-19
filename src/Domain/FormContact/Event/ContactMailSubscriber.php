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

namespace App\Domain\FormContact\Event;

use App\Domain\Common\Subscribers\AbstractMailSubscriber;

/**
 * Class ContactMailSubscriber
 */
class ContactMailSubscriber extends AbstractMailSubscriber
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            ContactMailEvent::MAIL_CONTACT_EVENT => 'onContactForm',
        ];
    }

    public function onContactForm(ContactMailEvent $event)
    {
        $this->mailHelper->send(
            [
                'email' => $event->getContact()->getEmail(),
                'name' => sprintf(
                    '%s %s',
                    $event->getContact()->getFirstname(),
                    $event->getContact()->getLastname()
                ),
            ],
            [
                'email' => $this->paramsMailApp['email'],
                'name' => $this->paramsMailApp['name'],
            ],
            'Demande information',
            'mails/contact.html.twig',
            [
                'contact' => $event->getContact(),
            ]
        );
    }
}
