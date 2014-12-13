<?php
/**
 * Copyright (c) 2014 Flavius Aspra <flavius.as@gmail.com>
 *
 * @license http://mozilla.org/MPL/2.0/ Mozilla Public License v.2.0
 */

namespace TestFramework\Constraint;


use Common\World\Result\Boolean;

class TrueCommandResult extends \PHPUnit_Framework_Constraint
{
    /**
     * @param mixed $other
     * @return bool
     */
    public function matches(Boolean $other)
    {
        return $other->getBooleanValue();
    }

    /**
     * Returns a string representation of the object.
     *
     * @return string
     */
    public function toString()
    {
        return 'is a true Result';
    }
}