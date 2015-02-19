<?php
/**
 * Copyright (c) 2014 Flavius Aspra <flavius.as@gmail.com>
 *
 * @license http://mozilla.org/MPL/2.0/ Mozilla Public License v.2.0
 */

namespace Common\User;


use Common\World\Event;

class User {

    /**
     * @var string
     */
    private $identifier;

    public function __construct() {

    }

    public function apply(Event $ev) {
        $class = get_class($ev);
        switch($class) {
            case 'Common\User\Event\Registered':
                /** @var $ev \Common\User\Event\Registered */
                $this->identifier = $ev->identifier();
                break;
        }
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return get_class($this) . "(".dechex(crc32(spl_object_hash($this))).") {identifier: {$this->identifier}}";
    }

    /**
     * @return string
     */
    public function identification()
    {
        return $this->identifier;
    }
}