<?php
/**
 * Copyright (c) 2014 Flavius Aspra <flavius.as@gmail.com>
 *
 * @license http://mozilla.org/MPL/2.0/ Mozilla Public License v.2.0
 */

namespace Application\Common\User;


use Common\User\Command\Register;
use Common\User\Service;
use Common\World\Environment;
use Common\World\World;

class Testing implements Environment {

    /**
     * @param World $world
     * @return bool
     */
    public function adoptWorld(World $world)
    {
        $service = new Service($world);
        $world->commandExecutor()->setCommandHandlerFactory('Common\User\Command\Register', function(Register $command) use($service) {
            return $service;
        });
    }

    public function importEnvironment(Environment $other)
    {

    }
}