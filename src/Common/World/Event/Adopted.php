<?php
/**
 * Copyright (c) 2014 Flavius Aspra <flavius.as@gmail.com>
 *
 * @license http://mozilla.org/MPL/2.0/ Mozilla Public License v.2.0
 */

namespace Common\World\Event;


use Common\World\Environment;
use Common\World\Event;
use Common\World\World;

class Adopted implements Event
{

    /**
     * @var World
     */
    private $world;
    /**
     * @var Environment
     */
    private $environment;

    public function __construct(World $world, Environment $environment) {

        $this->world = $world;
        $this->environment = $environment;
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
        return $this->world === $other->world && $this->environment === $other->environment;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return get_class($this) . "(".dechex(crc32(spl_object_hash($this))).") {world: {$this->world}, environment: {$this->environment}";
    }
}