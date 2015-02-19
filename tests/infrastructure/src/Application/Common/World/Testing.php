<?php

namespace Application\Common\World;

use Common\User\Command\Register;
use Common\User\Service;
use Common\World\CommandExecutor;
use Common\World\Environment;
use Common\World\QueryExecutor;
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
        $world->setQueryExecutor($this->newQueryExecutor());
        foreach($this->importedSubsystems() as $environment) {
            $this->importEnvironment($environment);
        }
        return true;
    }

    protected function newEventHub()
    {
        $eventHub = new EventHub();

        $eventHub->setStorageDriver($this->newEventHubStorageDriver());
        return $eventHub;
    }

    protected function newCommandExecutor() {
        return new CommandExecutor($this->world->eventHub());
    }

    public function __toString() {
        return get_class($this) . "(".dechex(crc32(spl_object_hash($this))).")";
    }

    /**
     * @param Environment $other
     */
    public function importEnvironment(Environment $other)
    {
        $other->adoptWorld($this->world);
    }

    /**
     * @return \Common\World\Environment[]
     */
    private function importedSubsystems() {
        return [
            new \Application\Common\User\Testing(),
        ];
    }

    /**
     * @return QueryExecutor
     */
    private function newQueryExecutor()
    {
        return new QueryExecutor($this->world->eventHub());
    }

    private function newEventHubStorageDriver()
    {
        return new InMemoryStorageDriver();
    }
}