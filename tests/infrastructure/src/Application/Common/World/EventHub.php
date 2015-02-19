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
     * @var StorageDriver
     */
    private $storageDriver;

    /**
     * @return Event[]
     */
    public function newEvents()
    {
        return $this->storageDriver->newEvents();
    }

    /**
     * @param Event $event
     */
    public function trigger(Event $event) {
        $this->storageDriver->storeEvent($event);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return get_class($this) . "(".dechex(crc32(spl_object_hash($this))).") [storageDriver: ".$this->storageDriver."]";
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