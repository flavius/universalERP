<?php

namespace PHPUnit\Framework;

use Common\World\Result;

class TestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * @param Result $result
     * @param string $message
     */
    public function assertTrueCommandResult(Result $result, $message = '')
    {
        /** @var \Common\World\Result\Boolean $result */
        $this->assertInstanceOf('Common\World\Result\Boolean', $result, $message);
        $this->assertTrue($result->getBooleanValue(), $message);
    }

}