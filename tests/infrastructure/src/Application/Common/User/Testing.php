<?php
/**
 * Copyright (c) 2014 Flavius Aspra <flavius.as@gmail.com>
 *
 * @license http://mozilla.org/MPL/2.0/ Mozilla Public License v.2.0
 */

namespace Application\Common\User;

use Common\User\Command\Register;
use Common\User\FindUserById;
use Common\User\Service;
use Common\World\Command;
use Common\World\Environment;
use Common\World\World;

class Testing implements Environment {

    /**
     * @param World $world
     * @return bool
     */
    public function adoptWorld(World $world)
    {
        $handlers = [
            'Common\User\Command\Register' => 'Common\User\CommandHandler\Register',
        ];
        $defaultHandler = function(Command $command) use($world, $handlers) {
            if(!isset($handlers[get_class($command)])) {
                //throw new \RuntimeException("No handler for command '" . get_class($command) . "'");
                return NULL;
            }
            $handler = $handlers[get_class($command)];
            return new $handler($world);
        };
        foreach($handlers as $command => $handler) {
            $world->commandExecutor()->setCommandHandlerFactory($command, $defaultHandler);
        }
        //$world->commandExecutor()->setCommandHandler('Common\User\Command\Register', 'Common\User\CommandHandler\Register');

        /*
        $service = new Service($world);
        $world->commandExecutor()->setCommandHandlerFactory('Common\User\Command\Register', function(Register $command) use($service) {
            return $service;
        });
        $world->queryExecutor()->setQueryHandlerFactory('Common\User\FindUserById', function(FindUserById $query) use($service) {
            return $service;
        });
        */
    }

    public function importEnvironment(Environment $other)
    {

    }
}