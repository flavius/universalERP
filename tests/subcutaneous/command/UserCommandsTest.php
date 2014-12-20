<?php
/**
 * Copyright (c) 2014 Flavius Aspra <flavius.as@gmail.com>
 *
 * @license http://mozilla.org/MPL/2.0/ Mozilla Public License v.2.0
 */

use Common\User\Command\Register;
use Common\User\Event\Registered;
use Common\World\World;
use TestFramework\TestCase;

class UserCommandsTest extends TestCase
{
    /**
     * @test
     */
    public function proper_creation_in_environment()
    {
        $environment = $this->getNewWorldEnvironment();
        $world = new World($environment);
        $registerUser = new Register('foo', 'bar');

        $this->assertCount(1, $world->eventHub()->newEvents());

        $result = $world->commandExecutor()->execute($registerUser);

        $this->assertCount(4, $world->eventHub()->newEvents());
        $this->assertTrueCommandResult($result);

        $searchedEvent = new Registered('foo');
        $this->assertEventHubContainsEvent($world->eventHub(), $searchedEvent);
    }

    /**
     * @todo test
     */
    public function proper_persistence_of_new_user()
    {
        $environment = $this->getNewWorldEnvironment();
        $world = new World($environment);
        $registerUser = new Register('foo', 'bar');

        $world->commandExecutor()->execute($registerUser);
    }
}