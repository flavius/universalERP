<?php
/**
 * Copyright (c) 2014 Flavius Aspra <flavius.as@gmail.com>
 *
 * @license http://mozilla.org/MPL/2.0/ Mozilla Public License v.2.0
 */

namespace Application\Common\World;


use Common\World\Event;

class EventHub implements \Common\World\EventHub
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
    public function trigger(Event $event) {
        $this->events[] = $event;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return get_class($this) . "(".dechex(crc32(spl_object_hash($this))).") [newEvents: ".count($this->events)."]";
    }
}