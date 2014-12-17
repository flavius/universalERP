<?php
/**
 * Copyright (c) 2014 Flavius Aspra <flavius.as@gmail.com>
 *
 * @license http://mozilla.org/MPL/2.0/ Mozilla Public License v.2.0
 */

namespace TestFramework\Constraint;

use TestFramework\Exporter\ObjectToString;

class EventHubContainsEvent extends \PHPUnit_Framework_Constraint
{

    /**
     * @var \Common\World\Event
     */
    private $event;
    /**
     * @var \Common\World\EventHub
     */
    private $eventHub;

    public function __construct()
    {
        parent::__construct();
        $this->exporter = new ObjectToString();
    }

    /**
     * @param mixed $other
     * @return bool
     */
    public function matches($other)
    {
        /**
         * @var \Common\World\EventHub $eventHub
         * @var \Common\World\Event $searchedEvent
         */
        list($eventHub, $searchedEvent) = $other;
        $this->event = $searchedEvent;
        $this->eventHub = $eventHub;
        $found = false;
        foreach ($eventHub->newEvents() as $event) {
            if ($searchedEvent->equals($event)) {
                $found = true;
                break;
            }
        }

        return $found;
    }

    protected function failureDescription($other)
    {
        return $this->exporter->export($this->eventHub) . ' ' . $this->toString();
    }

    /**
     * Returns a string representation of the object.
     *
     * @return string
     */
    public function toString()
    {
        return "contains {$this->event}";
    }
} 