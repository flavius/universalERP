<?php
/**
 * Copyright (c) 2014 Flavius Aspra <flavius.as@gmail.com>
 *
 * @license http://mozilla.org/MPL/2.0/ Mozilla Public License v.2.0
 */

namespace Application\Common\World;


use Common\World\Event;
use Common\World\StorageDriver;

class EventHub implements \Common\World\EventHub
{
    /**
     * @var Event[]
     */
    private $events = [];

    /**
     * @var StorageDriver
     */
    private $storageDriver;

    /**
     * @return Event[]
     */
    public function newEvents()
    {
        return $this->events;
    }

    /**
     * @return Event[]
     */
    public function events()
    {
        return $this->storageDriver->newEvents();
    }

    /**
     * @param Event $event
     */
    public function trigger(Event $event) {
        $this->events[] = $event;
        $this->storageDriver->storeEvent($event);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return get_class($this) . "(".dechex(crc32(spl_object_hash($this))).") [newEvents: ".count($this->events)."]";
    }

    public function storageDriver()
    {
        return $this->storageDriver;
    }

    /**
     * @param StorageDriver $storage
     */
    public function setStorageDriver(StorageDriver $storage)
    {
        $this->storageDriver = $storage;
    }
}