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

namespace App\Entity;

/**
 * Class UserStatus
 */
class UserStatus
{
    const STATUS_PENDING_ACTIVATION = 'pending_activation';
    const STATUS_ENABLED = 'enabled';
    const STATUS_LOCK = 'locked';

    const LIST_ROLES = [
        'admin' => 'ROLE_ADMIN',
        'user' => 'ROLE_USER',
    ];
}
