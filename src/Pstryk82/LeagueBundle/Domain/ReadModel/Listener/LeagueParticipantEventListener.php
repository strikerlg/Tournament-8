<?php

namespace Pstryk82\LeagueBundle\Domain\ReadModel\Listener;

use Pstryk82\LeagueBundle\Domain\ReadModel\Projection\LeagueParticipantProjection;
use Pstryk82\LeagueBundle\Domain\ReadModel\Projection\LeagueProjection;
use Pstryk82\LeagueBundle\Domain\ReadModel\Projection\TeamProjection;
use Pstryk82\LeagueBundle\Event\LeagueParticipantWasCreated;

class LeagueParticipantEventListener extends AbstractEventListener
{
    public function onLeagueParticipantWasCreated(LeagueParticipantWasCreated $event)
    {
        $leagueParticipant = new LeagueParticipantProjection(
            $event->getAggregateId()
        );
        $team = $this->projectionStorage->find($event->getTeamId(), TeamProjection::class);
        $leagueParticipant->setTeam($team);

        $competition = $this->projectionStorage->find($event->getLeagueId(), LeagueProjection::class);
        $leagueParticipant->setCompetition($competition);

        $this->projectionStorage->save($leagueParticipant);
    }
}
