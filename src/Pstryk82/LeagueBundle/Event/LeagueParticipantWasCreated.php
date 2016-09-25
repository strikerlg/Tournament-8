<?php

namespace Pstryk82\LeagueBundle\Event;

class LeagueParticipantWasCreated extends AbstractEvent
{
    /**
     * @var string
     */
    private $teamId;

    /**
     * @var string
     */
    private $leagueId;
    
    /**
     * @param string $aggregateId
     * @param string $teamId
     * @param string $leagueId
     */
    public function __construct($aggregateId, $teamId, $leagueId, $happenedAt)
    {
        $this->aggregateId = $aggregateId;
        $this->teamId = $teamId;
        $this->leagueId = $leagueId;
        $this->happenedAt = $happenedAt;
    }

    public function getTeamId()
    {
        return $this->teamId;
    }

    public function getLeagueId()
    {
        return $this->leagueId;
    }
}
