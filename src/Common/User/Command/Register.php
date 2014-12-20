<?php
/**
 * Copyright (c) 2014 Flavius Aspra <flavius.as@gmail.com>
 *
 * @license http://mozilla.org/MPL/2.0/ Mozilla Public License v.2.0
 */

namespace Common\User\Command;


use Common\World\Command;

class Register implements Command
{
    /**
     * @var string
     */
    private $useridentification;
    /**
     * @var string
     */
    private $password;

    /**
     * @param string $useridentification
     * @param string $password
     */
    public function __construct($useridentification, $password)
    {
        $this->useridentification = $useridentification;
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return get_class($this) . "(" . dechex(crc32(spl_object_hash($this))) . ")";
    }

    /**
     * @return array
     */
    public function asDictionary()
    {
        return ['useridentification' => $this->useridentification];
    }
}