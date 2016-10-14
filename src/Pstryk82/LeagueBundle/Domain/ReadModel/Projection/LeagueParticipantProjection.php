<?php

namespace Pstryk82\LeagueBundle\Domain\ReadModel\Projection;

class LeagueParticipantProjection extends AbstractParticipantProjection
{
    /**
     * @var int
     */
    private $points = 0;

    /**
     * @var int
     */
    private $goalsFor = 0;

    /**
     * @var int
     */
    private $goalsAgainst = 0;

    /**
     * @var int
     */
    private $goalDifference = 0;

    /**
     * @var int
     */
    private $gamesPlayed = 0;

    /**
     * @param int $points
     *
     * @return Participant
     */
    public function addPoints($points)
    {
        $this->points += $points;

        return $this;
    }

    /**
     * Get points.
     *
     * @return int
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * @param int $goalsFor
     *
     * @return Participant
     */
    public function addGoalsFor($goalsFor)
    {
        $this->goalsFor += $goalsFor;

        return $this;
    }

    /**
     * Get goalsFor.
     *
     * @return int
     */
    public function getGoalsFor()
    {
        return $this->goalsFor;
    }

    /**
     * @param int $goalsAgainst
     *
     * @return Participant
     */
    public function addGoalsAgainst($goalsAgainst)
    {
        $this->goalsAgainst += $goalsAgainst;

        return $this;
    }

    /**
     * Get goalsAgains.
     *
     * @return int
     */
    public function getGoalsAgainst()
    {
        return $this->goalsAgainst;
    }

    /**
     * @param int $goalDifference
     *
     * @return Participant
     */
    public function addGoalDifference($goalDifference)
    {
        $this->goalDifference += $goalDifference;

        return $this;
    }

    /**
     * Get goalDifference.
     *
     * @return int
     */
    public function getGoalDifference()
    {
        return $this->goalDifference;
    }

    /**
     * Set gamesPlayed.
     *
     * @param int $gamesPlayed
     *
     * @return Participant
     */
    public function addGamesPlayed($gamesPlayed)
    {
        $this->gamesPlayed += $gamesPlayed;

        return $this;
    }

    /**
     * Get gamesPlayed.
     *
     * @return int
     */
    public function getGamesPlayed()
    {
        return $this->gamesPlayed;
    }

    /**
     * @return ArrayCollection
     */
    public function getGames()
    {
        return $this->games;
    }
}
