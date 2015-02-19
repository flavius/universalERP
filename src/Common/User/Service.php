<?php
/**
 * Copyright (c) 2014 Flavius Aspra <flavius.as@gmail.com>
 *
 * @license http://mozilla.org/MPL/2.0/ Mozilla Public License v.2.0
 */

namespace Common\User;


use Common\User\Command\Register;
use Common\User\Event\Registered;
use Common\World\Command;
use Common\World\Result\Boolean;
use Common\World\World;

class Service implements \Common\World\Service
{

    /**
     * @var World
     */
    private $world;

    /**
     * @param World $world
     */
    public function __construct(World $world)
    {
        $this->world = $world;
    }

    public function __invoke(Command $userCommand)
    {
        $this->executeRegister($userCommand);
        return new Boolean(true);
    }

    /** TODO: remove */
    private function executeRegister(Register $registerCommand)
    {
        $this->world->eventHub()->trigger(new Registered($registerCommand->asDictionary()['useridentification']));
    }
}