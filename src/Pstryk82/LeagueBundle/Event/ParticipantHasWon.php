<?php

namespace Pstryk82\LeagueBundle\Event;

use Pstryk82\LeagueBundle\Domain\Aggregate\Competition;
use Pstryk82\LeagueBundle\Domain\Logic\GameOutcomeResolver;

//class ParticipantHasWon extends AbstractEvent
//{
//    private $aggregateId;
//    private $competitionId;
//    private $pointsInCompetition;
//    private $goalsFor;
//    private $goalsAgainst;
//
//    public function __construct($aggregateId, $competitionId, $pointsInCompetition, $goalsFor, $goalsAgainst)
//    {
//        $this->aggregateId = $aggregateId;
//        $this->competitionId = $competitionId;
//        $this->pointsInCompetition = $pointsInCompetition;
//        $this->goalsFor = $goalsFor;
//        $this->goalsAgainst = $goalsAgainst;
//    }
//
//}


class ParticipantHasWon extends AbstractEvent
{
    /**
     * @var Competition
     */
    private $competition;

    /**
     *
     * @var GameOutcomeResolver
     */
    private $gameOutcomeResolver;

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