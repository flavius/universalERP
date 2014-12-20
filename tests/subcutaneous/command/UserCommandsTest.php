<?php
/**
 * Copyright (c) 2014 Flavius Aspra <flavius.as@gmail.com>
 *
 * @license http://mozilla.org/MPL/2.0/ Mozilla Public License v.2.0
 */

use Application\Common\World\Testing;
use Common\User\Command\Register;
use Common\User\Event\Registered;
use Common\World\World;

class UserCommandsTest extends \TestFramework\TestCase
{
    /**
     * @test
     */
    public function proper_creation_in_environment()
    {
        $environment = new Testing();
        $world = new World($environment);
        $registerUser = new Register('foo', 'bar');

        $this->assertCount(1, $world->eventHub()->newEvents());

        $result = $world->executeCommand($registerUser);

        $this->assertCount(4, $world->eventHub()->newEvents());
        $this->assertTrueCommandResult($result);

        $searchedEvent = new Registered('foo');
        $this->assertEventHubContainsEvent($world->eventHub(), $searchedEvent);
    }
}