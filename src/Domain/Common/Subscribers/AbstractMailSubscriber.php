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

namespace App\Domain\Common\Subscribers;

use App\Domain\Common\Utils\MailHelper;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class AbstractMailSubscriber
 */
class AbstractMailSubscriber implements EventSubscriberInterface
{
    /** @var array */
    protected $paramsMailApp;

    /** @var MailHelper */
    protected $mailHelper;

    /**
     * AbstractMailSubscriber constructor.
     *
     * @param array      $paramsMailApp
     * @param MailHelper $mailHelper
     */
    public function __construct(
        array $paramsMailApp,
        MailHelper $mailHelper
    ) {
        $this->paramsMailApp = $paramsMailApp;
        $this->mailHelper = $mailHelper;
    }

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [];
    }
}
