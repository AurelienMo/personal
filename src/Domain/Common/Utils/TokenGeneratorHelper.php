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

/**
 * Class TokenGeneratorHelper
 */
class TokenGeneratorHelper
{
    /**
     * @return string
     */
    public static function generate()
    {
        return md5(uniqid());
    }
}
