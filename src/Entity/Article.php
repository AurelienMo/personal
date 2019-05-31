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

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Article
 *
 * @ORM\Table(name="amo_article")
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 */
class Article extends AbstractEntity
{

}
