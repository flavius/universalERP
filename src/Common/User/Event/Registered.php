<?php
/**
 * Copyright (c) 2014 Flavius Aspra <flavius.as@gmail.com>
 *
 * @license http://mozilla.org/MPL/2.0/ Mozilla Public License v.2.0
 */

namespace Common\User\Event;

use Common\World\Event;

class Registered implements Event
{
    /**
     * @var string
     */
    private $identifier;

    /**
     * @param string $identifier
     */
    public function __construct($identifier)
    {
        $this->identifier = $identifier;
    }

    /**
     * @return string
     */
    public function identifier() {
        return $this->identifier;
    }

    /**
     * @param Event $other
     * @return bool
     */
    public function equals(Event $other)
    {
        if(!$other instanceof $this) {
            return false;
        }
        return $this->identifier === $other->identifier;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return get_class($this) . "(".dechex(crc32(spl_object_hash($this))).") {identifier: {$this->identifier}}";
    }
}