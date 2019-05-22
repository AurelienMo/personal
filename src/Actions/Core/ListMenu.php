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

namespace App\Actions\Core;

use App\Repository\MenuRepository;
use App\Responders\ViewResponder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class ListMenu
 *
 * @Route("/menu", name="menu")
 */
class ListMenu
{
    /** @var MenuRepository */
    protected $menuRepository;

    /**
     * ListMenu constructor.
     *
     * @param MenuRepository $menuRepository
     */
    public function __construct(
        MenuRepository $menuRepository
    ) {
        $this->menuRepository = $menuRepository;
    }

    /**
     * @param Request       $request
     * @param ViewResponder $responder
     *
     * @return Response
     *
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function __invoke(Request $request, ViewResponder $responder)
    {
        $menus = $this->menuRepository->getMenusByFilter();

        return $responder(
            'parts/header.html.twig',
            [
                'menus' => $menus,
            ]
        );
    }
}
