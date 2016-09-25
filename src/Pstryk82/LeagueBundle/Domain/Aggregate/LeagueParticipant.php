<?php

namespace Pstryk82\LeagueBundle\Domain\Aggregate;

use Doctrine\Common\Collections\ArrayCollection;
use Pstryk82\LeagueBundle\Event\LeagueParticipantWasCreated;
use Pstryk82\LeagueBundle\Generator\IdGenerator;
use Pstryk82\LeagueBundle\EventEngine\EventSourced;

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

    public static function create($teamId, $competitionId)
    {
        $participant = new self($aggregateId = IdGenerator::generate());
        $participant
            ->setTeamId($teamId)
            ->setCompetitionId($competitionId);

        $participantWasCreatedEvent = new LeagueParticipantWasCreated(
            $aggregateId, $teamId, $competitionId, new \DateTime()
        );

        $participant->recordThat($participantWasCreatedEvent);

        return $participant;
    }

    private function applyLeagueParticipantWasCreated(LeagueParticipantWasCreated $event)
    {
        $this
            ->setTeamId($event->getTeamId())
            ->setCompetitionId($event->getCompetitionId());
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

    /**
     * Set goalDifference.
     *
     * @param int $goalDifference
     *
     * @return LeagueParticipant
     */
    public function setGoalDifference($goalDifference)
    {
        $this->goalDifference = $goalDifference;

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
    public function setGamesPlayed($gamesPlayed)
    {
        $this->gamesPlayed = $gamesPlayed;

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
