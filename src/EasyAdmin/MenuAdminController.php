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

namespace App\EasyAdmin;

use App\Repository\MenuRepository;
use EasyCorp\Bundle\EasyAdminBundle\Controller\EasyAdminController;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

/**
 * Class MenuAdminController
 */
class MenuAdminController extends EasyAdminController
{
    /** @var MenuRepository */
    protected $menuRegistry;

    /**
     * MenuAdminController constructor.
     *
     * @param MenuRepository $menuRegistry
     */
    public function __construct(
        MenuRepository $menuRegistry
    ) {
        $this->menuRegistry = $menuRegistry;
    }

    protected function createMenuEntityFormBuilder(
        $entity,
        $view
    ) {
        $formBuilder = parent::createEntityFormBuilder($entity, $view);
        if ('new' === $view) {
            $formBuilder
                ->add(
                    'order',
                    IntegerType::class,
                    [
                        'label' => 'admin.entities.menu.order.label',
                        'required' => false,
                        'data' => count($this->menuRegistry->findAll()) + 1
                    ]
                );
        }

        return $formBuilder;
    }
}
