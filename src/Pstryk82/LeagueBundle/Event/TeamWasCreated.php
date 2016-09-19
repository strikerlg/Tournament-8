<?php

namespace Pstryk82\LeagueBundle\Event;

class TeamWasCreated extends AbstractEvent
{
    /**
     * @var string
     */
    private $teamId;

    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $rank;

    /**
     * @var string
     */
    private $stadium;

    public function __construct($teamId, $name, $rank, $stadium, \DateTime $happenedAt)
    {
        $this->teamId = $teamId;
        $this->name = $name;
        $this->rank = $rank;
        $this->stadium = $stadium;
        $this->happenedAt = $happenedAt;
    }

    public function getTeamId()
    {
        return $this->teamId;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getRank()
    {
        return $this->rank;
    }

    public function getStadium()
    {
        return $this->stadium;
    }
}
