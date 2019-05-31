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

namespace App\Domain\CreateUserFromCLI;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

/**
 * Class CreateUserCommand
 */
class CreateUserCommand extends Command
{
    const LIST_FIELDS = [
        'username' => null,
        'email' => null,
        'status' => null,
        'password' => null,
        'role' => null,
        'firstname' => null,
        'lastname' => null,
    ];

    /** @var EntityManagerInterface */
    protected $entityManager;

    /** @var EncoderFactoryInterface */
    protected $encoderFactory;

    public function __construct(
        EntityManagerInterface $entityManager,
        EncoderFactoryInterface $encoderFactory,
        string $name = null
    ) {
        $this->entityManager = $entityManager;
        $this->encoderFactory = $encoderFactory;
        parent::__construct($name);
    }

    protected function configure()
    {
        $this
            ->setName('app:create-user')
            ->setDescription('Allow create user from cli');
    }

    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ) {
        $fieldsUser = self::LIST_FIELDS;
        foreach ($fieldsUser as $field => $value) {
            $question  = new Question(
                sprintf(
                    'Please choose value for field %s :',
                    $field
                )
            );
            $fieldsUser[$field] = $this->getQuestionHelper()->ask($input, $output, $question);
        }

        $user = new User();
        $user->setUsername($fieldsUser['username']);
        $user->setEmail($fieldsUser['email']);
        $user->setPassword(
            ($this->encoderFactory->getEncoder(User::class))->encodePassword($fieldsUser['password'], '')
        );
        $user->setFirstname($fieldsUser['firstname']);
        $user->setLastname($fieldsUser['lastname']);
        $user->setStatus($fieldsUser['status']);
        $user->setRole($fieldsUser['role']);

        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }

    /**
     * @return mixed|QuestionHelper
     */
    private function getQuestionHelper()
    {
        return $this->getHelper('question');
    }
}
