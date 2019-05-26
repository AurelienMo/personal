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

namespace App\Domain\User\Authentication;

/**
 * Class LoginDTO
 */
/**
 * Class LoginDTO
 */
class LoginDTO
{
    /**
     * @var string|null
     */
    protected $username;

    /**
     * @var string|null
     */
    protected $password;

    /**
     * LoginDTO constructor.
     *
     * @param string|null $username
     * @param string|null $password
     */
    public function __construct(
        $username = null,
        $password = null
    ) {
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * @return string|null
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return string|null
     */
    public function getPassword()
    {
        return $this->password;
    }
}
