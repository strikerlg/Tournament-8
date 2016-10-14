<?php

namespace Pstryk82\LeagueBundle\Event;

use Pstryk82\LeagueBundle\Domain\Aggregate\Competition;
use Pstryk82\LeagueBundle\Domain\Logic\GameOutcomeResolver;

class AbstractParticipantHasFinishedGame extends AbstractEvent
{
    /**
     * @var Competition
     */
    protected $competition;

    /**
     *
     * @var GameOutcomeResolver
     */
    protected $gameOutcomeResolver;

    /**
     * @param Competition $competition
     * @param GameOutcomeResolver $gameOutcomeResolver
     */
    public function __construct(Competition $competition, GameOutcomeResolver $gameOutcomeResolver)
    {
        $this->competition = $competition;
        $this->gameOutcomeResolver = $gameOutcomeResolver;
        $this->aggregateId = $this->gameOutcomeResolver->getWinner()->getAggregateId();
        $this->happenedAt = new \DateTime();
    }

    public function getCompetition()
    {
        return $this->competition;
    }

    public function getGameOutcomeResolver()
    {
        return $this->gameOutcomeResolver;
    }
}
