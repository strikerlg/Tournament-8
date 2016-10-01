<?php

namespace Pstryk82\LeagueBundle\Domain\ReadModel\Listener;

use Pstryk82\LeagueBundle\Domain\ReadModel\Projection\TeamProjection;
use Pstryk82\LeagueBundle\Event\TeamWasCreated;

class TeamEventListener extends AbstractEventListener
{
    public function onTeamWasCreated(TeamWasCreated $event)
    {
        $teamProjection = new TeamProjection(
            $event->getAggregateId(),
            $event->getName(),
            $event->getRank(),
            $event->getStadium()
        );

        $this->projectionStorage->save($teamProjection);
    }
}
