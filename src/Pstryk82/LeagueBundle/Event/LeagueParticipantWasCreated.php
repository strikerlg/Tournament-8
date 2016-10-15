<?php

namespace Pstryk82\LeagueBundle\Event;

use Pstryk82\LeagueBundle\Domain\Aggregate\Team;

class LeagueParticipantWasCreated extends AbstractEvent
{
    /**
     * @var Team
     */
    private $team;

    /**
     * @var string
     */
    private $leagueId;
    
    /**
     * @param string $aggregateId
     * @param Team $team
     * @param string $leagueId
     */
    public function __construct($aggregateId, Team $team, $leagueId, $happenedAt)
    {
        $this->aggregateId = $aggregateId;
        $this->team = $team;
        $this->leagueId = $leagueId;
        $this->happenedAt = $happenedAt;
    }

    public function getTeam()
    {
        return $this->team;
    }

    public function getLeagueId()
    {
        return $this->leagueId;
    }
}
