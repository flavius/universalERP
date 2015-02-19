<?php

namespace TestFramework;

use Application\Common\World\Testing;
use Common\World\Event;
use Common\World\EventHub;
use Common\World\Result;

class TestCase extends \PHPUnit_Framework_TestCase
{

    /**
     * @return \Common\World\Environment
     */
    public function getNewWorldEnvironment()
    {
        return new Testing();
    }

    /**
     * @param Result $result
     * @param string $message
     */
    public function assertTrueCommandResult(Result $result, $message = '')
    {
        $this->assertThat($result, new Constraint\TrueCommandResult(), $message);
    }

    /**
     * @param Result $result
     * @param string $message
     */
    public function assertFalseCommandResult(Result $result, $message = '')
    {
        $this->assertThat($result, new Constraint\FalseCommandResult(), $message);
    }

    /**
     * @param EventHub $eventHub
     * @param Event $searchedEvent
     * @param string $message
     */
    public function assertEventHubContainsEvent(EventHub $eventHub, Event $searchedEvent, $message = '')
    {
        $this->assertThat([$eventHub, $searchedEvent], new Constraint\EventHubContainsEvent(), $message);
    }

}