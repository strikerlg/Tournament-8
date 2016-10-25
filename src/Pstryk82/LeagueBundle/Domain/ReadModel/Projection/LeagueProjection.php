<?php

namespace Pstryk82\LeagueBundle\Domain\ReadModel\Projection;

class LeagueProjection extends CompetitionProjection
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

    /**
     * Set pointsForWin.
     *
     * @param int $pointsForWin
     *
     * @return LeagueProjection
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
     * @return LeagueProjection
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
     * @return LeagueProjection
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
     * @return LeagueProjection
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

    /**
     * @return bool
     */
    public function getFinished()
    {
        return $this->finished;
    }

    /**
     * @param bool $finished
     *
     * @return $this
     */
    public function setFinished($finished)
    {
        $this->finished = $finished;
        return $this;
    }
}
