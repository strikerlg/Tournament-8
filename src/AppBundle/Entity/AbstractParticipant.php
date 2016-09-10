<?php

namespace AppBundle\Entity;

use AppBundle\Entity\League\Participant;

abstract class AbstractParticipant
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var Team
     */
    private $team;

    /**
     * @var Competition
     */
    private $competition;

    /**
     * @var ArrayCollection
     */
    private $games;

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
     * Set team.
     *
     * @param Team $team
     *
     * @return Participant
     */
    public function setTeam(Team $team)
    {
        $this->team = $team;

        return $this;
    }

    /**
     * Get team.
     *
     * @return Team
     */
    public function getTeam()
    {
        return $this->team;
    }

    /**
     * @return Competition
     */
    public function getCompetition()
    {
        return $this->competition;
    }

    /**
     * @param Competition $competition
     *
     * @return $this
     */
    public function setCompetition(Competition $competition)
    {
        $this->competition = $competition;

        return $this;
    }

    /**
     * @param \AppBundle\Entity\League\Game $game
     *
     * @return \AppBundle\Entity\League\Participant
     */
    public function addGame(Game $game)
    {
        $this->games->add($game);

        return $this;
    }

    /**
     * @param \AppBundle\Entity\League\Game $game
     *
     * @return \AppBundle\Entity\League\Participant
     */
    public function removeGame(Game $game)
    {
        $this->games->removeElement($game);

        return $this;
    }
}
