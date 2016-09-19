<?php

namespace Pstryk82\LeagueBundle\Domain\Aggregate;

use Pstryk82\LeagueBundle\Domain\Aggregate\History\AggregateHistoryInterface;
use Pstryk82\LeagueBundle\Event\AbstractEvent;

interface AggregateInterface
{
    /**
     * @return AbstractEvent[]
     */
    public function getEvents();
 
    /**
     * @return string
     */
    public function getAggregateId();
 
    /**
     * @return AggregateInterface
     */
    public static function reconstituteFrom(
        AggregateHistoryInterface $aggregateHistory
    );
}
