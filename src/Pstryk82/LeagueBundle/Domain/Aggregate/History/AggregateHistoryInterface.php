<?php

namespace Pstryk82\LeagueBundle\Domain\Aggregate\History;

interface AggregateHistoryInterface
{
    public function getEvents();
    
    public function getAggregateId();
}
