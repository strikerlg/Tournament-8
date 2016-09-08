<?php

namespace AppBundle\Entity;

use AppBundle\Entity\League\Participant;

class AbstractParticipant {

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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set team
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
     * Get team
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
    public function getCompetition() {
        return $this->competition;
    }

    /**
     * 
     * @param Competition $competition
     * 
     * @return $this
     */
    public function setCompetition(Competition $competition) {
        $this->competition = $competition;
        return $this;
    }


}
