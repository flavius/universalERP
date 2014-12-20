<?php
/**
 * Copyright (c) 2014 Flavius Aspra <flavius.as@gmail.com>
 *
 * @license http://mozilla.org/MPL/2.0/ Mozilla Public License v.2.0
 */

namespace Common\World;

use Common\World\Event\CommandFinished;
use Common\World\Event\CommandStarted;

class CommandExecutor
{

    /**
     * @var array map of commandClass => factoryClass
     */
    private $factoryClasses = [];

    /**
     * @var array map of commandClass => factory instance
     */
    private $factories = [];
    /**
     * @var EventHub
     */
    private $eventHub;

    /**
     * @param EventHub $eventHub
     */
    public function __construct(EventHub $eventHub)
    {
        $this->eventHub = $eventHub;
    }

    /**
     * @param string $commandClass
     * @param string|callable $factoryClass
     */
    public function setCommandHandlerFactory($commandClass, $factoryClass)
    {
        if (is_string($factoryClass)) {
            $this->factoryClasses[$commandClass] = $factoryClass;
        } elseif (is_callable($factoryClass)) {
            $this->factories[$commandClass] = $factoryClass;
        }
    }

    public function execute(Command $command)
    {
        $this->eventHub->trigger(new CommandStarted($command));
        $handler = $this->findHandler($command);
        $result = $handler($command);
        $this->eventHub->trigger(new CommandFinished($command, $result));
        return $result;
    }

    public function findHandler(Command $command)
    {
        $commandClass = get_class($command);
        $factory = $this->getHandlerFactory($commandClass);
        return $factory($command);
    }

    /**
     * @param $commandClass
     * @return CommandHandlerFactory
     */
    public function getHandlerFactory($commandClass)
    {
        if (isset($this->factoryClasses[$commandClass])) {
            $wantedFactoryClass = $this->factoryClasses[$commandClass];
            if (!isset($this->factories[$wantedFactoryClass])) {
                $this->factories[$wantedFactoryClass] = new $wantedFactoryClass;
            }
        } else {
            $wantedFactoryClass = $commandClass;
        }
        return $this->factories[$wantedFactoryClass];
    }
}