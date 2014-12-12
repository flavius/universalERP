<?php
/**
 * Copyright (c) 2014 Flavius Aspra <flavius.as@gmail.com>
 *
 * @license http://mozilla.org/MPL/2.0/ Mozilla Public License v.2.0
 */

class UserCommandsTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function proper_creation_in_environment()
    {
        $environment = new \Application\Environment\Testing();
        $world = new \Common\World\World($environment);
        $registerUser = new \Common\User\Command\Register('foo', 'bar');

        $result = $world->executeCommand($registerUser);

        $this->assertTrueCommandResult($result);
    }
}