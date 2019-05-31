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

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Class RecoveryPasswordType
 */
class RecoveryPasswordType extends AbstractType
{
    /** @var UrlGeneratorInterface */
    protected $urlGenerator;

    /**
     * RecoveryPasswordType constructor.
     *
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(
        UrlGeneratorInterface $urlGenerator
    ) {
        $this->urlGenerator = $urlGenerator;
    }

    public function buildForm(
        FormBuilderInterface $builder,
        array $options
    ) {
        $builder
            ->add(
                'identifier',
                TextType::class,
                [
                    'label' => 'form.lost_password.identifier',
                    'required' => false,
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => RecoveryPasswordDTO::class,
                'empty_data' => function (FormInterface $form) {
                    return new RecoveryPasswordDTO(
                        $form->get('identifier')->getData()
                    );
                },
                'action' => $this->urlGenerator->generate('recovery_password_post'),
            ]
        );
    }
}
