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

use App\Domain\FormContact\ContactDTO;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class ContactMailEvent
 */
class ContactMailEvent extends Event
{
    const MAIL_CONTACT_EVENT = 'app.mails.contact';

    /** @var ContactDTO */
    protected $contact;

    /**
     * ContactMailEvent constructor.
     *
     * @param ContactDTO $contact
     */
    public function __construct(
        ContactDTO $contact
    ) {
        $this->contact = $contact;
    }

    /**
     * @return ContactDTO
     */
    public function getContact(): ContactDTO
    {
        return $this->contact;
    }
}
