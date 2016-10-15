<?php

namespace Pstryk82\LeagueBundle\Domain\Aggregate\History;

use Pstryk82\LeagueBundle\Event\AbstractEvent;
use Pstryk82\LeagueBundle\Storage\EventStorage;

abstract class AbstractAggregateHistory implements AggregateHistoryInterface
{
    /**
     * @var string
     */
    protected $aggregateId;

    /**
     * @var AbstractEvent[]
     */
    protected $events;

    /**
     * 
     * @param type $aggregateId
     * @param EventStorage $eventStorage
     */
    public function __construct($aggregateId, EventStorage $eventStorage)
    {
        $this->aggregateId = $aggregateId;
        $this->events = $eventStorage->find($aggregateId);
    }

    public function getAggregateId()
    {
        return $this->aggregateId;
    }

    public function getEvents()
    {
        return $this->events;
    }

}
