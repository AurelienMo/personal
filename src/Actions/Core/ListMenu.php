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
use Symfony\Component\HttpFoundation\RequestStack;
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

    /** @var RequestStack */
    protected $requestStack;

    /**
     * ListMenu constructor.
     *
     * @param MenuRepository $menuRepository
     * @param RequestStack   $requestStack
     */
    public function __construct(
        MenuRepository $menuRepository,
        RequestStack $requestStack
    ) {
        $this->menuRepository = $menuRepository;
        $this->requestStack = $requestStack;
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
            'parts/menu.html.twig',
            [
                'menus' => $menus,
                'reqStack' => $this->requestStack->getMasterRequest(),
            ]
        );
    }
}
