<?php

namespace Pstryk82\LeagueBundle\Domain\Aggregate;

use Doctrine\Common\Collections\ArrayCollection;
use Pstryk82\LeagueBundle\Event\ParticipantWasRegisteredInCompetition;
use Pstryk82\LeagueBundle\EventEngine\EventSourced;

/**
 * Competition.
 */
abstract class Competition
{
//    use EventSourced;

    /**
     * @var int
     */
    protected $aggregateId;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $season;

    /**
     * @var int
     */
    protected $rankPointsForWin;

    /**
     * @var int
     */
    protected $rankPointsForDraw;

    /**
     * @var int
     */
    protected $rankPointsForLose;
    
    /**
     * @var \DateTime
     */
    protected $creationDate;

    /**
     * @var ArrayCollection
     */
    protected $participants;

    public function __construct($aggregateId)
    {
        $this->aggregateId = $aggregateId;
        $this->participants = new ArrayCollection();
    }

    /**
     * @param LeagueParticipant $participant
     */
    public function registerParticipant(AbstractParticipant $participant)
    {
        $participantWasRegisteredInCompetition = new ParticipantWasRegisteredInCompetition(
            $participant, $this->getAggregateId()
        );
        $this->recordThat($participantWasRegisteredInCompetition);
        $this->apply($participantWasRegisteredInCompetition);
    }

    protected function applyParticipantWasRegisteredInCompetition(ParticipantWasRegisteredInCompetition $event)
    {
        $this->addParticipant($event->getParticipant());
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

    public function getParticipants()
    {
        return $this->participants;
    }

    public function addParticipant(AbstractParticipant $participant)
    {
        $this->participants->add($participant);

        return $this;
    }

    public function removeParticipant(AbstractParticipant $participant)
    {
        $this->participants->removeElement($participant);

        return $this;
    }



}
