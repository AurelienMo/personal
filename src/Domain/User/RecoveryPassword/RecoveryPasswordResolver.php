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

use App\Domain\Common\Utils\TokenGeneratorHelper;
use App\Domain\User\RecoveryPassword\Events\RecoveryPasswordMailEvent;
use App\Entity\User;
use App\Entity\UserStatus;
use App\Repository\UserRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class RecoveryPasswordResolver
 */
class RecoveryPasswordResolver
{
    /** @var UserRepository */
    protected $userRepository;

    /** @var EventDispatcherInterface */
    protected $eventDispatcher;

    /**
     * RecoveryPasswordResolver constructor.
     *
     * @param UserRepository           $userRepository
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(
        UserRepository $userRepository,
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->userRepository = $userRepository;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @param RecoveryPasswordDTO $dto
     *
     * @throws NonUniqueResultException
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function resolve(RecoveryPasswordDTO $dto)
    {
        /** @var User|null $user */
        $user = is_string($dto->getIdentifier()) ?
            $this->userRepository->loadUserByUsername($dto->getIdentifier()) : null;
        if (is_null($user)) {
            return;
        }
        $user->resetAccount(TokenGeneratorHelper::generate());
        $this->userRepository->save();
        $this->eventDispatcher->dispatch(
            new RecoveryPasswordMailEvent($user)
        );
    }
}
