<?php

namespace Pstryk82\LeagueBundle\Tests\EventEngine;

use Pstryk82\LeagueBundle\Domain\Aggregate\League;
use Pstryk82\LeagueBundle\Domain\ReadModel\Listener\LeagueParticipantEventListener;
use Pstryk82\LeagueBundle\Event\LeagueWasFinished;
use Pstryk82\LeagueBundle\Event\ParticipantHasDrawn;
use Pstryk82\LeagueBundle\EventEngine\EventBus;

class EventBusTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var EventBus
     */
    private $eventBus;

    public function setUp()
    {
        $this->eventBus = new EventBus();
    }

    public function tearDown()
    {
        unset($this->eventBus);
    }

    public function testDispatchNoListeners()
    {
        $events = [
            new ParticipantHasDrawn(new League('league'), 'participant', 1),
            new LeagueWasFinished('league', new \DateTime()),
            new \stdClass('something'),
        ];

        $listener = $this->getMockBuilder(LeagueParticipantEventListener::class)
            ->disableOriginalConstructor()->getMock();
        $listener->expects($this->never())->method('when');

        $this->eventBus->dispatch($events);
    }

    public function testDispatchWIthListener()
    {
        $events = [
            new ParticipantHasDrawn(new League('league'), 'participant', 1),
            new LeagueWasFinished('league', new \DateTime()),
        ];
        $listener = $this->getMockBuilder(LeagueParticipantEventListener::class)
            ->disableOriginalConstructor()->getMock();
        $listener->expects($this->exactly(2))->method('when');
        $this->eventBus->registerListener($listener);

        $this->eventBus->dispatch($events);
    }
}
