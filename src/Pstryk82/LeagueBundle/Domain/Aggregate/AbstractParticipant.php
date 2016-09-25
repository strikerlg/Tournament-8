<?php

namespace Pstryk82\LeagueBundle\Domain\Aggregate;

abstract class AbstractParticipant implements AggregateInterface
{
    /**
     * @var int
     */
    private $aggregateId;

    /**
     * @var string
     */
    private $teamId;

    /**
     * @var string
     */
    private $competitionId;

    /**
     * @var array
     */
    private $games = [];

    public function __construct($aggregateId)
    {
        $this->aggregateId = $aggregateId;
    }
    
    public function getAggregateId()
    {
        return $this->aggregateId;
    }

    public function getTeamId()
    {
        return $this->teamId;
    }

    public function setTeamId($teamId)
    {
        $this->teamId = $teamId;
        return $this;
    }

    public function getCompetitionId()
    {
        return $this->competitionId;
    }

    public function setCompetitionId($competitionId)
    {
        $this->competitionId = $competitionId;
        return $this;
    }

    /**
     * @param Game $game
     *
     * @return $this
     */
    public function addGame(Game $game)
    {
        $this->games->add($game);

        return $this;
    }

    /**
     * @param Game $game
     *
     * @return $this
     */
    public function removeGame(Game $game)
    {
        $this->games->removeElement($game);

        return $this;
    }
}
