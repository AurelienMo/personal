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

namespace App\Repository;

use App\Entity\AbstractEntity;
use App\Entity\Menu;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * Class MenuRepository
 */
class MenuRepository extends AbstractRepository
{
    public function __construct(
        ManagerRegistry $registry
    ) {
        parent::__construct(
            $registry,
            Menu::class
        );
    }

    /**
     * @param array $filters
     *
     * @return array
     */
    public function getMenusByFilter(array $filters = [])
    {
        $qb = $this->createQueryBuilder('m')
                   ->where('m.enabled = true')
                   ->orderBy('m.order', 'ASC');

        if (!empty($filters)) {
            foreach ($filters as $property => $value) {
                $qb->andWhere(sprintf('m.%s = %s', $property, $value))
                    ->setParameter($property, $value);
            }
        }

        return $qb->getQuery()->getResult();
    }
}
