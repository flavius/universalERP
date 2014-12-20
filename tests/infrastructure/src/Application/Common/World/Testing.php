<?php

namespace Application\Common\World;

use Common\User\Command\Register;
use Common\User\Service;
use Common\World\CommandExecutor;
use Common\World\Environment;
use Common\World\World;

class Testing implements Environment
{

    /**
     * @var World
     */
    private $world;

    /**
     * @param World $world
     * @return bool
     */
    public function adoptWorld(World $world)
    {
        $this->world = $world;
        $world->setEnvironment($this);
        $world->setEventHub($this->newEventHub());
        $world->setCommandExecutor($this->newCommandExecutor());
        return true;
    }

    protected function newEventHub()
    {
        return new EventHub();
    }

    protected function newCommandExecutor() {
        $executor = new CommandExecutor();
        $executor->setCommandHandlerFactory('Common\User\Command\Register', function(Register $command) {
            return new Service($this->world);
        });
        return $executor;
    }

    public function __toString() {
        return get_class($this) . "(".dechex(crc32(spl_object_hash($this))).")";
    }

    /**
     * @param Environment $other
     */
    public function importEnvironment(Environment $other)
    {

    }
}