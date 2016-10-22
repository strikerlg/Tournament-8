<?php

namespace Pstryk82\LeagueBundle\Domain\Aggregate;

use Pstryk82\LeagueBundle\Event\LeagueWasCreated;
use Pstryk82\LeagueBundle\Event\LeagueWasFinished;
use Pstryk82\LeagueBundle\EventEngine\EventSourced;
use Pstryk82\LeagueBundle\Generator\IdGenerator;

class League extends Competition implements AggregateInterface
{
    use EventSourced;

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
    
    /**
     *
     * @param type $name
     * @param type $season
     * @param type $rankPointsForWin
     * @param type $rankPointsForDraw
     * @param type $rankPointsForLose
     * @param type $pointsForWin
     * @param type $pointsForDraw
     * @param type $pointsForLose
     * @param type $numberOfLegs
     * 
     * @return $this
     */
    public static function create(
        $name,
        $season,
        $rankPointsForWin,
        $rankPointsForDraw,
        $rankPointsForLose,
        $pointsForWin,
        $pointsForDraw,
        $pointsForLose,
        $numberOfLegs
    )
    {
        $league = new self($aggregateId = IdGenerator::generate());
        $league
            ->setName($name)
            ->setSeason($season)
            ->setRankPointsForWin($rankPointsForWin)
            ->setRankPointsForDraw($rankPointsForDraw)
            ->setRankPointsForLose($rankPointsForLose)
            ->setPointsForWin($pointsForWin)
            ->setPointsForDraw($pointsForDraw)
            ->setPointsForLose($pointsForLose)
            ->setNumberOfLegs($numberOfLegs)
            ->setCreationDate($happenedAt = new \DateTime());


        $leagueCreatedEvent = new LeagueWasCreated(
            $aggregateId,
            $name,
            $season,
            $rankPointsForWin,
            $rankPointsForDraw,
            $rankPointsForLose,
            $pointsForWin,
            $pointsForDraw,
            $pointsForLose,
            $numberOfLegs,
            $happenedAt
        );
        $league->recordThat($leagueCreatedEvent);

        return $league;
    }

    public function finish()
    {
        $leagueWasFinishedEvent = new LeagueWasFinished($this->aggregateId, new \DateTime());
        $this->recordThat($leagueWasFinishedEvent);
        $this->apply($leagueWasFinishedEvent);
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
            ->setFinished($event->getFinished());
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
