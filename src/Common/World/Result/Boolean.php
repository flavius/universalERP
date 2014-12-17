<?php
/**
 * Copyright (c) 2014 Flavius Aspra <flavius.as@gmail.com>
 *
 * @license http://mozilla.org/MPL/2.0/ Mozilla Public License v.2.0
 */

namespace Common\World\Result;

use Common\World\Result;

class Boolean implements Result
{
    /**
     * @var bool
     */
    private $value;

    /**
     * @param bool $value
     */
    public function __construct($value)
    {
        if(!is_bool($value)) {
            throw new \UnexpectedValueException("Unexpected value: '$e'");
        }
        $this->value = $value;
    }

    /**
     * @return bool
     */
    public function getBooleanValue()
    {
        return $this->value;
    }
}