<?php

namespace Pstryk82\LeagueBundle\Tests\Domain\ReadModel\Listener;

use Pstryk82\LeagueBundle\EventEngine\EventBus;
use Pstryk82\LeagueBundle\Storage\ProjectionStorage;

abstract class AbstractEventListnerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var EventBus
     */
    protected $eventBusMock;

    /**
     * @var ProjectionStorage
     */
    protected $projectionStorageMock;

    /**
     * @var \DateTime
     */
    protected $now;

    public function setup()
    {
        $this->now = new \DateTime();
        $this->eventBusMock = $this->getMockBuilder(EventBus::class)->disableOriginalConstructor()->getMock();
        $this->projectionStorageMock = $this->getMockBuilder(ProjectionStorage::class)
            ->disableOriginalConstructor()->getMock();
    }

    public function tearDown()
    {
        unset($this->eventBusMock, $this->projectionStorageMock, $this->now);
    }

    protected function assertProjectionSaved($projection, $callNo = 0)
    {
        $this->projectionStorageMock
            ->expects($this->at($callNo))
            ->method('save')
            ->with($projection);
    }

    protected function assertProjectionFound($projection, $projectionClass, $callNo = 0)
    {
        $this->projectionStorageMock
            ->expects($this->at($callNo))
            ->method('find')
            ->with($projection->getId(), $projectionClass)
            ->willReturn($projection);
    }
}
