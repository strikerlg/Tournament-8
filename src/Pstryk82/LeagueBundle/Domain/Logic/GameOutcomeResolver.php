<?php

namespace Pstryk82\LeagueBundle\Domain\Logic;

use Pstryk82\LeagueBundle\Domain\Aggregate\AbstractParticipant;
use Pstryk82\LeagueBundle\Domain\Aggregate\Game;
use Pstryk82\LeagueBundle\Domain\Exception\GameOutcomeResolverException;

class GameOutcomeResolver
{
    /**
     * @var AbstractParticipant
     */
    private $winner;

    /**
     * @var AbstractParticipant
     */
    private $loser;

    /**
     * @var int | null
     */
    private $winnerScore;

    /**
     * @var int | null
     */
    private $loserScore;

    /**
     * @var int | null
     */
    private $drawScore;

    /**
     * @var bool
     */
    private $draw;

    /**
     * @param Game $game
     *
     * @return AbstractParticipant | null
     * 
     * @throws GameOutcomeResolverException
     */
    public function determine(Game $game)
    {
        $homeScore = $game->getHomeScore();
        $awayScore = $game->getAwayScore();
        if (is_null($homeScore) || is_null($awayScore) || !$game->getPlayed()) {
            throw new GameOutcomeResolverException(
                'Unable to determine winner, there is no score or game has not finished yet'
            );
        }

        if ($homeScore > $awayScore) {
            $this->winner = $game->getHomeParticipant();
            $this->winnerScore = $homeScore;
            $this->loser = $game->getAwayParticipant();
            $this->loserScore = $awayScore;
            $this->draw = false;
        } elseif ($homeScore < $awayScore) {
            $this->winner = $game->getAwayParticipant();
            $this->winnerScore = $awayScore;
            $this->loser = $game->getHomeParticipant();
            $this->loserScore = $homeScore;
            $this->draw = false;
        } else {
            $this->draw = true;
            $this->drawScore = $homeScore;
        }
    }

    /**
     * @return AbstractParticipant
     */
    public function getWinner()
    {
        return $this->winner;
    }

    /**
     * @return AbstractParticipant
     */
    public function getLoser()
    {
        return $this->loser;
    }

    /**
     * @return bool
     */
    public function isDraw()
    {
        return $this->draw;
    }

    /**
     * @return int
     */
    public function getWinnerScore()
    {
        return $this->winnerScore;
    }

    /**
     * @return int
     */
    public function getLoserScore()
    {
        return $this->loserScore;
    }

    /**
     * @return int
     */
    public function getDrawScore()
    {
        return $this->drawScore;
    }
}
