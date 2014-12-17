<?php
/**
 * Copyright (c) 2014 Flavius Aspra <flavius.as@gmail.com>
 *
 * @license http://mozilla.org/MPL/2.0/ Mozilla Public License v.2.0
 */

namespace Common\World;

use Common\World\Event\CommandFinished;
use Common\World\Event\CommandStarted;


class World
{
    /**
     * @var Environment
     */
    private $environment;

    /**
     * @var EventHub
     */
    private $eventHub;

    /**
     * @var CommandExecutor
     */
    private $commandExecutor;

    /**
     * @param Environment $environment
     */
    public function __construct(Environment $environment)
    {
        $adopted = $environment->adoptWorld($this);
        if (!$adopted) {
            throw new \RuntimeException("the environment has rejected this world for incompatibility reasons");
        }
    }

    /**
     * @param Command $command
     * @return Result
     */
    public function executeCommand(Command $command)
    {
        $this->eventHub->trigger(new CommandStarted($command));
        $result = $this->commandExecutor->execute($command);
        $this->eventHub->trigger(new CommandFinished($command, $result));
        return $result;
    }

    /**
     * @return Environment
     */
    public function environment()
    {
        return $this->environment;
    }

    /**
     * @param Environment $environment
     */
    public function setEnvironment(Environment $environment)
    {
        $this->environment = $environment;
    }

    /**
     * @return EventHub
     */
    public function eventHub()
    {
        return $this->eventHub;
    }

    /**
     * @param EventHub $eventHub
     */
    public function setEventHub(EventHub $eventHub) {
        $this->eventHub = $eventHub;
    }

    public function setCommandExecutor(CommandExecutor $commandExecutor)
    {
        $this->commandExecutor = $commandExecutor;
    }
}