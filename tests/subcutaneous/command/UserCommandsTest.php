<?php
/**
 * Copyright (c) 2014 Flavius Aspra <flavius.as@gmail.com>
 *
 * @license http://mozilla.org/MPL/2.0/ Mozilla Public License v.2.0
 */

use Common\User\Command\Register;
use Common\User\Event\Registered;
use Common\User\Query\FindUserById;
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
        $executor = $world->commandExecutor();

        $result = $world->commandExecutor()->execute($registerUser);

        //$world->eventHub()->newEvents() Events:
        //  Common\World\Event\Adopted
        //  Common\World\Event\CommandStarted
        //  Common\User\Event\Registered
        //  Common\World\Event\CommandFinished
        $this->assertCount(4, $world->eventHub()->newEvents());
        $this->assertTrueCommandResult($result);

        $searchedEvent = new Registered('foo');
        $this->assertEventHubContainsEvent($world->eventHub(), $searchedEvent);
    }

    /**
     * @test
     */
    public function proper_creation_of_new_user_in_memory()
    {
        $environment = $this->getNewWorldEnvironment();
        $world = new World($environment);
        $registerUser = new Register('foo', 'bar');

        $world->commandExecutor()->execute($registerUser);

        $registeredQuery = new FindUserById('foo');
        /** @var \Common\User\User $user */
        $user = $world->queryExecutor()->execute($registeredQuery);
        $this->assertInstanceOf('Common\User\User', $user);
        $this->assertEquals('foo', $user->identification());
    }

    /**
     * @test
     */
    public function proper_persistence_of_new_user()
    {
        $environment = $this->getNewWorldEnvironment();
        $world1 = new World($environment);
        $registerUser = new Register('foo', 'bar');

        $world1->commandExecutor()->execute($registerUser);

        $storage = $world1->eventHub()->storageDriver();

        $world2 = new World($this->getNewWorldEnvironment());
        $world2->eventHub()->setStorageDriver($storage);

        $registeredQuery = new FindUserById('foo');
        /** @var \Common\User\User $user */
        $user = $world2->queryExecutor()->execute($registeredQuery);
        $this->assertInstanceOf('Common\User\User', $user);
        $this->assertEquals('foo', $user->identification());
    }

    /**
     * @test
     */
    public function not_found_user()
    {
        $environment = $this->getNewWorldEnvironment();
        $world = new World($environment);
        $registeredQuery = new FindUserById('foo');
        $user = $world->queryExecutor()->execute($registeredQuery);
        $this->assertNull($user);
    }
}