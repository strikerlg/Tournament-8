<?php

namespace Pstryk82\LeagueBundle\Domain\Aggregate;

use Doctrine\Common\Collections\ArrayCollection;
use Pstryk82\LeagueBundle\Domain\Logic\GameOutcomeResolver;
use Pstryk82\LeagueBundle\Event\LeagueParticipantWasCreated;
use Pstryk82\LeagueBundle\Event\ParticipantHasWon;
use Pstryk82\LeagueBundle\EventEngine\EventSourced;
use Pstryk82\LeagueBundle\Generator\IdGenerator;

/**
 * Participant.
 */
class LeagueParticipant extends AbstractParticipant
{
    use EventSourced;

    /**
     * @var int
     */
    private $points = 0;

    /**
     * @var int
     */
    private $goalsFor = 0;

    /**
     * @var int
     */
    private $goalsAgainst = 0;

    /**
     * @var int
     */
    private $goalDifference = 0;

    /**
     * @var int
     */
    private $gamesPlayed = 0;

    public static function create(Team $team, $competitionId)
        // @todo consider passing Team and Competition objects here instead
    {
        $participant = new self($aggregateId = IdGenerator::generate());
        $participant
            ->setTeam($team)
            ->setCompetitionId($competitionId);

        $participantWasCreatedEvent = new LeagueParticipantWasCreated(
            $aggregateId, $team, $competitionId, new \DateTime()
        );

        $participant->recordThat($participantWasCreatedEvent);

        return $participant;
    }

    private function applyLeagueParticipantWasCreated(LeagueParticipantWasCreated $event)
    {
        $this
            ->setTeam($event->getTeam())
            ->setCompetitionId($event->getLeagueId());
    }

    /**
     * @param Game $game
     * @param GameOutcomeResolver $gameOutcomeResolver
     */
    public function recordPointsForWin(Game $game, GameOutcomeResolver $gameOutcomeResolver)
    {
        $participantHasWonEvent = new ParticipantHasWon(
            $game->getCompetition(),
            $gameOutcomeResolver
        );
        $this->recordThat($participantHasWonEvent);
        $this->apply($participantHasWonEvent);

        $team = $this->getTeam();
        $team->recordRankPoints($game->getCompetition()->getRankPointsForWin());
    }

    /**
     * @param ParticipantHasWon $event
     */
    private function applyParticipantHasWon(ParticipantHasWon $event)
    {
        $this
            ->addPoints($event->getCompetition()->getPointsForWin())
            ->addGoalsFor($event->getGameOutcomeResolver()->getWinnerScore())
            ->addGoalsAgainst($event->getGameOutcomeResolver()->getLoserScore())
            ->addGamesPlayed(1)
            ->addGoalDifference($this->goalsFor - $this->goalsAgainst);
    }

    /**
     * Set points.
     *
     * @param int $points
     *
     * @return LeagueParticipant
     */
    public function setPoints($points)
    {
        $this->points = $points;

        return $this;
    }

    public function addPoints($points)
    {
        $this->points += $points;

        return $this;
    }

    /**
     * Get points.
     *
     * @return int
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * Set goalsFor.
     *
     * @param int $goalsFor
     *
     * @return LeagueParticipant
     */
    public function setGoalsFor($goalsFor)
    {
        $this->goalsFor = $goalsFor;

        return $this;
    }

    /**
     * Get goalsFor.
     *
     * @return int
     */
    public function getGoalsFor()
    {
        return $this->goalsFor;
    }

    public function addGoalsFor($goalsFor)
    {
        $this->goalsFor += $goalsFor;

        return $this;
    }

    /**
     * Set goalsAgains.
     *
     * @param int $goalsAgainst
     *
     * @return LeagueParticipant
     */
    public function setGoalsAgainst($goalsAgainst)
    {
        $this->goalsAgainst = $goalsAgainst;

        return $this;
    }

    /**
     * Get goalsAgains.
     *
     * @return int
     */
    public function getGoalsAgainst()
    {
        return $this->goalsAgainst;
    }

    public function addGoalsAgainst($goalsAgainst)
    {
        $this->goalsAgainst += $goalsAgainst;

        return $this;
    }

    /**
     * @param int $goalDifference
     *
     * @return LeagueParticipant
     */
    public function addGoalDifference($goalDifference)
    {
        $this->goalDifference += $goalDifference;

        return $this;
    }

    /**
     * Get goalDifference.
     *
     * @return int
     */
    public function getGoalDifference()
    {
        return $this->goalDifference;
    }

    /**
     * Set gamesPlayed.
     *
     * @param int $gamesPlayed
     *
     * @return LeagueParticipant
     */
    public function addGamesPlayed($gamesPlayed)
    {
        $this->gamesPlayed += $gamesPlayed;

        return $this;
    }

    /**
     * Get gamesPlayed.
     *
     * @return int
     */
    public function getGamesPlayed()
    {
        return $this->gamesPlayed;
    }

    /**
     * @return ArrayCollection
     */
    public function getGames()
    {
        return $this->games;
    }
}
