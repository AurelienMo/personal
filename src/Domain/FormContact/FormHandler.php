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

namespace App\Domain\FormContact;

use App\Domain\Common\Events\FlashMessageEvent;
use App\Domain\FormContact\Event\ContactMailEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Form\FormInterface;

/**
 * Class FormHandler
 */
class FormHandler
{
    /** @var EventDispatcherInterface */
    protected $eventDispatcher;

    /**
     * FormHandler constructor.
     *
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->eventDispatcher = $eventDispatcher;
    }

    public function handle(FormInterface $form): bool
    {
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $this->eventDispatcher->dispatch(new ContactMailEvent($data));
            $this->eventDispatcher->dispatch(
                new FlashMessageEvent(
                    'success',
                    'flash.contact.success'
                )
            );

            return true;
        }

        return false;
    }
}
