<?php
/**
 * Copyright (c) 2014 Flavius Aspra <flavius.as@gmail.com>
 *
 * @license http://mozilla.org/MPL/2.0/ Mozilla Public License v.2.0
 */

namespace Common\World\Event;


use Common\World\Command;
use Common\World\Event;
use Common\World\Result;

class CommandFinished implements Event {

    /**
     * @var Command
     */
    private $command;
    /**
     * @var Result
     */
    private $result;

    /**
     * @param Command $command
     * @param Result $result
     */
    public function __construct(Command $command, Result $result)
    {
        $this->command = $command;
        $this->result = $result;
    }

    /**
     * @param Event $other
     * @return bool
     *
     * @todo use each object's equals() method
     */
    public function equals(Event $other)
    {
        if (!$other instanceof $this) {
            return false;
        }
        /** @var CommandFinished $other */
        return $this->command === $other->command && $this->result === $other->result;
    }
}