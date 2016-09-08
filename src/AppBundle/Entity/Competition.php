<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Competition
 */
class Competition
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
     * @var string
     */
    private $season;

    /**
     * @var ArrayCollection
     */
    private $participants;
    
    /**
     * @var string
     */
    private $discriminator;
    
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
     * @return Competition
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
     * Set season
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
     * Get season
     *
     * @return string
     */
    public function getSeason()
    {
        return $this->season;
    }

    /**
     * @return ArrayCollection
     */
    public function getParticipants()
    {
        return $this->participants;
    }

    /**
     * @param AbstractParticipant $participant
     * @return Competition
     */
    public function addParticipant(AbstractParticipant $participant)
    {
        $this->participants->add($participant);

        return $this;
    }
    
    /**
     * 
     * @param AbstractParticipant $participant
     * @return Competition
     */
    public function removeParticipant(AbstractParticipant $participant)
    {
        $this->participants->removeElement($participant);

        return $this;
    }

    /**
     * Set discriminator
     *
     * @param string $discriminator
     *
     * @return Competition
     */
    public function setDiscriminator($discriminator)
    {
        $this->discriminator = $discriminator;

        return $this;
    }

    /**
     * @return string
     */
    public function getDiscriminator()
    {
        return $this->discriminator;
    }
    
    /**
     * @return int
     */
    public function getRankPointsForWin() {
        return $this->rankPointsForWin;
    }

    /**
     * @return int
     */
    public function getRankPointsForDraw() {
        return $this->rankPointsForDraw;
    }

    /**
     * @return int
     */
    public function getRankPointsForLose() {
        return $this->rankPointsForLose;
    }

    /**
     * @return $this
     */
    public function setRankPointsForWin($rankPointsForWin) {
        $this->rankPointsForWin = $rankPointsForWin;
        
        return $this;
    }

    /**
     * @return $this
     */
    public function setRankPointsForDraw($rankPointsForDraw) {
        $this->rankPointsForDraw = $rankPointsForDraw;
        
        return $this;
    }

    /**
     * @return $this
     */
    public function setRankPointsForLose($rankPointsForLose) {
        $this->rankPointsForLose = $rankPointsForLose;
        
        return $this;
    }


}

