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
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;
use Twig\Environment;

/**
 * Class ContactMailSubscriber
 */
class ContactMailSubscriber extends AbstractMailSubscriber
{
    /** @var string */
    private $dsn;

    /** @var Environment */
    protected $templating;

    public function __construct(string $dsn, Environment $templating, array $paramsMailApp)
    {
        $this->dsn = $dsn;
        $this->templating = $templating;
        parent::__construct($paramsMailApp);
    }

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            ContactMailEvent::class => 'onContactForm',
        ];
    }

    public function onContactForm(ContactMailEvent $event)
    {
        $email = (new Email())
            ->from(new Address($event->getContact()->getEmail(), sprintf('%s %s', $event->getContact()->getFirstname(), $event->getContact()->getLastname())))
            ->to(
                new Address(
                    $this->paramsMailApp['email'],
                    $this->paramsMailApp['name']
                )
            )
            ->subject('Demande information')
            ->html(
                $this->templating->render(
                    'mails/contact.html.twig',
                    [
                        'contact' => $event->getContact(),
                    ]
                )
            );

        $this->getMailer()->send($email);
    }

    private function getMailer(): Mailer
    {
        static $mailer;

        if (\is_null($mailer)) {
            $mailer = new Mailer(Transport::fromDsn($this->dsn));
        }

        return $mailer;
    }
}
