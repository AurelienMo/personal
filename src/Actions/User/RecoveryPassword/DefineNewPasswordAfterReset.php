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

namespace App\Actions\User\RecoveryPassword;

use Exception;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DefineNewPasswordAfterReset
 *
 * @Route("/define-password", name="define_new_password")
 */
class DefineNewPasswordAfterReset
{
    public function __invoke()
    {
        throw new Exception('Pending implement');
    }
}
