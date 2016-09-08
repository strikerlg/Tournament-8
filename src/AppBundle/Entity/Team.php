<?php

use AppBundle\Entity\AbstractParticipant;
use AppBundle\Entity\Team;
use Doctrine\Common\Collections\ArrayCollection;

namespace AppBundle\Entity;

/**
 * Team
 */
class Team
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $rank;

    /**
     * @var string
     */
    private $stadium;

    /**
     * @var ArrayCollection
     */
    private $participants;

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
     * Set name
     *
     * @param string $name
     *
     * @return Team
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set rank
     *
     * @param integer $rank
     *
     * @return Team
     */
    public function setRank($rank)
    {
        $this->rank = $rank;

        return $this;
    }

    /**
     * Get rank
     *
     * @return int
     */
    public function getRank()
    {
        return $this->rank;
    }

    /**
     * Set stadium
     *
     * @param string $stadium
     *
     * @return Team
     */
    public function setStadium($stadium)
    {
        $this->stadium = $stadium;

        return $this;
    }

    /**
     * Get stadium
     *
     * @return string
     */
    public function getStadium()
    {
        return $this->stadium;
    }
    
    public function getParticipants()
    {
        return $this->participants;
    }

    /**
     * @param AbstractParticipant $participant
     * 
     * @return $this
     */
    public function addParticipants(AbstractParticipant $participant)
    {
        $this->participants->add($participant);
        
        return $this;
    }

    /**
     * @param AbstractParticipant $participant
     * 
     * @return $this
     */
    public function removeParticipants(AbstractParticipant $participant)
    {
        $this->participants->removeElement($participant);
        
        return $this;
    }
}
