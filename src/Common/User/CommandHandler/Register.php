<?php
/**
 * Copyright (c) 2014 Flavius Aspra <flavius.as@gmail.com>
 *
 * @license http://mozilla.org/MPL/2.0/ Mozilla Public License v.2.0
 */

namespace Common\User\CommandHandler;


use Common\User\Event\Registered;
use Common\World\Result\Boolean;
use Common\World\World;

class Register
{

    /**
     * @var World
     */
    private $world;

    public function __construct(World $world)
    {
        $this->world = $world;
    }

    public function __invoke(\Common\User\Command\Register $registerCommand)
    {
        $registeredEvent = new Registered($registerCommand->asDictionary()['useridentification']);
        $this->world->eventHub()->trigger($registeredEvent);
        return new Boolean(true);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return get_class($this) . "(" . dechex(crc32(spl_object_hash($this))) . ")";
    }
}