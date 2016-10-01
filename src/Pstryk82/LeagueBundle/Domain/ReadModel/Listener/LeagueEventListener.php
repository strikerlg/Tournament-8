<?php

namespace Pstryk82\LeagueBundle\Domain\ReadModel\Listener;

use Pstryk82\LeagueBundle\Domain\ReadModel\Projection\LeagueProjection;
use Pstryk82\LeagueBundle\Event\LeagueWasCreated;
use Pstryk82\LeagueBundle\Event\LeagueWasFinished;

class LeagueEventListener extends AbstractEventListener
{
    public function onLeagueWasCreated(LeagueWasCreated $event)
    {
        $leagueProjection = new LeagueProjection(
            $event->getAggregateId(),
            $event->getName(),
            $event->getSeason(),
            []
        );
//        var_dump($leagueProjection); die;

        $this->projectionStorage->save($leagueProjection);
    }

    public function onLeagueWasFinished(LeagueWasFinished $event)
    {
//        $leagueProjection = $this->projectionStorage->find($event->getLeagueId());

    }
}
