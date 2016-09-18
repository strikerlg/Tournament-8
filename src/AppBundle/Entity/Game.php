<?php

namespace AppBundle\Entity;

/**
 * Game.
 */
class Game
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var bool
     */
    private $played = false;

    /**
     * @var AbstractParticipant
     */
    private $homeParticipant;

    /**
     * @var AbstractParticipant
     */
    private $awayParticipant;

    /**
     * @var int
     */
    private $homeTeamScore;

    /**
     * @var int
     */
    private $awayTeamScore;

    /**
     * @var AbstractParticipant
     */
    private $winner;

    /**
     * @var Competition
     */
    private $competition;

    /**
     * @var bool
     */
    private $onNeutralGround = false;

    /**
     * @var \DateTime
     */
    private $beginningTime;

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set played.
     *
     * @param bool $played
     *
     * @return Game
     */
    public function setPlayed($played)
    {
        $this->played = $played;

        return $this;
    }

    /**
     * Get played.
     *
     * @return bool
     */
    public function getPlayed()
    {
        return $this->played;
    }

    /**
     * Set homeTeam.
     *
     * @param AbstractParticipant $homeParticipant
     *
     * @return Game
     */
    public function setHomeParticipant(AbstractParticipant $homeParticipant)
    {
        $this->homeParticipant = $homeParticipant;

        return $this;
    }

    /**
     * Get homeTeam.
     *
     * @return AbstractParticipant
     */
    public function getHomeParticipant()
    {
        return $this->homeParticipant;
    }

    /**
     * Set awayTeam.
     *
     * @param AbstractParticipant $awayParticipant
     *
     * @return Game
     */
    public function setAwayParticipant(AbstractParticipant $awayParticipant)
    {
        $this->awayParticipant = $awayParticipant;

        return $this;
    }

    /**
     * Get awayTeam.
     *
     * @return AbstractParticipant
     */
    public function getAwayParticipant()
    {
        return $this->awayParticipant;
    }

    /**
     * Set homeTeamScore.
     *
     * @param int $homeTeamScore
     *
     * @return Game
     */
    public function setHomeTeamScore($homeTeamScore)
    {
        $this->homeTeamScore = $homeTeamScore;

        return $this;
    }

    /**
     * Get homeTeamScore.
     *
     * @return int
     */
    public function getHomeTeamScore()
    {
        return $this->homeTeamScore;
    }

    /**
     * Set awayTeamScore.
     *
     * @param int $awayTeamScore
     *
     * @return Game
     */
    public function setAwayTeamScore($awayTeamScore)
    {
        $this->awayTeamScore = $awayTeamScore;

        return $this;
    }

    /**
     * Get awayTeamScore.
     *
     * @return int
     */
    public function getAwayTeamScore()
    {
        return $this->awayTeamScore;
    }

    /**
     * Set winner.
     *
     * @param AbstractParticipant $winner
     *
     * @return Game
     */
    public function setWinner(AbstractParticipant $winner)
    {
        $this->winner = $winner;

        return $this;
    }

    /**
     * Get winner.
     *
     * @return string
     */
    public function getWinner()
    {
        return $this->winner;
    }

    /**
     * Set competition.
     *
     * @param Competition $competition
     *
     * @return Game
     */
    public function setCompetition(Competition $competition)
    {
        $this->competition = $competition;

        return $this;
    }

    /**
     * Get competition.
     *
     * @return Competition
     */
    public function getCompetition()
    {
        return $this->competition;
    }

    /**
     * Set onNeutralGround.
     *
     * @param bool $onNeutralGround
     *
     * @return Game
     */
    public function setOnNeutralGround($onNeutralGround)
    {
        $this->onNeutralGround = $onNeutralGround;

        return $this;
    }

    /**
     * Get onNeutralGround.
     *
     * @return bool
     */
    public function getOnNeutralGround()
    {
        return $this->onNeutralGround;
    }

    /**
     * Set beginningTime.
     *
     * @param \DateTime $beginningTime
     *
     * @return Game
     */
    public function setBeginningTime($beginningTime)
    {
        $this->beginningTime = $beginningTime;

        return $this;
    }

    /**
     * Get beginningTime.
     *
     * @return \DateTime
     */
    public function getBeginningTime()
    {
        return $this->beginningTime;
    }
}
