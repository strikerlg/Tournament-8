<?php

namespace Pstryk82\LeagueBundle\Event;

use Pstryk82\LeagueBundle\Domain\Aggregate\AbstractParticipant;

class ParticipantWasRegisteredInCompetition extends AbstractEvent
{
    /**
     * @var AbstractParticipant
     */
    private $participant;

    public function __construct(AbstractParticipant $participant, $competitionId)
    {
        $this->aggregateId = $competitionId;
        $this->participant = $participant;
        $this->happenedAt = new \DateTime();
    }

    /**
     * @return AbstractParticipant
     */
    public function getParticipant()
    {
        return $this->participant;
    }
}
