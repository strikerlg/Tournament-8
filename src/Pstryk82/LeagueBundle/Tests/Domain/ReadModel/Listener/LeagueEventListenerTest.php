<?php

namespace Pstryk82\LeagueBundle\Tests\Domain\ReadModel\Listener;

use Pstryk82\LeagueBundle\Domain\Aggregate\LeagueParticipant;
use Pstryk82\LeagueBundle\Domain\ReadModel\Listener\LeagueEventListener;
use Pstryk82\LeagueBundle\Domain\ReadModel\Projection\LeagueParticipantProjection;
use Pstryk82\LeagueBundle\Domain\ReadModel\Projection\LeagueProjection;
use Pstryk82\LeagueBundle\Event\LeagueWasCreated;
use Pstryk82\LeagueBundle\Event\LeagueWasFinished;
use Pstryk82\LeagueBundle\Event\ParticipantWasRegisteredInCompetition;

class LeagueEventListenerTest extends AbstractEventListnerTest
{
    /**
     * @var LeagueEventListener
     */
    private $listener;

    public function setUp()
    {
        parent::setUp();
        $this->listener = new LeagueEventListener($this->eventBusMock, $this->projectionStorageMock);
    }

    public function tearDown()
    {
        unset($this->listener);
        parent::tearDown();
    }

    public function testOnLeagueWasCreated()
    {
        $event = new LeagueWasCreated(
            'league', 'league name', '2016', 7, 3, -1, 3, 1, 0, 4, $this->now
        );
        $leagueProjection = new LeagueProjection('league');
        $leagueProjection
            ->setName('league name')
            ->setSeason('2016');
        $this->assertProjectionSaved($leagueProjection);

        $this->listener->when($event);
    }

    public function testOnLeagueWasFinished()
    {
        $event = new LeagueWasFinished('league', $this->now);
        $leagueProjection = new LeagueProjection('league');

        $this->assertProjectionFound($leagueProjection, LeagueProjection::class, 0);
        $this->assertProjectionSaved($leagueProjection, 1);

        $this->listener->when($event);
        $this->assertTrue($leagueProjection->getFinished());
    }

    public function testOnParticipantWasRegisteredInCompetition()
    {
        $participant = new LeagueParticipant('participant');
        $event = new ParticipantWasRegisteredInCompetition($participant, 'leagueId');

        $leagueProjection = new LeagueProjection('leagueId');
        $this->assertProjectionFound($leagueProjection, LeagueProjection::class, 0);

        $participantProjection = new LeagueParticipantProjection('participant');
        $this->assertProjectionFound($participantProjection, LeagueParticipantProjection::class, 1);

        $this->assertProjectionSaved($leagueProjection, 2);

        $this->listener->when($event);
        $this->assertCount(1, $leagueProjection->getParticipants());
    }
}
