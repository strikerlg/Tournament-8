<?php

namespace Pstryk82\LeagueBundle\Domain\Aggregate;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Competition.
 */
abstract class Competition
{
    /**
     * @var int
     */
    protected $aggregateId;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $season;

    /**
     * @var int
     */
    private $rankPointsForWin;

    /**
     * @var int
     */
    private $rankPointsForDraw;

    /**
     * @var int
     */
    private $rankPointsForLose;
    
    /**
     * @var \DateTime
     */
    private $creationDate;

    public function __construct($aggregateId)
    {
        $this->aggregateId = $aggregateId;
    }
    
    /**
     * Get id.
     *
     * @return int
     */
    public function getAggregateId()
    {
        return $this->aggregateId;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return Competition
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set season.
     *
     * @param string $season
     *
     * @return Competition
     */
    public function setSeason($season)
    {
        $this->season = $season;

        return $this;
    }

    /**
     * Get season.
     *
     * @return string
     */
    public function getSeason()
    {
        return $this->season;
    }

    /**
     * @return int
     */
    public function getRankPointsForWin()
    {
        return $this->rankPointsForWin;
    }

    /**
     * @return int
     */
    public function getRankPointsForDraw()
    {
        return $this->rankPointsForDraw;
    }

    /**
     * @return int
     */
    public function getRankPointsForLose()
    {
        return $this->rankPointsForLose;
    }

    /**
     * @return $this
     */
    public function setRankPointsForWin($rankPointsForWin)
    {
        $this->rankPointsForWin = $rankPointsForWin;

        return $this;
    }

    /**
     * @return $this
     */
    public function setRankPointsForDraw($rankPointsForDraw)
    {
        $this->rankPointsForDraw = $rankPointsForDraw;

        return $this;
    }

    /**
     * @return $this
     */
    public function setRankPointsForLose($rankPointsForLose)
    {
        $this->rankPointsForLose = $rankPointsForLose;

        return $this;
    }

    public function getCreationDate()
    {
        return $this->creationDate;
    }

    public function setCreationDate(\DateTime $creationDate)
    {
        $this->creationDate = $creationDate;

        return $this;
    }


}
