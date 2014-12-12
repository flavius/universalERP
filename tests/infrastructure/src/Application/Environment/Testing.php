<?php

namespace Application\Environment;

use Common\World\Environment;
use Common\World\World;

class Testing implements Environment
{

    public function adoptWorld(World $world)
    {
        $world->setEnvironment($this);
        return true;
    }
}