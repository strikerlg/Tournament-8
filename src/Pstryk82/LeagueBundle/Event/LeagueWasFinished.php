<?php

namespace Pstryk82\LeagueBundle\Event;

class LeagueWasFinished extends AbstractEvent
{
    /**
     * @var bool
     */
    private $finished = true;

    /**
     * @param string $aggregateId
     * @param \DateTime $happenedAt
     */
    public function __construct($aggregateId, $happenedAt)
    {
        $this->aggregateId = $aggregateId;
        $this->happenedAt = $happenedAt;
    }

    /**
     * @return bool
     */
    public function getFinished()
    {
        return $this->finished;
    }
}
