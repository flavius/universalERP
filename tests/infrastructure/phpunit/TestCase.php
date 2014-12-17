<?php

namespace TestFramework;

use Common\World\Event;
use Common\World\EventHub;
use Common\World\Result;

class TestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * @param Result $result
     * @param string $message
     */
    public function assertTrueCommandResult(Result $result, $message = '')
    {
        $this->assertThat($result, new Constraint\TrueCommandResult(), $message);
    }

    public function assertEventHubContainsEvent(EventHub $eventHub, Event $searchedEvent, $message = '')
    {
        $this->assertThat([$eventHub, $searchedEvent], new Constraint\EventHubContainsEvent(), $message);
    }

}