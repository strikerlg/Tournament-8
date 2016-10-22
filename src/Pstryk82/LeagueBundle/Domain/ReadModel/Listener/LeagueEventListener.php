<?php

namespace Pstryk82\LeagueBundle\Domain\ReadModel\Listener;

use Pstryk82\LeagueBundle\Domain\ReadModel\Projection\LeagueProjection;
use Pstryk82\LeagueBundle\Event\LeagueWasCreated;
use Pstryk82\LeagueBundle\Event\LeagueWasFinished;

class LeagueEventListener extends AbstractEventListener
{
    /**
     * @param LeagueWasCreated $event
     */
    public function onLeagueWasCreated(LeagueWasCreated $event)
    {
        $leagueProjection = new LeagueProjection(
            $event->getAggregateId()
        );
        $leagueProjection
            ->setName($event->getName())
            ->setSeason($event->getSeason());

        $this->projectionStorage->save($leagueProjection);
    }

    /**
     * @param LeagueWasFinished $event
     */
    public function onLeagueWasFinished(LeagueWasFinished $event)
    {
        $leagueProjection = $this->projectionStorage->find(
            $event->getAggregateId(), LeagueProjection::class
        );
        $leagueProjection->setFinished($event->getFinished());
        $this->projectionStorage->save($leagueProjection);
    }
}
