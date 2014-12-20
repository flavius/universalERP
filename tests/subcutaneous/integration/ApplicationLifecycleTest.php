<?php
/**
 * Copyright (c) 2014 Flavius Aspra <flavius.as@gmail.com>
 *
 * @license http://mozilla.org/MPL/2.0/ Mozilla Public License v.2.0
 */

use Application\Common\World\Testing;
use Common\World\Event\Adopted;
use Common\World\World;

class ApplicationLifecycleTest extends \TestFramework\TestCase
{
    /**
     * @test
     */
    public function proper_world_creation_in_testing_environment()
    {
        /** @var PHPUnit_Framework_MockObject_MockObject|Common\World\Environment $environment */
        $environment = new Testing();
        $world = new World($environment);
        $this->assertSame($environment, $world->environment(), "The environment has not properly adopted the world");
    }

    /**
     * @test
     */
    public function proper_world_eventhub_lifecycle_events()
    {
        /** @var PHPUnit_Framework_MockObject_MockObject|Common\World\Environment $environment */
        $environment = new Testing();
        $world = new World($environment);
        $this->assertCount(1, $world->eventHub()->newEvents());
        $searchedEvent = new Adopted($world, $environment);
        $this->assertEventHubContainsEvent($world->eventHub(), $searchedEvent);
    }
}