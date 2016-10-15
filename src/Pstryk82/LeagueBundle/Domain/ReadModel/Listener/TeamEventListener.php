<?php

namespace Pstryk82\LeagueBundle\Domain\ReadModel\Listener;

use Pstryk82\LeagueBundle\Domain\ReadModel\Projection\TeamProjection;
use Pstryk82\LeagueBundle\Event\TeamGainedRankPoints;
use Pstryk82\LeagueBundle\Event\TeamWasCreated;

class TeamEventListener extends AbstractEventListener
{
    public function onTeamWasCreated(TeamWasCreated $event)
    {
        $teamProjection = new TeamProjection(
            $event->getAggregateId()
        );
        $teamProjection
            ->setName($event->getName())
            ->addRank($event->getRank())
            ->setStadium($event->getStadium());

        $this->projectionStorage->save($teamProjection);
    }

    /**
     * @param TeamGainedRankPoints $event
     */
    public function onTeamGainedRankPoints(TeamGainedRankPoints $event)
    {
        /* @var $teamProjection TeamProjection */
        $teamProjection = $this->projectionStorage->find($event->getAggregateId(), TeamProjection::class);
        $teamProjection->addRank($event->getNumberOfAddedRankPoints());

        $this->projectionStorage->save($teamProjection);
    }

}
