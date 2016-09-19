<?php

namespace Pstryk82\LeagueBundle\Event;

class TeamGainedRankPoints extends AbstractEvent
{
    /**
     * @var string
     */
    private $teamId;
    
    /**
     * @var int
     */
    private $numberOfAddedRankPoints;
    
    public function __construct($teamId, $numberOfAddedRankPoints, \DateTime $happenedAt)
    {
        $this->teamId = $teamId;
        $this->numberOfAddedRankPoints = $numberOfAddedRankPoints;
        $this->happenedAt = $happenedAt;
    }

    public function getTeamId()
    {
        return $this->teamId;
    }

    public function getNumberOfAddedRankPoints()
    {
        return $this->numberOfAddedRankPoints;
    }
}
