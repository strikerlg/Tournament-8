<?php

namespace AppBundle\Entity;

/**
 * Game.
 */
class Game
{
    const WINNER_HOME = 'home';
    const WINNER_DRAW = 'draw';
    const WINNER_AWAY = 'away';

    /**
     * @var int
     */
    private $id;

    /**
     * @var bool
     */
    private $played = false;

    /**
     * @var \stdClass
     */
    private $homeTeam;

    /**
     * @var \stdClass
     */
    private $awayTeam;

    /**
     * @var int
     */
    private $homeTeamScore;

    /**
     * @var int
     */
    private $awayTeamScore;

    /**
     * @var string
     */
    private $winner;

    /**
     * @var \stdClass
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
     * @param \stdClass $homeTeam
     *
     * @return Game
     */
    public function setHomeTeam($homeTeam)
    {
        $this->homeTeam = $homeTeam;

        return $this;
    }

    /**
     * Get homeTeam.
     *
     * @return \stdClass
     */
    public function getHomeTeam()
    {
        return $this->homeTeam;
    }

    /**
     * Set awayTeam.
     *
     * @param \stdClass $awayTeam
     *
     * @return Game
     */
    public function setAwayTeam($awayTeam)
    {
        $this->awayTeam = $awayTeam;

        return $this;
    }

    /**
     * Get awayTeam.
     *
     * @return \stdClass
     */
    public function getAwayTeam()
    {
        return $this->awayTeam;
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
     * @param string $winner
     *
     * @return Game
     */
    public function setWinner($winner)
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
     * @param \stdClass $competition
     *
     * @return Game
     */
    public function setCompetition($competition)
    {
        $this->competition = $competition;

        return $this;
    }

    /**
     * Get competition.
     *
     * @return \stdClass
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
