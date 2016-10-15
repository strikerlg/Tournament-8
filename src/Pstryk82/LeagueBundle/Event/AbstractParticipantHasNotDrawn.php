<?php

namespace Pstryk82\LeagueBundle\Event;

use Pstryk82\LeagueBundle\Domain\Aggregate\Competition;
use Pstryk82\LeagueBundle\Domain\Logic\GameOutcomeResolver;

abstract class AbstractParticipantHasNotDrawn extends AbstractParticipantHasFinishedGame
{
    /**
     * @var GameOutcomeResolver
     */
    protected $gameOutcomeResolver;

    public function __construct(Competition $competition, GameOutcomeResolver $gameOutcomeResolver)
    {
        parent::__construct($competition);
        $this->gameOutcomeResolver = $gameOutcomeResolver;
    }

    public function getGameOutcomeResolver()
    {
        return $this->gameOutcomeResolver;
    }
}
