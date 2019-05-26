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

use App\Entity\User;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class UserRepository
 */
class UserRepository extends AbstractRepository implements UserLoaderInterface
{
    public function __construct(
        ManagerRegistry $registry
    ) {
        parent::__construct(
            $registry,
            User::class
        );
    }

    /**
     * @param string $username
     *
     * @return mixed|UserInterface|null
     *
     * @throws NonUniqueResultException
     */
    public function loadUserByUsername($username)
    {
        return $this->createQueryBuilder('u')
                    ->where('u.username = :identifier OR u.email = :identifier')
                    ->setParameter('identifier', $username)
                    ->getQuery()
                    ->getOneOrNullResult();
    }
}
