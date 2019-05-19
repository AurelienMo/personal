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

namespace App\Domain\FormContact;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class ContactDTO
 */
class ContactDTO
{
    /**
     * @var string|null
     *
     * @Assert\NotBlank(
     *     message="firstname.required"
     * )
     */
    protected $firstname;

    /**
     * @var string|null
     *
     * @Assert\NotBlank(
     *     message="lastname.required"
     * )
     */
    protected $lastname;

    /**
     * @var string|null
     *
     * @Assert\NotBlank(
     *     message="email.required"
     * )
     * @Assert\Email(
     *     message="email.format_invalid"
     * )
     */
    protected $email;

    /**
     * @var string|null
     *
     * @Assert\NotBlank(
     *     message="subject.required"
     * )
     */
    protected $subject;

    /**
     * @var string|null
     *
     * @Assert\NotBlank(
     *     message="message.required"
     * )
     */
    protected $message;

    /**
     * ContactDTO constructor.
     *
     * @param string|null $firstname
     * @param string|null $lastname
     * @param string|null $email
     * @param string|null $subject
     * @param string|null $message
     */
    public function __construct(
        ?string $firstname,
        ?string $lastname,
        ?string $email,
        ?string $subject,
        ?string $message
    ) {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->subject = $subject;
        $this->message = $message;
    }

    /**
     * @return string|null
     */
    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    /**
     * @return string|null
     */
    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @return string|null
     */
    public function getSubject(): ?string
    {
        return $this->subject;
    }

    /**
     * @return string|null
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }
}
