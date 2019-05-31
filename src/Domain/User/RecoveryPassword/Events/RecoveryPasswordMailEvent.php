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

use App\Entity\User;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class RecoveryPasswordMailEvent
 */
class RecoveryPasswordMailEvent extends Event
{
    const RECOVERY_PASSWORD_MAIL = 'app.recovery_password_mail.event';

    /** @var User */
    protected $user;

    /**
     * RecoveryPasswordMailEvent constructor.
     *
     * @param User $user
     */
    public function __construct(
        User $user
    ) {
        $this->user = $user;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }
}
