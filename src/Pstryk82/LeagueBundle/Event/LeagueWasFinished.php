<?php

namespace Pstryk82\LeagueBundle\Event;

class LeagueWasFinished extends AbstractEvent
{
    /**
     * @param string $aggregateId
     * @param \DateTime $happenedAt
     */
    public function __construct($aggregateId, $happenedAt)
    {
        $this->aggregateId = $aggregateId;
        $this->happenedAt = $happenedAt;
    }
}
