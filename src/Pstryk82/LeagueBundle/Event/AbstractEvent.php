<?php

namespace Pstryk82\LeagueBundle\Event;

abstract class AbstractEvent
{
    /**
     * @var string
     */
    protected $aggregateId;

    /**
     * @var \DateTime
     */
    protected $happenedAt;

    /**
     * @return string
     */
    public function getAggregateId()
    {
        return $this->aggregateId;
    }

    /**
     * @return \DateTime
     */
    public function getHappenedAt()
    {
        return $this->happenedAt;
    }
}
