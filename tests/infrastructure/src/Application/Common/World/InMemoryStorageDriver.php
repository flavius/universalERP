<?php
/**
 * Copyright (c) 2014 Flavius Aspra <flavius.as@gmail.com>
 *
 * @license http://mozilla.org/MPL/2.0/ Mozilla Public License v.2.0
 */

namespace Application\Common\World;


use Common\World\Event;
use Common\World\StorageDriver;

class InMemoryStorageDriver implements StorageDriver
{

    /**
     * @var Event[]
     */
    private $events = [];

    /**
     * @return Event[]
     */
    public function newEvents()
    {
        return $this->events;
    }

    /**
     * @param Event $event
     */
    public function storeEvent(Event $event) {
        $this->events[] = $event;
    }

}