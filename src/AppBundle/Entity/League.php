<?php

namespace AppBundle\Entity;

/**
 * League.
 */
class League extends Competition
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
}
