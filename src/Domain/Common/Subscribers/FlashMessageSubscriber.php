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

namespace App\Domain\Common\Subscribers;

use App\Domain\Common\Events\FlashMessageEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * Class FlashMessageSubscriber
 */
class FlashMessageSubscriber implements EventSubscriberInterface
{
    /** @var TranslatorInterface */
    protected $translator;

    /** @var SessionInterface */
    protected $session;

    /**
     * FlashMessageSubscriber constructor.
     *
     * @param TranslatorInterface $translator
     * @param SessionInterface    $session
     */
    public function __construct(
        TranslatorInterface $translator,
        SessionInterface $session
    ) {
        $this->translator = $translator;
        $this->session = $session;
    }

    /**
     * @return array
     *
     * @codeCoverageIgnore
     */
    public static function getSubscribedEvents()
    {
        return [
            FlashMessageEvent::FLASH_MESSAGE => 'onAddFlash',
        ];
    }

    /**
     * @param FlashMessageEvent $event
     */
    public function onAddFlash(FlashMessageEvent $event)
    {
        $flashbag = $this->session->getFlashBag();
        $flashbag->add(
            $event->getType(),
            $event->isTranslatable() ?
                $this->translator->trans($event->getKey(), [], 'messages') : $event->getKey()
        );
    }
}
