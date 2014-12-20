<?php
/**
 * Copyright (c) 2014 Flavius Aspra <flavius.as@gmail.com>
 *
 * @license http://mozilla.org/MPL/2.0/ Mozilla Public License v.2.0
 */

namespace Common\World;

use TestFramework\TestCase;

class WorldTest extends TestCase
{
    /**
     * @test
     * @uses   \Common\World\World::setEventHub
     * @covers \Common\World\World::__construct
     */
    public function construction()
    {
        /** @var \Common\World\Environment $environmentStub|\PHPUnit_Framework_MockObject_MockObject */
        $environmentStub = $this->getMockBuilder('Common\World\Environment')->getMock();
        /** @var \Common\World\EventHub|\PHPUnit_Framework_MockObject_MockObject $eventHubStub */
        $eventHubStub = $this->getMock('Common\World\EventHub');

        $environmentStub->expects($this->once())
            ->method('adoptWorld')
            ->will($this->returnCallback(function (World $world) use ($eventHubStub) {
                $world->setEventHub($eventHubStub);
                return true;
            }));
        $eventHubStub->expects($this->once())
            ->method('trigger')
            ->withAnyParameters();
        $this->assertInstanceOf('Common\World\World', new World($environmentStub));
    }

    /**
     * @test
     * @covers \Common\World\World::__construct
     * @expectedException \RuntimeException
     * @expectedExceptionMessage the environment has rejected this world for incompatibility reasons
     */
    public function construction_rejected()
    {
        /** @var \Common\World\Environment $environmentStub */
        $environmentStub = $this->getMockBuilder('Common\World\Environment')->getMock();
        $environmentStub->expects($this->once())
            ->method('adoptWorld')
            ->will($this->returnValue(false));
        $this->assertInstanceOf('Common\World\World', new World($environmentStub));
    }
}