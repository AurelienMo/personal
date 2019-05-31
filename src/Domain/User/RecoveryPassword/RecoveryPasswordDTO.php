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

namespace App\Domain\User\RecoveryPassword;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class RecoveryPasswordDTO
 */
class RecoveryPasswordDTO
{
    /**
     * @var string|null
     *
     * @Assert\NotBlank(
     *     message="identifier.required"
     * )
     */
    protected $identifier;

    /**
     * RecoveryPasswordDTO constructor.
     *
     * @param string|null $identifier
     */
    public function __construct(
        ?string $identifier
    ) {
        $this->identifier = $identifier;
    }

    /**
     * @return string|null
     */
    public function getIdentifier(): ?string
    {
        return $this->identifier;
    }
}
