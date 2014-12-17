<?php
/**
 * Copyright (c) 2014 Flavius Aspra <flavius.as@gmail.com>
 *
 * @license http://mozilla.org/MPL/2.0/ Mozilla Public License v.2.0
 */

namespace Common\World\Event;


use Common\World\Command;
use Common\World\Event;

class CommandStarted implements Event
{

    /**
     * @var Command
     */
    private $command;

    /**
     * @param Command $command
     */
    public function __construct(Command $command)
    {
        $this->command = $command;
    }

    /**
     * @param Event $other
     * @return bool
     */
    public function equals(Event $other)
    {
        if (!$other instanceof $this) {
            return false;
        }
        /** @var CommandStarted $other */
        return $this->command === $other->command;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return get_class($this) . "(".dechex(crc32(spl_object_hash($this))).") {command: {$this->command}}";
    }
}