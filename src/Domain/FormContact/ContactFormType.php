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

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class ContactFormType
 */
class ContactFormType extends AbstractType
{
    public function buildForm(
        FormBuilderInterface $builder,
        array $options
    ) {
        $builder
            ->add(
                'firstname',
                TextType::class,
                [
                    'label' => 'form.contact.firstname',
                ]
            )
            ->add(
                'lastname',
                TextType::class,
                [
                    'label' => 'form.contact.lastname',
                ]
            )
            ->add(
                'email',
                EmailType::class,
                [
                    'label' => 'form.contact.email',
                ]
            )
            ->add(
                'subject',
                TextType::class,
                [
                    'label' => 'form.contact.subject',
                ]
            )
            ->add(
                'message',
                TextareaType::class,
                [
                    'label' => 'form.contact.message',
                ]
            )
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => ContactDTO::class,
                'empty_data' => function (FormInterface $form) {
                    return new ContactDTO(
                        $form->get('firstname')->getData(),
                        $form->get('lastname')->getData(),
                        $form->get('email')->getData(),
                        $form->get('subject')->getData(),
                        $form->get('message')->getData()
                    );
                },
            ]
        );
    }
}
