<?php

namespace Pstryk82\LeagueBundle\Domain\Logic;

use Pstryk82\LeagueBundle\Domain\Aggregate\AbstractParticipant;
use Pstryk82\LeagueBundle\Domain\Aggregate\Game;
use Pstryk82\LeagueBundle\Domain\Exception\GameWinnerCheckerException;

class GameWinnerChecker
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
     * @var bool
     */
    private $draw;
    /**
     * @param Game $game
     *
     * @return AbstractParticipant | null
     * 
     * @throws GameWinnerCheckerException
     */
    public function determine(Game $game)
    {
        $homeScore = $game->getHomeScore();
        $awayScore = $game->getAwayScore();
        if (is_null($homeScore) || is_null($homeScore)) {
            throw new GameWinnerCheckerException('Unable to determine winner, there is no score yet');
        }

        if ($homeScore > $awayScore) {
            $this->winner = $game->getHomeParticipant();
            $this->loser = $game->getAwayParticipant();
            $this->draw = false;
        } elseif ($homeScore < $awayScore) {
            $this->winner = $game->getAwayParticipant();
            $this->loser = $game->getHomeParticipant();
            $this->draw = false;
        } else {
            $this->draw = true;
        }
    }

    public function getWinner()
    {
        return $this->winner;
    }

    public function getLoser()
    {
        return $this->loser;
    }

    public function isDraw()
    {
        return $this->draw;
    }


}
