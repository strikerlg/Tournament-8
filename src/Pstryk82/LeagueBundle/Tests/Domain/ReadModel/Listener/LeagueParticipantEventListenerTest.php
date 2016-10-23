<?php

namespace Pstryk82\LeagueBundle\Tests\Domain\ReadModel\Listener;

use Pstryk82\LeagueBundle\Domain\Aggregate\Competition;
use Pstryk82\LeagueBundle\Domain\Aggregate\Team;
use Pstryk82\LeagueBundle\Domain\ReadModel\Listener\LeagueParticipantEventListener;
use Pstryk82\LeagueBundle\Domain\ReadModel\Projection\CompetitionProjection;
use Pstryk82\LeagueBundle\Domain\ReadModel\Projection\LeagueParticipantProjection;
use Pstryk82\LeagueBundle\Domain\ReadModel\Projection\LeagueProjection;
use Pstryk82\LeagueBundle\Domain\ReadModel\Projection\TeamProjection;
use Pstryk82\LeagueBundle\Event\LeagueParticipantWasCreated;

class LeagueParticipantEventListenerTest extends AbstractEventListnerTest
{
    /**
     * @var LeagueParticipantEventListener
     */
    private $listener;


    public function setup()
    {
        parent::setup();
        $this->listener = new LeagueParticipantEventListener($this->eventBusMock, $this->projectionStorageMock);
    }

    public function tearDown()
    {
        unset ($this->listener);
        parent::tearDown();
    }

    public function testOnLeagueParticipantWasCreated()
    {
        $teamProjection = new TeamProjection('teamId');
        $this->assertProjectionFound($teamProjection, TeamProjection::class, 0);
        $team = $this->getMockBuilder(Team::class)->disableOriginalConstructor()->getMock();
        $team->method('getAggregateId')->willReturn('teamId');
        $event = new LeagueParticipantWasCreated(
            'participant', $team, 'leagueId', $this->now
        );

        $competitionProjection = new LeagueProjection('leagueId');
        $this->assertProjectionFound($competitionProjection, LeagueProjection::class, 1);
        $competition = $this->getMockBuilder(Competition::class)->disableOriginalConstructor()->getMock();
        $competition->method('getAggregateId')->willReturn('leagueId');

        $leagueParticipant = new LeagueParticipantProjection('participant');
        $leagueParticipant->setTeam($teamProjection)->setCompetition($competitionProjection);

        $this->assertProjectionSaved($leagueParticipant, 2);

        $this->listener->when($event);
    }
}
