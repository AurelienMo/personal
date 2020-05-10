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

namespace App\Domain\Common\Events;

use Symfony\Contracts\EventDispatcher\Event;

/**
 * Class FlashMessageEvent
 */
class FlashMessageEvent extends Event
{
    /** @var string */
    protected $type;

    /** @var string */
    protected $key;

    /** @var bool */
    protected $translatable;

    /**
     * FlashMessageEvent constructor.
     *
     * @param string $type
     * @param string $key
     * @param bool   $translatable
     */
    public function __construct(
        string $type,
        string $key,
        bool $translatable = true
    ) {
        $this->type = $type;
        $this->key = $key;
        $this->translatable = $translatable;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * @return bool
     */
    public function isTranslatable(): bool
    {
        return $this->translatable;
    }
}
