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
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;

/**
 * Class AbstractRepository
 *
 * @codeCoverageIgnore
 */
abstract class AbstractRepository extends ServiceEntityRepository
{
    /**
     * @param AbstractEntity $entity
     *
     * @throws ORMException
     */
    public function remove(AbstractEntity $entity)
    {
        $this->_em->remove($entity);
        $this->save();
    }

    /**
     * @param AbstractEntity|null $entity
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function save(AbstractEntity $entity = null)
    {
        if (!\is_null($entity)) {
            $this->_em->persist($entity);
        }

        $this->_em->flush();
    }
}
