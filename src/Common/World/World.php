<?php
/**
 * Copyright (c) 2014 Flavius Aspra <flavius.as@gmail.com>
 *
 * @license http://mozilla.org/MPL/2.0/ Mozilla Public License v.2.0
 */

namespace Common\World;

use Common\World\Event\Adopted;


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
            throw new \RuntimeException('the environment has rejected this world for incompatibility reasons');
        } else {
            $this->eventHub->trigger(new Adopted($this, $environment));
        }
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
     * @return $this
     */
    public function setEnvironment(Environment $environment)
    {
        $this->environment = $environment;
        return $this;
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
     * @return $this
     */
    public function setEventHub(EventHub $eventHub) {
        $this->eventHub = $eventHub;
        return $this;
    }

    /**
     * @param CommandExecutor $commandExecutor
     * @return $this
     */
    public function setCommandExecutor(CommandExecutor $commandExecutor)
    {
        $this->commandExecutor = $commandExecutor;
        return $this;
    }

    public function __toString() {
        return get_class($this) . '('.dechex(crc32(spl_object_hash($this))).')';
    }

    /**
     * @return CommandExecutor
     */
    public function commandExecutor()
    {
        return $this->commandExecutor;
    }
}