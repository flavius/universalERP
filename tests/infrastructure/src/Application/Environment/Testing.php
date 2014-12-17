<?php

namespace Application\Environment;

use Application\World\EventHub;
use Common\World\CommandExecutor;
use Common\World\Environment;
use Common\World\World;

class Testing implements Environment
{

    public function adoptWorld(World $world)
    {
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
        return new CommandExecutor();
    }

    public function __toString() {
        return get_class($this) . "(".dechex(crc32(spl_object_hash($this))).")";
    }
}