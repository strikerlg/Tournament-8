<?php

namespace Pstryk82\LeagueBundle\Tests\Domain\Aggregate;

use Pstryk82\LeagueBundle\Domain\Aggregate\League;
use Pstryk82\LeagueBundle\Domain\Aggregate\LeagueParticipant;
use Pstryk82\LeagueBundle\Domain\Aggregate\Team;
use Pstryk82\LeagueBundle\Event\TeamGainedRankPoints;
use Pstryk82\LeagueBundle\Event\TeamWasCreated;

class TeamTest extends AbstractDomainObjectTest
{
    /**
     * @var Team
     */
    private $team;

    public function setUp()
    {
        $this->team = new Team('team name');
    }

    public function tearDown()
    {
        unset($this->team);
    }

    public function testCreate()
    {
        $this->team = Team::create('Manchester United', 100432, 'Old Trafford');

        $this->assertEventOnDomainObjectWasCreated($this->team, TeamWasCreated::class);
    }

    public function testRegisterInLeague()
    {
        $leagueMock = $this->getMockBuilder(League::class)->disableOriginalConstructor()->getMock();
        $leagueMock->method('getAggregateId')->willReturn('league name');

        $participant = $this->team->registerInLeague($leagueMock);

        $this->assertInstanceOf(LeagueParticipant::class, $participant);
    }

    public function testRecordRankPoints()
    {
        $this->team->addRank(4);
        $this->team->recordRankPoints(7);

        $this->assertEventOnDomainObjectWasCreated($this->team, TeamGainedRankPoints::class);
    }
}
