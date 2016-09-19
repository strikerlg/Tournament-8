<?php

namespace Pstryk82\LeagueBundle\Domain\Aggregate;

use Pstryk82\LeagueBundle\Domain\Aggregate\History\AggregateHistoryInterface;
use Pstryk82\LeagueBundle\Event\LeagueWasCreated;
use Pstryk82\LeagueBundle\Event\LeagueWasFinished;

/**
 * League.
 */
class League extends Competition implements AggregateInterface
{
    /**
     * @var int
     */
    private $pointsForWin = 3;

    /**
     * @var int
     */
    private $pointsForDraw = 1;

    /**
     * @var int
     */
    private $pointsForLose = 0;

    /**
     * @var int
     */
    private $numberOfLegs = 2;

    /**
     * @var bool
     */
    private $finished = false;
    
    public function getAggregateId()
    {
        return $this->getId();
    }

    public function getEvents()
    {
        
    }

    /**
     * @param LegueHistory $aggregateHistory
     * @return \self
     */
    public static function reconstituteFrom(AggregateHistoryInterface $aggregateHistory)
    {
        $league = new self($aggregateHistory->getAggregateId());
        foreach ($aggregateHistory->getEvents() as $event) {
            $applyMethod = explode('\\', get_class($event));
            $applyMethod = 'apply'.end($applyMethod);
            $league->$applyMethod($event);
        }
        
        return $league;
    }
    
    private function applyLeagueWasCreated(LeagueWasCreated $event)
    {
        $this
            ->setName($event->getName())
            ->setSeason($event->getSeason())
            ->setRankPointsForWin($event->getRankPointsForWin())
            ->setRankPointsForDraw($event->getRankPointsForDraw())
            ->setRankPointsForLose($event->getRankPointsForLose())
            ->setPointsForWin($event->getPointsForWin())
            ->setPointsForDraw($event->getPointsForDraw())
            ->setPointsForLose($event->getPointsForLose())
            ->setNumberOfLegs($event->getNumberOfLegs())
            ->setCreationDate($event->getHappenedAt());
    }
    
    private function applyLeagueWasFinished(LeagueWasFinished $event)
    {
        $this
            ->setFinished(true);
    }

    
    /**
     * Set pointsForWin.
     *
     * @param int $pointsForWin
     *
     * @return League
     */
    public function setPointsForWin($pointsForWin)
    {
        $this->pointsForWin = $pointsForWin;

        return $this;
    }

    /**
     * Get pointsForWin.
     *
     * @return int
     */
    public function getPointsForWin()
    {
        return $this->pointsForWin;
    }

    /**
     * Set pointsForDraw.
     *
     * @param int $pointsForDraw
     *
     * @return League
     */
    public function setPointsForDraw($pointsForDraw)
    {
        $this->pointsForDraw = $pointsForDraw;

        return $this;
    }

    /**
     * Get pointsForDraw.
     *
     * @return int
     */
    public function getPointsForDraw()
    {
        return $this->pointsForDraw;
    }

    /**
     * Set pointsForLose.
     *
     * @param int $pointsForLose
     *
     * @return League
     */
    public function setPointsForLose($pointsForLose)
    {
        $this->pointsForLose = $pointsForLose;

        return $this;
    }

    /**
     * Get pointsForLose.
     *
     * @return int
     */
    public function getPointsForLose()
    {
        return $this->pointsForLose;
    }

    /**
     * Set numberOfLegs.
     *
     * @param int $numberOfLegs
     *
     * @return League
     */
    public function setNumberOfLegs($numberOfLegs)
    {
        $this->numberOfLegs = $numberOfLegs;

        return $this;
    }

    /**
     * Get numberOfLegs.
     *
     * @return int
     */
    public function getNumberOfLegs()
    {
        return $this->numberOfLegs;
    }
    
    public function getFinished()
    {
        return $this->finished;
    }

    public function setFinished($finished)
    {
        $this->finished = $finished;
        return $this;
    }
}
