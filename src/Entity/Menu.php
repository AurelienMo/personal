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

use App\Entity\Traits\NameTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Menu
 *
 * @ORM\Table(name="amo_menu")
 * @ORM\Entity(repositoryClass="App\Repository\MenuRepository")
 */
class Menu extends AbstractEntity
{
    use NameTrait;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string")
     */
    protected $routeName;

    /**
     * @var int|null
     *
     * @ORM\Column(type="integer", name="order_menu")
     */
    protected $order;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    protected $enabled;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $icon;

    /**
     * @return string|null
     */
    public function getRouteName(): ?string
    {
        return $this->routeName;
    }

    /**
     * @param string|null $routeName
     */
    public function setRouteName(?string $routeName): void
    {
        $this->routeName = $routeName;
    }

    /**
     * @return int|null
     */
    public function getOrder(): ?int
    {
        return $this->order;
    }

    /**
     * @param int|null $order
     */
    public function setOrder(?int $order): void
    {
        $this->order = $order;
    }

    /**
     * @return bool
     */
    public function isEnabled(): ?bool
    {
        return $this->enabled;
    }

    /**
     * @param bool $enabled
     */
    public function setEnabled(bool $enabled): void
    {
        $this->enabled = $enabled;
    }

    /**
     * @return string|null
     */
    public function getIcon(): ?string
    {
        return $this->icon;
    }

    /**
     * @param string|null $icon
     */
    public function setIcon(?string $icon): void
    {
        $this->icon = $icon;
    }
}
