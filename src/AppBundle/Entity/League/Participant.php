<?php

namespace AppBundle\Entity\League;

use AppBundle\Entity\AbstractParticipant;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Participant
 */
class Participant extends AbstractParticipant
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
     * Set points
     *
     * @param integer $points
     *
     * @return Participant
     */
    public function setPoints($points)
    {
        $this->points = $points;

        return $this;
    }

    /**
     * Get points
     *
     * @return int
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * Set goalsFor
     *
     * @param integer $goalsFor
     *
     * @return Participant
     */
    public function setGoalsFor($goalsFor)
    {
        $this->goalsFor = $goalsFor;

        return $this;
    }

    /**
     * Get goalsFor
     *
     * @return int
     */
    public function getGoalsFor()
    {
        return $this->goalsFor;
    }

    /**
     * Set goalsAgains
     *
     * @param integer $goalsAgainst
     *
     * @return Participant
     */
    public function setGoalsAgainst($goalsAgainst)
    {
        $this->goalsAgainst = $goalsAgainst;

        return $this;
    }

    /**
     * Get goalsAgains
     *
     * @return int
     */
    public function getGoalsAgainst()
    {
        return $this->goalsAgainst;
    }

    /**
     * Set goalDifference
     *
     * @param integer $goalDifference
     *
     * @return Participant
     */
    public function setGoalDifference($goalDifference)
    {
        $this->goalDifference = $goalDifference;

        return $this;
    }

    /**
     * Get goalDifference
     *
     * @return int
     */
    public function getGoalDifference()
    {
        return $this->goalDifference;
    }

    /**
     * Set gamesPlayed
     *
     * @param integer $gamesPlayed
     *
     * @return Participant
     */
    public function setGamesPlayed($gamesPlayed)
    {
        $this->gamesPlayed = $gamesPlayed;

        return $this;
    }

    /**
     * Get gamesPlayed
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

