<?php

namespace Pstryk82\LeagueBundle\Event;

class LeagueWasFinished extends AbstractEvent
{
    private $leagueId;

    /**
     * @param string $leagueId
     * @param \DateTime $happenedAt
     */
    public function __construct($leagueId, $happenedAt)
    {
        $this->leagueId = $leagueId;
        $this->happenedAt = $happenedAt;
    }

    public function getLeagueId()
    {
        return $this->leagueId;
    }
}
