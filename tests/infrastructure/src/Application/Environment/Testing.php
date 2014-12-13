<?php

namespace Application\Environment;

use Application\World\EventHub;
use Common\World\Environment;
use Common\World\World;

class Testing implements Environment
{

    public function adoptWorld(World $world)
    {
        $world->setEnvironment($this);
        $world->setEventHub($this->newEventHub());
        return true;
    }

    protected function newEventHub()
    {
        return new EventHub();
    }
}